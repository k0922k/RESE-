@extends('layouts.common')

@section('title', 'Create Shop')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/create.css') }}" />
@endsection

@section('content')
@php
    $hideSearch = true;
@endphp
<div class="container">
    <h1>新しいお店を追加</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('shop.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">店名:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="area">地域:</label>
            <input type="text" name="area" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="genre">ジャンル:</label>
            <input type="text" name="genre" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="image">画像:</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">作成</button>
    </form>
</div>
@endsection

