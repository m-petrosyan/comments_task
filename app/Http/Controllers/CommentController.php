<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentCreateRequest;
use App\Models\Post;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentCreateRequest $request, Post $post)
    {
        $post->comments()->create(
            ['user_id' => auth()->id(), 'content' => $request->content, 'parent_id' => $request->comment_id]
        );

        return redirect()->route('home');
    }
}
