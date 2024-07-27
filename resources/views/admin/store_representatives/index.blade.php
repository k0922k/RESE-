@extends('layouts.common')
@section('title', '予約一覧')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
@php
    $hideSearch = true;
@endphp

@if (auth()->user()->hasRole('admin'))
<div class="container">
    <h1>予約一覧</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>日付</th>
                <th>時間</th>
                <th>人数</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->reservation_date }}</td>
                    <td>{{ $reservation->reservation_time }}</td>
                    <td>{{ $reservation->number_of_people }}</td>
                    <td>
                        <form action="{{ route('reservation.cancel', $reservation->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">キャンセル</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
    <p>このページにアクセスする権限がありません。</p>
@endif
@endsection
