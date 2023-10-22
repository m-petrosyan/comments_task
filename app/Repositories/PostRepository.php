<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository
{
    /**
     * @return mixed
     */
    public static function getFirstPost(): mixed
    {
        return Post::first()->loadCount('allComments');
    }
}
