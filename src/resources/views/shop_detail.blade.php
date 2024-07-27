@extends('layouts.common')

@section('title', 'Shop Detail')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/shop_detail.css') }}" />
@endsection

@section('content')
@php
    $hideSearch = true;
@endphp
<div class="container">
    <div class="shop-detail">
        <div class="shop-info">
            <div class="header">
                <a href="{{ url()->previous() }}" class="back-button"><i class="fas fa-chevron-left"></i></a>
                <h2>{{ $shop->name }}</h2>
            </div>
            <img src="{{ $shop->image_url }}" alt="{{ $shop->name }}">
            <p>{{ $shop->description }}</p>
            <p>#{{ $shop->area }} #{{ $shop->genre }}</p>
        </div>
        <div class="reservation-form">
            <h2>予約</h2>
            <form action="{{ route('shop.reserve', ['shop_id' => $shop->id]) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="reservation_date">日付</label>
                    <input type="date" id="reservation_date" name="reservation_date" required>
                </div>
                <div class="form-group">
                    <label for="reservation_time">時間</label>
                    <select id="reservation_time" name="reservation_time" required>
                        <option value="09:00:00">9:00</option>
                        <option value="12:00:00">12:00</option>
                        <option value="15:00:00">15:00</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="number_of_people">人数</label>
                    <select id="number_of_people" name="number_of_people" required>
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}">{{ $i }}人</option>
                        @endfor
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">予約する</button>
            </form>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
