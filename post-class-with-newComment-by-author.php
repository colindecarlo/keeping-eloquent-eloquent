<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function newComment($author, $attributes)
    {
        return $this->comments()->save(
            (new Comment($attributes))->byAuthor($author)
        );
    }
}
