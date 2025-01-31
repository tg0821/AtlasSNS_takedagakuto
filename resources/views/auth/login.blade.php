<x-logout-layout>
  <!-- 適切なURLを入力してください -->
  {!! Form::open(['url' => 'login']) !!}
  <p>AtlasSNSへようこそ</p>

  <!-- 括弧の中の引数３番のものはclass名になっている -->
   <div class="form-group">
  {{ Form::label('メールアドレス') }}
  <br>
  {{ Form::text('email',null,['class' => 'input']) }}
  </div>

  <div class="form-group">
  {{ Form::label('パスワード') }}
  <br>
  {{ Form::password('password',['class' => 'input']) }}
  </div>

  {{ Form::submit('ログイン') }}

<!-- <br> -->
  <p class="register-link"><a href="register">新規ユーザーの方はこちら</a></p>

  {!! Form::close() !!}
</x-logout-layout>
