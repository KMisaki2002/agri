<x-main-layout>
        <div class='create-box'>
            <h1>投稿作成</h1>
            <form action="/posts" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="title">
                    <h2>Title</h2>
                    <input type="text" name="post[title]" placeholder="タイトル"/>
                    <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
                </div>
                <div class="category">
                    <select name="post[category_id]" id="category" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="body">
                    <h2>Body</h2>
                    <textarea name="post[body]" placeholder="今日も1日お疲れさまでした。"></textarea>
                    <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
                </div>
                <div class="image">
                    <input type="file" name="image">
                </div>
                <div class="store-btn"><input type="submit" value="store"/></div>
            </form>
            <div class="footer">
                <div class="modoru-btn"><a href="/">戻る</a></div>
            </div>
        </div>
</x-main-layout>