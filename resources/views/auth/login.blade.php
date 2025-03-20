<x-logout-layout>
  <!-- 適切なURLを入力してください -->
  {!! Form::open(['url' => 'login']) !!}
  <h2>AtlasSNSへようこそ</h2>

  <!-- 括弧の中の引数３番のものはclass名になっている -->
   <div class="form-group">
  {{ Form::label('メールアドレス') }}
  {{ Form::text('email',null,['class' => 'input']) }}
  </div>

  <div class="form-group">
  {{ Form::label('パスワード') }}
  {{ Form::password('password',['class' => 'input']) }}
  </div>

  {{ Form::submit('ログイン') }}

<!-- <br> -->
  <p class="register-link"><a href="register">新規ユーザーの方はこちら</a></p>

  {!! Form::close() !!}
</x-logout-layout>
