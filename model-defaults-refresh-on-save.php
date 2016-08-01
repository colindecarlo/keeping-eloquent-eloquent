<?php

use App\Post;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Post::saved(function ($post) {
            $saved = Post::find($post->id);
            $post->forceFill($saved->getAttributes());
        });
    }

    public function register() {}
}
