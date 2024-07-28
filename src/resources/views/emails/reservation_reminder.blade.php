<!DOCTYPE html>
<html>
<head>
    <title>予約リマインダー</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/email.css') }}">
</head>
<body>
    <h1>予約リマインダー</h1>
    <p>{{ $reservation->user->name }} 様</p>
    <p>以下の内容でご予約いただいております。</p>
    <ul>
        <li>店舗名: {{ $reservation->store->name }}</li>
        <li>日時: {{ $reservation->date }} {{ $reservation->time }}</li>
        <li>人数: {{ $reservation->number_of_people }} 名</li>
    </ul>
    <p>ご来店をお待ちしております。</p>
</body>
</html>
