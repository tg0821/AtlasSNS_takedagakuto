<x-login-layout>

<!-- ここで投稿フォーム編集　バリデーションはPostsController.phpで編集 -->
 {{ Form::open(['url' => '/post/create']) }}
 <div class="post-container">
 <!-- ログインしているユーザーのアイコン -->
@if (Auth::user()->icon_image!="icon1.png")
<img src="{{ asset('storage/images/' . Auth::user()->icon_image) }}" alt="User Icon" class ="user-icon" />
@else
<img src="{{ asset('storage/icon1.png') }}" alt="Default Icon" class ="user-icon"/>
@endif
  <!-- placeholderでテキストボックスの中に必要な情報をいれることができる。今回は投稿内容を入力してくださいとうテキスト -->
  {{ Form::text('post',null,['class' => 'posts-box','placeholder' => '投稿内容を入力してください']) }}
  <button id="bottom"><img src="{{ asset('images/post.png') }}" class="post-bottom"></button>
  {{ Form::close() }}
</div>
<!-- 上の投稿ボタンを押した後の投稿内容を見れるようにする -->
 <!-- <h2>投稿一覧</h2> -->
    @if($posts->isEmpty())
    <p>投稿はありません。</p>
@else
    @foreach($posts as $post)
        <div class="post">
          @if (Auth::check() && Auth::id() == $post->user->id)
    <!-- 自分のプロフィールへ遷移 -->
    <a href="{{ url('profile') }}" class="pro-link">
@else
    <!-- 他のユーザーのプロフィールへ遷移 -->
    <a href="{{ route('user.profile', ['id' => $post->user->id]) }}" class="pro-link">
@endif
            <!-- 投稿者のアイコン -->
    @if ($post->user->icon_image && $post->user->icon_image != "icon1.png")
        <img src="{{ asset('storage/images/' . $post->user->icon_image) }}" alt="{{ $post->user->name }}のアイコン" class="post-user-icon">
    @else
        <img src="{{ asset('storage/icon1.png') }}" alt="デフォルトアイコン" class="post-user-icon">
    @endif
    </a>
            <div class="post-box">
            <p class="post-name" >{{$post->user->username}}</p>
            <!-- 投稿内容 -->
            <p class="post-containers" id="post-text-{{ $post->id }}">{{ $post->post }}</p>
            </div>
            <div class="post-list">
              <p class="post-time">{{ $post->created_at->format('Y-m-d H:i') }}</p>
              <!-- 自分の投稿のみ、編集・削除ボタンを表示 -->
              @if(Auth::check() && Auth::id() == $post->user_id)
                <div class="post-actions">
                  <!-- 編集ボタン -->
                  <button class="button js-modal-button" data-id="{{ $post->id }}" data-text="{{ $post->post }}">
                    <img src="{{ asset('images/edit.png') }}" class="edit-bottom">
                  </button>
                  <!-- 編集モーダル -->
                  <div id="editModal" class="modal" style="display: none;">
                    <div class="modal-edit">
                      <span class="close">&times;</span>
                      {!! Form::open(['url' => '', 'method' => 'POST', 'id' => 'editForm']) !!}
                      {{ Form::hidden('_method', 'PUT') }}
                      {{ Form::hidden('post_id', null, ['id' => 'post_id']) }}
                      {{ Form::text('post', null, ['id' => 'edit_post', 'class' => 'posts-content']) }}
                        <button type="submit"class="edit">
                          <img src="{{ asset('images/edit.png') }}" class="edit-bottom">
                        </button>
                      {!! Form::close() !!}
                    </div>
                  </div>
                  <!-- 削除確認モーダル -->
                  <div id="deleteModal-{{ $post->id }}" class="modal delete-modal" data-post-id="{{ $post->id}}">
                    <div class="modal-content">
                      <p class="text-delete">この投稿を削除します。よろしいでしょうか？</p>
                      <button id="confirmDelete-{{ $post->id }}" class="confirmDelete" data-post-id="{{ $post->id }}">OK</button>
                      <button id="cancelDelete-{{ $post->id }}" class="cancelDelete" data-post-id="{{ $post->id }}">キャンセル</button>
                    </div>
                  </div>
        <!-- 削除フォーム（投稿ごとに異なる ID を付与） -->
        {!! Form::open(['url' => '/post/delete', 'method' => 'POST', 'class' => 'delete-form', 'id' => 'deleteForm-' . $post->id]) !!}
        {{ Form::hidden('_method', 'DELETE') }}
        {{ Form::hidden('post_id', $post->id) }}
        {!! Form::close() !!}
                     <button class="btn-delete" data-post-id="{{ $post->id }}">
                      <img src="{{ asset('images/trash-h.png') }}" alt="削除" class="normal">
                      <img src="{{ asset('images/trash.png') }}" class="hover">
                     </button>
                    {!! Form::close() !!}
                </div>
            @endif
            </div>
        </div>
    @endforeach
@endif



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
