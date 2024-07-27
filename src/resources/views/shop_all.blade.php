@extends('layouts.common')

@section('title', 'Rese')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/shop_all.css') }}" />
@endsection

@section('content')
<div class="flex__item">
    @if(count($shops) > 0)
        @foreach($shops as $shop)
        <div class="practice__card">
            <div class="card__img">
                <img src="{{ $shop['image_url'] }}" alt="{{ $shop['genre'] }}" />
            </div>
            <div class="card__content">
                <h2 class="card__ttl">{{ $shop['name'] }}</h2>
                <div class="tag">
                    <p class="card__tag">#{{ $shop['area'] }}</p>
                    <p class="card__tag">#{{ $shop['genre'] }}</p>
                </div>
                <div class="button-heart-container">
                    <a href="{{ route('shop.detail', ['shop_id' => $shop['id']]) }}" class="card__but">詳しく見る</a>
                    <form action="{{ route('shop.favorite', ['shop_id' => $shop['id']]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                        <button type="submit" class="favorite-button {{ $shop->isFavoritedByUser(auth()->id()) ? 'favorited' : '' }}">
                            ❤️
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    @else
        <p>No shops found.</p>
    @endif
</div>
@endsection
