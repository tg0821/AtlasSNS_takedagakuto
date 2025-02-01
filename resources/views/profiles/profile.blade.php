<x-login-layout>

<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
 @if (Auth::user()->icon_image)
    <img src="{{ asset('images/' . Auth::user()->icon_image) }}" alt="User Icon" />
@else
    <img src="{{ asset('images/icon1.png') }}" alt="Default Icon" />
@endif
        <div>
            <label for="username">ユーザー名</label>
            <input type="text" name="username" id="username" value="{{ old('username', Auth::user()->username) }}" required>
        </div>

        <div>
            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" required>
        </div>

        <!-- 現在のパスワード（非表示で送信） -->
        <input type="hidden" name="current_password" value="{{-- Auth::user()->password --}}">

        <div>
            <label for="password">パスワード</label>
            <input type="password" name="password" id="password" value="{{-- Auth::user()->password --}}" >
        </div>

        <div>
            <label for="password_confirmation">パスワード確認</label>
            <input type="password" name="password_confirmation" id="password_confirmation" value="{{-- Auth::user()->password --}}" >
        </div>

        <div>
            <label for="bio">自己紹介</label>
            <!-- <textarea name="bio" id="bio">{{ old('bio' , Auth::user()->bio) }}</textarea> -->
            <input type="text" name="bio" id="bio" value="{{ old('bio', Auth::user()->bio) }}" required>
        </div>

        <div>
            <label for="icon">アイコン画像</label>
            <input type="file" name="icon" id="icon" accept="image/*">
            @if(Auth::user()->icon)
                <img src="{{ asset('storage/images/' . Auth::user()->icon) }}" alt="現在のアイコン" width="100">
            @endif
        </div>

        <button type="submit">更新</button>
    </form>

    <!-- これを入れると必須項目が書かれてなかったとき、エラーコードが出る（英語ver） -->
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
