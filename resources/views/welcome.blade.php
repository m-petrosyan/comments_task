<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    <!-- Styles -->
    @livewireStyles
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="antialiased">
<div
    class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 selection:bg-red-500 selection:text-white">
    @if (Route::has('login'))
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
            @auth
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                            class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                        {{ __('Log Out') }}
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                   class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                    in</a>
            @endauth
        </div>
    @endif
    <div class="max-w-7xl mx-auto p-6 lg:p-8 mt-10">
        @foreach($errors->all() as $error)
            <div class="p-4 mb-4 text-sm rounded-lg bg-red-500 dark:bg-gray-800"
                 role="alert">
                <p class="font-semibold text-white hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                    {{$error}}
                </p>
            </div>
        @endforeach
        @guest()
            <div class="p-4 mb-4 text-sm rounded-lg bg-red-500 dark:bg-gray-800"
                 role="alert">
                <a href="{{ route('login') }}"
                   class="font-semibold text-white hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                    Log in to write comments</a>
            </div>
        @endguest
        <section class="bg-white dark:bg-gray-900 py-8  antialiased">
            <div class="max-w-2xl mx-auto px-4">
                <div class="flex items-center">
                    <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">
                        {{$post->user->name}}
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        <time pubdate datetime="2022-02-08" title="February 8th, 2022">
                            {{$post->date}}
                        </time>
                    </p>
                </div>
                <h1 class="capitalize mt-5">{{$post->content}}</h1>
                <div class="flex justify-between items-center mb-6 mt-5">
                    <h4 class="text-sm opacity-50 text-gray-900 dark:text-white">Discussion
                        ({{$post->all_comments_count}})</h4>
                </div>
                @auth()
                    <form class="mb-6" method="POST" action="{{ route('comment.store',$post->id) }}">
                        @csrf
                        <div
                            class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                            <label for="comment" class="sr-only">Your comment</label>
                            <textarea id="comment" rows="6"
                                      name="content"
                                      class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                                      placeholder="Write a comment..." required></textarea>
                        </div>
                        <button type="submit"
                                class="bg-blue-500 inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                            Post comment
                        </button>
                    </form>
                @endauth
                @foreach($post->comments as $comment)
                    <article class="border p-6 text-base bg-white rounded-lg dark:bg-gray-900">
                        <footer class="flex justify-between items-center mb-2">
                            <div class="flex items-center">
                                <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">
                                    {{$comment->user->name}}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    <time pubdate datetime="2022-02-08"
                                          title="February 8th, 2022">
                                        {{$comment->date}}
                                    </time>
                                </p>
                            </div>
                            <div id="dropdownComment1"
                                 class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownMenuIconHorizontalButton">
                                    <li>
                                        <a href="#"
                                           class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                           class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                           class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
                                    </li>
                                </ul>
                            </div>
                        </footer>
                        <p class="text-gray-500 dark:text-gray-400">{{$comment->content}}</p>
                        @include('reply_form', ['comment' => $comment,'post' => $post])
                        @include('comment_replies', ['comments' => $comment->replies, 'post_id' => $post->id])
                    </article>
                @endforeach
            </div>
        </section>
    </div>
</div>
@livewireScripts
</body>
</html>
