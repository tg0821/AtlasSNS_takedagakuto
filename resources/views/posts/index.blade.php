<x-login-layout>

<!-- ここで投稿フォーム編集　バリデーションはPostsController.phpで編集 -->
 {{ Form::open(['url' => '/post/create']) }}
 <div class="post-container">
 <!-- ログインしているユーザーのアイコン -->
@if (Auth::user()->icon_image!="icon1.png")
<img src="{{ asset('storage/images/' . Auth::user()->icon_image) }}" alt="User Icon" class =user-icon />
@else
<img src="{{ asset('storage/icon1.png') }}" alt="Default Icon" class =user-icon/>
@endif
  <!-- placeholderでテキストボックスの中に必要な情報をいれることができる。今回は投稿内容を入力してくださいとうテキスト -->
  {{ Form::text('post',null,['class' => 'posts-box','placeholder' => '投稿内容を入力してください']) }}
  <button id="bottom"><img src="{{ asset('images/post.png') }}"></button>
  {{ Form::close() }}
</div>
<!-- 上の投稿ボタンを押した後の投稿内容を見れるようにする -->
 <h2>投稿一覧</h2>
    @if($posts->isEmpty())
        <p>投稿はありません。</p>
    @else
        @foreach($posts as $post)
            <div class="post">
            @if (Auth::user()->icon_image!="icon1.png")
            <img src="{{ asset('storage/images/' . Auth::user()->icon_image) }}" alt="User Icon" class =user-icon />
            @else
            <img src="{{ asset('storage/icon1.png') }}" alt="Default Icon" class =user-icon/>
            @endif
            <p id="post-text-{{ $post->id }}">{{ $post->post }}</p> <!-- 投稿内容 -->
            <!-- 編集ボタン (自分の投稿のみ表示) -->
            @if(Auth::id() == $post->user_id)
            <button class="button js-modal-button" data-id="{{ $post->id }}" data-text="{{ $post->post }}">
               <img src="{{asset('images/edit_h.png') }}" class =user-icon>
            </button>
            @endif
            <!-- 削除機能のボタン -->
    @auth
  {!! Form::open(['url' => '/post/delete', 'method' => 'POST', 'id' => 'deleteForm']) !!}
    {{ Form::hidden('_method', 'DELETE') }} <!-- DELETE メソッドを指定 -->
    {{ Form::hidden('post_id', $post->id) }} <!-- 削除する投稿のID -->
    <button type="submit" onclick="return confirm('この投稿を削除しますか？')" >
      <img src="{{ asset('images/trash-h.png') }}" alt="削除" class="user-icon">
    </button>
  {!! Form::close() !!}
@endauth

            </div>
        @endforeach
    @endif

    <!-- モーダルのHTML -->
<div id="editModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        {!! Form::open(['url' => '', 'method' => 'POST', 'id' => 'editForm']) !!}
        {{ Form::hidden('_method', 'PUT') }}
        {{ Form::hidden('post_id', null, ['id' => 'post_id']) }}
        {{ Form::text('post', null, ['id' => 'edit_post', 'class' => 'posts-box']) }}
        <button type="submit">更新</button>
        {!! Form::close() !!}

    </div>
</div>

<!-- フォローしているユーザーの投稿 -->
@foreach(Auth::user()->following as $user)
    @foreach($user->posts as $post)
        <div class="user-post">
            <!-- ユーザーアイコン（クリックでプロフィールへ） -->
            <a href="{{ route('user.profile', ['id' => $user->id]) }}">
                <img src="{{ asset('storage/images/' . $user->icon_image) }}" alt="{{ $user->name }}のアイコン" class="user-icon">
            </a>

            <!-- 投稿内容 -->
            <div class="post-content">
                <p>{{ $post->post }}</p>

                <!-- 編集ボタン (自分の投稿のみ表示) -->
                @if(Auth::id() == $post->user_id)
                    <button onclick="openEditModal({{ $post->id }}, @json($post->post))">編集</button>
                @endif
            </div>
        </div>
    @endforeach
@endforeach


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
