<!DOCTYPE html>
<html>
<head>
    <title>User Roles</title>
</head>
<body>
    <h1>User Roles</h1>
    @if ($roles->isEmpty())
        <p>役割が見つかりません。</p>
    @else
        <ul>
            @foreach ($roles as $role)
                <li>{{ $role->name }}</li>
            @endforeach
        </ul>
    @endif
</body>
</html>
