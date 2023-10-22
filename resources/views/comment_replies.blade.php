@foreach($comments as $comment)
    <article class="p-6 mb-3 lg:ml-3 text-base bg-white rounded-lg dark:bg-gray-900">
        <footer class="flex justify-between items-center mb-2">
            <div class="flex items-center">
                <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">
                    {{$comment->user->name}}
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    <time pubdate datetime="2022-02-12"
                          title="February 12th, 2022">
                        {{ $comment->date }}
                    </time>
                </p>
            </div>
        </footer>
        <p class="text-gray-500 dark:text-gray-400">{{$comment->content}}</p>
        @include('reply_form', ['comment' => $comment,'post' => $post])
    </article>
    <div class="pl-5">
        @include('comment_replies', ['comments' => $comment->replies])
    </div>
@endforeach

