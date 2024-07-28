@extends('layouts.admin')

@section('content')
    <h1>管理者ダッシュボード</h1>

    <div class="dashboard-menu">
        <ul>
            <li>
                <a href="{{ route('admin.users') }}">ユーザー管理</a>
            </li>
            <li>
                <a href="{{ route('admin.store_representatives') }}">店舗代表者管理</a>
            </li>
            <li>
                <a href="{{ route('reservations.index') }}">予約管理</a>
            </li>
            <li>
                <a href="{{ route('admin.sendNotificationForm') }}">通知送信</a>
            </li>
        </ul>
    </div>
@endsection
