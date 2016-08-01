<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function scopeSince($query, $since)
    {
        return $query->where('created_at', '>', $since);
    }

    public function scopeSinceYesterday($query)
    {
        return $this->scopeSince($query, Carbon::yesterday());
    }
}
