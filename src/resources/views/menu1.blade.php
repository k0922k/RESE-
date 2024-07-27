<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>menu1</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
</head>
<body>
    <!-- ボタンを押すと、前のページに遷移 -->
    <a href="javascript:history.back()" class="close-icon">
        <i class="fas fa-times"></i>
    </a>

    <div class="shop_menu1-content">
        <ul>
            <li><a href="{{ route('shop_all') }}">Home</a></li>
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
            </li>
            <li><a href="{{ route('mypage') }}">Mypage</a></li>
        </ul>
    </div>

    <!-- ログアウトフォーム -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</body>
</html>
