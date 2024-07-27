@extends('layouts.admin')

@section('content')
    <h1>店舗代表者一覧</h1>
    <a href="{{ route('admin.store_representatives.create') }}">新規作成</a>
    <table>
        <thead>
            <tr>
                <th>名前</th>
                <th>メールアドレス</th>
                <th>担当店舗</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($representatives as $representative)
                <tr>
                    <td>{{ $representative->name }}</td>
                    <td>{{ $representative->email }}</td>
                    <td>{{ $representative->store->name }}</td>
                    <td>
                        <a href="{{ route('admin.store_representatives.edit', $representative->id) }}">編集</a>
                        <form action="{{ route('admin.store_representatives.destroy', $representative->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
