<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function scopeSince($query, $since)
    {
        return $query->where('created_at', '>', $since);
    }
}
