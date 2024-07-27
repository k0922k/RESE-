@extends('layouts.common')

@section('title', 'Mypage')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}" />
@endsection

@section('content')
@php
    $hideSearch = true;
@endphp
<h1>{{ $user->name }}さん</h1>

<div class="container">
    <div class="reservation">
        <h2>予約状況</h2>
        @forelse ($user->reservations as $reservation)
            <div class="reservation-card">
                <h3>予約{{ $loop->iteration }}</h3>
                <p>店舗名: {{ $reservation->shop->name }}</p>
                <p>利用日: {{ $reservation->reservation_date }}</p>
                <p>利用時間: {{ $reservation->reservation_time }}</p>
                <form action="{{ route('reservation.update', ['reservation_id' => $reservation->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <label for="reservation_date_{{ $reservation->id }}">利用日:</label>
                    <input type="date" id="reservation_date_{{ $reservation->id }}" name="reservation_date" value="{{ $reservation->reservation_date }}">

                    <label for="reservation_time_{{ $reservation->id }}">利用時間:</label>
                    <input type="time" id="reservation_time_{{ $reservation->id }}" name="reservation_time" value="{{ $reservation->reservation_time }}">

                    <label for="number_of_people_{{ $reservation->id }}">人数:</label>
                    <input type="number" id="number_of_people_{{ $reservation->id }}" name="number_of_people" value="{{ $reservation->number_of_people }}" min="1">

                    <button type="submit" class="update-button">更新</button>
                </form>
                <form action="{{ route('reservation.cancel', ['reservation_id' => $reservation->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="cancel-button">×</button>
                </form>
                <div class="review">
                    <p>レビュー</p>
                    <form action="{{ route('review.store', ['reservation_id' => $reservation->id]) }}" method="POST">
                        @csrf
                        <div class="stars">
                            <span>
                                <input id="review01_{{ $reservation->id }}" type="radio" name="rating" value="5"><label for="review01_{{ $reservation->id }}">★</label>
                                <input id="review02_{{ $reservation->id }}" type="radio" name="rating" value="4"><label for="review02_{{ $reservation->id }}">★</label>
                                <input id="review03_{{ $reservation->id }}" type="radio" name="rating" value="3"><label for="review03_{{ $reservation->id }}">★</label>
                                <input id="review04_{{ $reservation->id }}" type="radio" name="rating" value="2"><label for="review04_{{ $reservation->id }}">★</label>
                                <input id="review05_{{ $reservation->id }}" type="radio" name="rating" value="1"><label for="review05_{{ $reservation->id }}">★</label>
                            </span>
                        </div>
                        <textarea name="comment" placeholder="コメントを入力してください" rows="4"></textarea>
                        <button type="submit" class="review-button">レビューを投稿する</button>
                    </form>
                    @if ($reservation->review)
                        <div class="posted-review">
                            <p>評価: {{ $reservation->review->rating }} / 5</p>
                            <p>コメント: {{ $reservation->review->comment }}</p>
                        </div>
                        @endif
                </div>
            </div>
        @empty
            <p>予約履歴がありません。</p>
        @endforelse
    </div>

    <div class="favorites">
        <h2>お気に入り店舗</h2>
        @forelse ($user->favoriteShops as $shop)
            <div class="shop-card">
                <img src="{{ $shop->image_url }}" alt="{{ $shop->name }}">
                <h3>{{ $shop->name }}</h3>
                <p>#{{ $shop->area }} #{{ $shop->genre }}</p>
                <div class="shop-card-actions">
                    <a href="{{ route('shop.detail', ['shop_id' => $shop['id']]) }}" class="card__but">詳しく見る</a>
                    <form action="{{ route('shop.favorite.toggle', ['shop_id' => $shop['id']]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="favorite-button {{ $user->favoriteShops->contains($shop->id) ? 'favorited' : '' }}">❤️</button>
                    </form>
                </div>
            </div>
        @empty
            <p>お気に入り店舗はありません。</p>
        @endforelse
    </div>
</div>
@endsection
