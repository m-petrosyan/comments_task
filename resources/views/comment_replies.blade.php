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
        <div class="reply" x-data="{
          showReplyForm: false
        }">
            <div class="flex items-center mt-4 space-x-4">
                <button type="button" x-on:click="showReplyForm = true"
                        class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium">
                    <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 20 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2"
                              d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z"/>
                    </svg>
                    @auth()
                        Reply
                    @endauth
                     ({{$comment->replies->count()}})
                </button>
            </div>
            @auth()
                <form class="mb-6 mt-5" x-show="showReplyForm" method="POST"
                      action="{{ route('comment.store',['post' => $post->id, 'comment_id' => $comment->id]) }}">
                    @csrf
                    <div
                        class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                        <label for="comment" class="sr-only">Your comment</label>
                        <textarea rows="6"
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
        </div>
    </article>
    <div class="pl-5">
        @include('comment_replies', ['comments' => $comment->replies])
    </div>
@endforeach

