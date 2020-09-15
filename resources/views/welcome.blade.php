<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    <title>第一営業支援</title>
</head>

<body class="login">
    <header>
        <div>
            <section id="siteID">
                <h1>第一学習社HS</h1>
                <h2>営業支援システム</h2>
            </section>
        </div>
    </header>
    <main>
        <form method="post" name="login_form" id="login_form" action="{{ route('login') }}" autocomplete="off">
            @csrf
             @if (session('flash_message'))
            <div class="flash_message">
                 <ul><li style="color: red;">{{ session('flash_message') }}</li></ul>
            </div>
        @endif
            @if ($errors->has('user_id'))
            <ul><li style="color: red;">{{ $errors->first('user_id') }}</li></ul>
            @endif
            <p><label>ユーザー名：@if(!session('logout'))<input type="text" name="user_id"></label></p>@endif
            @if ($errors->has('login_password'))
            <ul><li style="color: red;">{{ $errors->first('login_password') }}</li></ul>
            @endif
            <p><label>パスワード：@if(!session('logout'))<input type="password" name="login_password"></label></p>@endif
           <p>@if(!session('logout'))<button type="submit" class="loginbutton" id="login"><span>ログイン</span></button>@endif</p>
           <input type="hidden" name="location" value="" id="location">
        </form>
    </main>

    <script type="text/javascript">
    if (navigator.geolocation) {
        // 現在の位置情報取得を実施
        navigator.geolocation.getCurrentPosition(
        // 位置情報取得成功時
        function (pos) { 
                var location =　"緯度：" + pos.coords.latitude + ",";
                location += "経度：" + pos.coords.longitude;
                document.getElementById("location").value = location;
        },
        // 位置情報取得失敗時
        function (pos) { 
                var location ="<li>位置情報が取得できませんでした。</li>";
                document.getElementById("location").value = location;
        });
    } else {
        window.alert("本ブラウザではGeolocationが使えません");
    }
    </script>
</body>

</html>
