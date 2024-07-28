@extends('layouts.app')

@section('content')
<div class="container">
    <h1>お知らせメール送信</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.sendNotification') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="subject">件名</label>
            <input type="text" id="subject" name="subject" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="message">メッセージ</label>
            <textarea id="message" name="message" class="form-control" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <label for="user_ids">ユーザー</label>
            <select id="user_ids" name="user_ids[]" class="form-control" multiple required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">送信</button>
    </form>
</div>
@endsection
