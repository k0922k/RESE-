@extends('layouts.admin')

@section('content')
    <h1>新規店舗代表者作成</h1>
    <form action="{{ route('admin.store_representatives.store') }}" method="POST">
        @csrf
        {{ method_field('PUT') }}

        <div>
            <label for="name">名前:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="email">メールアドレス:</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="password">パスワード:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <label for="store_id">担当店舗:</label>
            <select name="store_id" id="store_id" required>
                @foreach($stores as $store)
                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">作成</button>
    </form>
@endsection