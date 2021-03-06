<?php

namespace App\Collections;

use Illuminate\Database\Eloquent\Collection;

class CommentsCollection extends Collection
{
    public function weekOverWeekActivity()
    {
        $this->load('post');

        return $this->groupByWeeksSincePost()
            ->flatMap(function ($comments) {
                return $comments->count();
            })->eachCons(2)->map(function ($pair) {
                return $pair->last() - $pair->first();
            });
    }

    public function groupByWeeksSincePost()
    {
        return $this->groupBy('weeks_since_post')->toBase();
    }
}
