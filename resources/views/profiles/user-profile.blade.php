<x-login-layout>
  <!-- 相手のアイコンと名前と自己紹介が出てくる -->
<!-- <img src="{{ asset('storage/images/' . $user->icon_image) }}" alt="User Icon" class="rounded-circle" width="100"> -->
      <div class="follows-prof">
        @if ($user->icon_image!="icon1.png")
        <img src="{{ asset('storage/images/' . $user->icon_image) }}" alt="User Icon" class="user-prof" />
        @else
        <img src="{{ asset('storage/icon1.png') }}" alt="Default Icon" class="user-prof"/>
        @endif
        <div class="follows-info">
            <div class="follows-name">
        <p>ユーザー名</p>
        <p class="user-prof-name">{{ $user->username}}</p>
            </div>
            <div class="follows-bio">
        <p >自己紹介</p>
        <p class="user-prof-bio">{{ $user->bio }}</p>
        </div>
      </div>
<!-- フォローとフォロー解除ボタンの設置 -->
            @if(auth()->user()->following->contains($user))
            <form action="{{ route('unfollow', $user) }}" method="POST" class="ml-auto">
            @csrf
            @method('DELETE')
            <button type="submit" class="user-delete-follow">フォロー解除</button>
            </form>
            @else
            <form action="{{ route('follow', $user) }}" method="POST" class="ml-auto">
            @csrf
            <button type="submit" class="user-come-follow">フォロー</button>
            </form>
            @endif
      </div>
      @foreach ($user->posts()->orderBy('created_at', 'desc')->get() as $post)
    <div class="card my-2">
        <div class="card-body">
            <!-- 投稿者のアイコン表示 -->
            @if($post->user->icon_image && $post->user->icon_image != "icon1.png")
                <img src="{{ asset('storage/images/' . $post->user->icon_image) }}" alt="{{ $post->user->name }}のアイコン" class="post-user-icon">
            @else
                <img src="{{ asset('storage/icon1.png') }}" alt="デフォルトアイコン" class="post-user-icon">
            @endif

            <!-- 投稿内容 -->
             <div class="post-box">
                <p class="post-name" >{{$user->username}}</p>
            <p>{{ $post->post }}</p>
             </div>
             <div class="post-list">
            <small class="text-muted">{{ $post->created_at->format('Y-m-d H:i') }}</small>
             </div>
        </div>
    </div>
@endforeach



</x-login-layout>
