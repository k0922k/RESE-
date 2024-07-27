<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Token;
use DateTime;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class TokenService
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function generateToken(Request $request)
    {
        // リクエストからメールアドレスを取得
        $email = $request->email;

        // 現在の日時を取得
        $now = new DateTime();
        $now->format("Y-m-d H:i:s");

        // 有効期限を計算(30分とする)
        $expire_at = $now->modify('+30 minutes');

        // トークンを生成
        $tokenString = Str::random(60);

        // トークンをDBに保存
        $token = new Token();
        $token->token = $tokenString;
        $token->email = $email;
        $token->expire_at = $expire_at;
        $token->save();

        return $tokenString;
    }

    public function matchToken($token)
    {
        $now = new DateTime();

        // トークンを検索
        $data = Token::where('token', $token)->first();

        // トークンチェック
        if (is_null($data)) {
            return "WRONG";
        } else if ($data->auth_flag) {
            return "ALREADY";
        }

        $expire_date = new DateTime($data->expire_at);

        // 認証処理
        if ($now < $expire_date) {
            DB::transaction(function () use ($data) {
                $data->auth_flag = true;
                $data->save();
            });
            return "OK";
        } else {
            // 有効期限が切れている場合の処理
            DB::transaction(function () use ($data, $token) {
                $email = $data->email;
                Token::where('token', $token)->delete();
                $this->userService->deleteByEmail($email);
            });
            return "EXPIRE";
        }
    }

    public function getEmailByToken($token)
    {
        $data = Token::where('token', $token)->first();
        return $data ? $data->email : null;
    }
}
