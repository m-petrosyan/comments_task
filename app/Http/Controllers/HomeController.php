<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepository;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $post = PostRepository::getFirstPost();

        return view('welcome', compact('post'));
    }
}
