<x-login-layout>

  <h2>機能を実装していきましょう。</h2>
    @if($followingUsers->isEmpty())
        <p>フォローしているユーザーはいません。</p>
    @else
        <ul class="list-group">
            @foreach($followingUsers as $user)
                <li class="list-group-item d-flex align-items-center">
                    <!-- ユーザーアイコン -->
                    <!-- <img src="{{ asset('images/icon1.png') }}"
                         alt="ユーザーアイコン"
                         class="rounded-circle"
                         style="width: 40px; height: 40px; margin-right: 10px;"> -->
<!-- 11~14をフォローしているユーザーがプロフィール編集した後もいろんな画像になるように変更 -->
            <!-- <img src="{{ asset('storage/images/' . $user->icon_image) }}"
                 alt="ユーザーアイコン"
                 class="rounded-circle"
                 style="width: 40px; height: 40px; margin-right: 10px;"> -->
                 <a href="{{ route('user.profile', ['id' => $user->id]) }}">
                 @if ($user->icon_image!="icon1.png")
                 <img src="{{ asset('storage/images/' . $user->icon_image) }}" alt="User Icon" />
                 @else
                 <img src="{{ asset('storage/icon1.png') }}" alt="Default Icon" />
                 @endif
                 </a>
            <!-- ユーザー名などの他の情報 -->
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
