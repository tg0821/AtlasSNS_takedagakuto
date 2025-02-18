<x-logout-layout>
  <div id="clear">
    <p class=logined>{{ session('username') }}さん</p>
    <p class=welcome>ようこそ！AtlasSNSへ！</p>
    <p class=complete>ユーザー登録が完了いたしました。</p>
    <p class=early>早速ログインをしてみましょう!</p>

    <p class="btn"><a href="login">ログイン画面へ</a></p>
  </div>
</x-logout-layout>
