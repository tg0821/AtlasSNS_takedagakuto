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
        </div>
        <div class="form-group mt-2">
            <button type="submit" class="btn btn-primary"><img src="{{ asset('images/search.png') }}"></button>
            <!-- 検索ワードがある場合は隣に表示 -->
            @if(request('query'))
                <span class="ml-2">検索ワード: {{ request('query') }}</span>
            @endif
        </div>
    </form>

    <!-- 検索結果 -->
    <h2 class="mt-4">検索結果</h2>
    @if($users->isEmpty())
        <p>該当するユーザーが見つかりませんでした。</p>
    @else
        <ul class="list-group">
            @foreach($users as $user)
                <li class="list-group-item d-flex align-items-center">
                    <!-- ユーザーアイコン -->
                    <img src="{{ asset('images/icon1.png') }}"
                    alt="ユーザーアイコン"
                    class="rounded-circle"
                    style="width: 40px; height: 40px; margin-right: 10px;"
                >
                    <!-- ユーザー名 -->
                    <span>{{ $user->username }}</span>
                    <!-- フォロー/フォロー解除ボタン -->
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
                </li>
            @endforeach
        </ul>
    @endif
</x-login-layout>
