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
        $comment = new Comment($attributes);
        $comment->author()->associate($author);

        return $this->comments()->save($comment);
    }
}
