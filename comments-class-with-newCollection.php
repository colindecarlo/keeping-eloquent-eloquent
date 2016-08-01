<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Collections\CommentsCollection;

class Comment extends Model
{
    public function getWeeksSincePostAttribute()
    {
        return $this->created_at->diffInWeeks($this->post->published_at);
    }

    public function newCollection(array $models = [])
    {
        return new CommentsCollection($models);
    }
}
