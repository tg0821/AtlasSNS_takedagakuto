<x-login-layout>

<!-- 検索フォーム -->
    <form action="{{ route('search') }}" method="GET">
      @csrf
        <div class="form-group">
            <input
                type="text"
                name="query"
                class="form-control"
                placeholder="ユーザー名"
                value="{{ request('query') }}">

         <div class="serch-group">
            <button type="submit" class="serch-bottom">
                <img src="{{ asset('images/search.png') }}" class="serch-picture">
            </button>
            <!-- 検索ワードがある場合は隣に表示 -->
            @if(request('query'))
                <div class="ml-2">検索ワード: {{ request('query') }}</div>
            @endif
         </div>
        </div>
    </form>

    <!-- 検索結果 -->
    @if($users->isEmpty())
        <p>該当するユーザーが見つかりませんでした。</p>
    @else
        <ul class="serch-list">
            @foreach($users as $user)
                <li class="serch-list-group">
            <a href="{{ route('user.profile', ['id' => $user->id]) }}">
            @if ($user->icon_image!="icon1.png")
            <img src="{{ asset('storage/images/' . $user->icon_image) }}" alt="User Icon"class="serch-icon"/>
            @else
            <img src="{{ asset('storage/icon1.png') }}" alt="Default Icon" class="serch-icon"/>
            @endif
            </a>
            <!-- ユーザー名 -->
            <span class="serch-name">{{ $user->username }}</span>
            <!-- フォロー/フォロー解除ボタン -->
            @if(auth()->user()->following->contains($user))
            <form action="{{ route('unfollow', $user) }}" method="POST" class="ml-auto">
            @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-follow">フォロー解除</button>
                </form>
            @else
                <form action="{{ route('follow', $user) }}" method="POST" class="ml-auto">
                    @csrf
                    <button type="submit" class="come-follow">フォローする</button>
                </form>
            @endif
                </li>
            @endforeach
        </ul>
    @endif
</x-login-layout>
