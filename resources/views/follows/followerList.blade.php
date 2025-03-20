<x-login-layout>
    @if($followerUsers->isEmpty())
        <p>フォローされているユーザーはいません。</p>
    @else
        <ul class="list-group">
            <li class="list-summary">フォロワーリスト</li>
            @foreach($followerUsers as $user)
            <li class="list-group-item d-flex align-items-center">
                <a href="{{ route('user.profile', ['id' => $user->id]) }}">
                @if ($user->icon_image != "icon1.png")
                <img src="{{ asset('storage/images/' . $user->icon_image) }}" alt="User Icon" class="follower-user"/>
                @else
                <img src="{{ asset('images/icon1.png') }}" alt="Default Icon" class="follower-user"/>
                @endif
                </a>
              </li>
            @endforeach
        </ul>
    @endif

    @if($posts->isEmpty())
    <p>投稿はありません。</p>
@else
    @foreach($posts->reverse() as $post) <!-- ここで逆順に並べ替え -->
        <div class="post">
            <!-- 投稿者のアイコンを表示 -->
            <a href="{{ route('user.profile', ['id' => $post->user->id]) }}">
                @if ($post->user->icon_image != "icon1.png")
                    <img src="{{ asset('storage/images/' . $post->user->icon_image) }}" alt="User Icon" class="post-user-icon"/>
                @else
                    <img src="{{ asset('images/icon1.png') }}" alt="Default Icon" class="post-user-icon"/>
                @endif
            </a>
            <div class="post-box">
             <p class="post-name" >{{$post->user->username}}</p>
             <!-- 投稿内容 -->
             <p class="post-containers" id="post-text-{{ $post->id }}">{{ $post->post }}</p>
            </div>
             <p class="post-time">{{ $post->created_at->format('Y-m-d H:i') }}</p>
        </div>
    @endforeach
@endif

</x-login-layout>
