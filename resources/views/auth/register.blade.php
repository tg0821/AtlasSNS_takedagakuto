<x-logout-layout>
    <!-- 適切なURLを入力してください -->
{!! Form::open(['url' => 'register']) !!}

<h2>新規ユーザー登録</h2>
<div class=form-group>
{{ Form::label('username','ユーザー名') }}
{{ Form::text('username',null,['class' => 'input']) }}
</div>
<div class=form-group>
{{ Form::label('メールアドレス') }}
{{ Form::email('email',null,['class' => 'input']) }}
</div>
<div class=form-group>
{{ Form::label('パスワード') }}
{{ Form::password('password',['class' => 'input']) }}
</div>
<div class=form-group>
{{ Form::label('パスワード確認') }}
{{ Form::password('password_confirmation',['class' => 'input']) }}
</div>

{{ Form::submit('新規登録') }}

<p class=login-rink><a href="login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}

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

</x-logout-layout>
