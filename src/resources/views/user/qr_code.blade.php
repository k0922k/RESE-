<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QRコード生成</title>
</head>
<body>
    <h1>QRコード生成</h1>
    @if(isset($qrCode))
        <div>
            {!! $qrCode !!}
        </div>

        <form action="{{ route('validate.qr_code') }}" method="POST">
            @csrf
            <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
            <button type="submit">Validate QR Code</button>
        </form>
    @else
        <p>QRコードを生成するためのデータがありません。</p>
    @endif
</body>
</html>
