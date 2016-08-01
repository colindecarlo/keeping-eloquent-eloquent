<?php

namespace App;

use Illuminate\Database\Eloquent\Model

class Post extends Model
{
    protected $defaults = [
        'published' => false,
    ];

    public function __construct(array $attributes = [])
    {
        $attributes = array_merge($this->defaults, $attributes);
        parent::__construct($attributes);
    }
}
