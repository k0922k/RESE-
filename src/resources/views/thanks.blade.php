@extends('layouts.common')

@section('title', 'Thanks')


@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}" />
@endsection

@section('content')
@php
    $hideSearch = true;
@endphp
<div class="thanks-container">
<div class="thanks-box">
    <h2>会員登録ありがとうございます</h2>
    <form action="{{ route('login') }}" method="GET">
        <button type="submit" class="login-button">ログインする</button>
    </form>
</div>
</div>
@endsection
