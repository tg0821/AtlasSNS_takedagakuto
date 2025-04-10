<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <!--IEブラウザ対策-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="ページの内容を表す文章" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title></title>

        <!-- cssのリンク先情報、下にかけてCSSの適用レベルが強くなる。つまり一番強いのはlogout.css -->
        <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/logout.css') }} ">
        <!--スマホ,タブレット対応-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--サイトのアイコン指定-->
        <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
        <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
        <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
        <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
        <!--iphoneのアプリアイコン指定-->
        <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    </head>
    <body>
        <header>
            <h1><a href="login"><img src="images/atlas.png" class="logo-image"></a></h1>
            <h2><p class="top">Social Network Service</p></h2>
        </header>
        <div id="container">
            {{ $slot }}
        </div>
        @if($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
    @endif
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="JavaScriptファイルのURL"></script>
        <script src="JavaScriptファイルのURL"></script>
    </body>
</html>
