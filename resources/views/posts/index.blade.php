<x-main-layout>
        <div class='posts'>
            <div class='create-btn'><a href='/posts/create'>create</a></div>
            @foreach ($posts as $post)
                <div class='post'>
                    <h2 class='title'>
                        <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                    </h2>
                    <p>カテゴリー: {{ $post->category->name ?? '' }}</p>
                    <p class='body'>{{ $post->body }}</p>
                    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePost({{ $post->id }})">delete</button> 
                    </form>
                     <div>
                    @auth
                        <!-- Post.phpに作ったisLikedByメソッドをここで使用 -->
                        @if (!$post->isLikedBy(Auth::user()))
                            <span class="likes">
                                <i class="fas fa-heart like-toggle" data-post-id="{{ $post->id }}"></i>
                            <span class="like-counter">{{$post->likes_count}}</span>
                            </span><!-- /.likes -->
                        @else
                            <span class="likes">
                                <i class="fas fa-heart heart like-toggle liked" data-post-id="{{ $post->id }}"></i>
                            <span class="like-counter">{{$post->likes_count}}</span>
                            </span><!-- /.likes -->
                        @endif
                    @endauth
                    </div>
                </div>
               
            @endforeach
        </div>
        <div class='paginate'>
           {{ $posts->links() }}
                
        </div>
        <script>
        function deletePost(id) {
            'use strict'
    
            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }
        </script>
        
   </x-main-layout>