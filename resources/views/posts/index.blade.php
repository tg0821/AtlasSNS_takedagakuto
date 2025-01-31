<x-login-layout>

<!-- ここで投稿フォーム編集　バリデーションはPostsController.phpで編集 -->
 {{ Form::open(['url' => '/post/create']) }}
 <img src="{{ asset('images/icon1.png') }}">
  <!-- placeholderでテキストボックスの中に必要な情報をいれることができる。今回は投稿内容を入力してくださいとうテキスト -->
  {{ Form::text('post',null,['class' => 'posts-box','placeholder' => '投稿内容を入力してください']) }}
  <button id="bottom"><img src="{{ asset('images/post.png') }}"></button>
 {{ Form::close() }}

<!-- 上の投稿ボタンを押した後の投稿内容を見れるようにする -->
 <h2>投稿一覧</h2>
    @if($posts->isEmpty())
        <p>投稿はありません。</p>
    @else
        @foreach($posts as $post)
            <div class="post">
                <p>{{ $post->post }}</p> <!-- 投稿内容 -->
            </div>
        @endforeach
    @endif

 <!-- 削除機能のボタン -->
  {{ Form::open(['url' => '/post/delete', 'method' => 'POST']) }}
  {{ Form::hidden('_method', 'DELETE') }}
<!-- <a class="btn btn-danger" href="/post/delete" onclick="return confirm('こちらの投稿を削除します。よろしいでしょうか？')">削除</a>-->
  <button type="submit" id="bottom" onclick="return confirm('こちらの投稿を削除します。よろしいでしょうか？')">  <img src="{{ asset('images/trash-h.png') }}"></button>
 {{ Form::close() }}
    <!-- バリデーションエラーメッセージ -->
@if($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
    @endif
</x-login-layout>
