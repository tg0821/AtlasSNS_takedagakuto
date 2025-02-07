<x-login-layout>


  <h2>機能を実装していきましょう。</h2>

    @if($followerUsers->isEmpty())
        <p>フォローされているユーザーはいません。</p>
    @else
        <ul class="list-group">
            @foreach($followerUsers as $user)
            <li class="list-group-item d-flex align-items-center">
                <a href="{{ route('user.profile', ['id' => $user->id]) }}">
                @if ($user->icon_image!="icon1.png")
                <img src="{{ asset('storage/images/' . $user->icon_image) }}" alt="User Icon" />
                @else
                <img src="{{ asset('storage/icon1.png') }}" alt="Default Icon" />
                @endif
                </a>
                    <!-- ユーザー名 -->
                    <span>{{ $user->username }}</span>
              </li>
            @endforeach
        </ul>
        @if($posts->isEmpty())
        <p>投稿はありません。</p>
    @else
        @foreach($posts as $post)
            <div class="post">
                <p>{{ $post->post }}</p> <!-- 投稿内容 -->
            </div>
        @endforeach
    @endif
    @endif


</x-login-layout>
