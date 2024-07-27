<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>menu2</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
</head>
<body>
    <a href="javascript:history.back()" class="close-icon">
        <i class="fas fa-times"></i>
    </a>

    <div class="shop_menu1-content">
        <ul>
            <li><a href="{{ route('shop_all') }}">Home</a></li>
            <li><a href="{{ route('register') }}">Registration</a></li>
            <li><a href="{{ route('login') }}">Login</a></li>
        </ul>
    </div>
</body>
</html>
