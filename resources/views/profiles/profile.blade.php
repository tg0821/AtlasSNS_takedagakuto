<x-login-layout>

<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="user-info-container">
    <!-- ユーザーアイコン -->
        @if (Auth::user()->icon_image != "icon1.png")
            <img src="{{ asset('storage/images/' . Auth::user()->icon_image) }}" alt="User Icon" class="prof-icon"/>
        @else
            <img src="{{ asset('storage/icon1.png') }}" alt="Default Icon" class="prof-icon"/>
        @endif

    <!-- 入力フォーム -->
    <div class="user-form">
        <div >
            <label for="username">ユーザー名</label>
            <input type="text" name="username" id="username" value="{{ old('username', Auth::user()->username) }}" required>
        </div>

        <div >
            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" required>
        </div>

        <div >
            <label for="password">パスワード</label>
            <input type="password" name="password" id="password">
        </div>

        <div>
            <label for="password_confirmation">パスワード確認</label>
            <input type="password" name="password_confirmation" id="password_confirmation">
        </div >

        <div >
            <label for="bio">自己紹介</label>
            <input type="text" name="bio" id="bio" value="{{ old('bio', Auth::user()->bio) }}" required>
        </div>

        <div class="up-icon" >
            <label for="icon">アイコン画像</label>
            <input type="file" name="icon" id="icon" accept="image/*">
        </div>


        <div>
        <button type="submit" class="up-datebotton">更新</button>
        </div>
    </div>
</div>

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
