@extends('layouts.admin')

@section('content')
    <h1>店舗代表者編集</h1>
    <form action="{{ route('admin.store_representatives.update', $representative->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">名前:</label>
            <input type="text" name="name" id="name" value="{{ $representative->name }}" required>
        </div>
        <div>
            <label for="email">メールアドレス:</label>
            <input type="email" name="email" id="email" value="{{ $representative->email }}" required>
        </div>
        <div>
            <label for="password">パスワード（必要な場合のみ）:</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <label for="store_id">担当店舗:</label>
            <select name="store_id" id="store_id" required>
                @foreach($stores as $store)
                    <option value="{{ $store->id }}" {{ $store->id == $representative->store_id ? 'selected' : '' }}>{{ $store->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">更新</button>
    </form>
@endsection
