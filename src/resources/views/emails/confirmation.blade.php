<form action="{{route('user.create')}}" method="POST">
    @csrf
    <label class="row form-label">ユーザ名</label><input class="row form-input" type="text" name="name">
    <label class="row form-label">メールアドレス</label><input class="row form-input" type="text" name="email">
    <label class="row form-label">パスワード</label><input class="row form-input" type="password" name="password">
    <div class="row">
        <input class="form-button" type="submit" value="登録">
    </div>
</form>
