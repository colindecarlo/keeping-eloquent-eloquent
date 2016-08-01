<?php

namespace App\Collections;

use Illuminate\Database\Eloquent\Collection;

class CommentsCollection extends Collection
{
    public function weekOverWeekActivity()
    {
        $this->load('post');

        return $this->groupBy(function ($comment) {
                $created = $comment->created_at;
                return $created->diffInWeeks($comment->post->published_at);
            })->flatMap(function ($comments) {
                return $comments->count();
            })->eachCons(2)->map(function ($pair) {
                return $pair->last() - $pair->first();
            });
    }
}
