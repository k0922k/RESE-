@extends('layouts.common')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/done.css') }}" />
@endsection

@section('content')
@php
    $hideSearch = true;
@endphp
<div class="done-container">
<div class="done-box">
    <h2>ご予約ありがとうございます</h2>
    <form action="{{ route('shop_all') }}" method="GET">
        <button type="submit" class="done-button">戻る</button>
    </form>
</div>
</div>
@endsection
