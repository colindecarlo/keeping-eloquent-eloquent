<?php

namespace App\Reports;

use Carbon\Carbon;

class PostsByAuthorReport extends Report
{
    public function buildBaseQuery()
    {
       $query = DB::table('users')
            ->select([
                'users.name',
                DB::raw('COUNT(disinct posts.id) as number_of_posts'),
                DB::raw('COUNT(comments.id) as total_comments')
            ])
            ->innerJoin('posts', 'users.id', '=', 'posts.author_id')
            ->leftJoin('comments', 'posts.id', '=', 'comments.post_id')
            ->groupBy('users.name');
    }

    public function filterActiveUsers($yesNo)
    {
        return $yesNo ? $this->onlyActiveUsers() : $this;
    }

    public function onlyActiveUsers()
    {
       $this->query->where('users.last_login', '>=', Carbon::now()->subMonths(3));
       return $this;
    }

    public function includeDrafts($yesNo)
    {
        return $yesNo ? $this : $this->onlyPublishedPosts();
    }

    public function onlyPublishedPosts()
    {
       $this->query->whereNotNull('posts.published_at');
       return $this;
    }

    public function havingBacklinks($yesNo)
    {
        if ($yesNo === null) {
            return $this;
        }

        return $yesNo ? $this->withBacklinks() : $this->withoutBacklinks();
    }

    protected function joinWithBacklinks()
    {
        $this->query->leftJoin('backlinks', 'posts.id', '=', 'backlinks.post_id');
    }

    public function withBacklinks()
    {
        $this->joinWithBacklinks();
        $this->query->whereNotNull('backlinks.id');
        return $this;
    }

    public function withoutBacklinks()
    {
        $this->joinWithBacklinks();
        $this->query->whereNull('backlinks.id');
        return $this;
    }

    public function postedSince($since)
    {
        if (!$since) {
            return $this;
        }

        $this->query->where('posts.created_at', '>=', Carbon::parse($since));
        return $this;
    }
}
