<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $attributes = [
        'approved' => false,
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function byAuthor($author)
    {
        return $this->author()->associate($author);
    }
}
