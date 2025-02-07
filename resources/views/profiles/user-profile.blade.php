<x-login-layout>
  <!-- 相手のアイコンと名前と自己紹介が出てくる -->

<!-- <img src="{{ asset('storage/images/' . $user->icon_image) }}" alt="User Icon" class="rounded-circle" width="100"> -->
        @if ($user->icon_image!="icon1.png")
        <img src="{{ asset('storage/images/' . $user->icon_image) }}" alt="User Icon" />
        @else
        <img src="{{ asset('storage/icon1.png') }}" alt="Default Icon" />
        @endif
        <h2>ユーザー名{{ $user->username }}</h2>
        <p>自己紹介{{ $user->bio }}</p>
<!-- フォローとフォロー解除ボタンの設置 -->
            @if(auth()->user()->following->contains($user))
            <form action="{{ route('unfollow', $user) }}" method="POST" class="ml-auto">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">フォロー解除</button>
            </form>
            @else
            <form action="{{ route('follow', $user) }}" method="POST" class="ml-auto">
            @csrf
            <button type="submit" class="btn btn-primary btn-sm">フォロー</button>
            </form>
            @endif
　　　</div>
 <h3>投稿一覧</h3>
    @foreach ($user->posts as $post)
        <div class="card my-2">
            <div class="card-body">
                <p>{{ $post->content }}</p>
                <small class="text-muted">{{ $post->created_at }}</small>
            </div>
        </div>
    @endforeach
</div>

</x-login-layout>
