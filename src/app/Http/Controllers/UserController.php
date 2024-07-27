<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Shop;
use App\Mail\AuthMail;
use Illuminate\Support\Facades\Mail;
use App\Services\UserService;
use App\Services\TokenService;
use App\Models\User;


class UserController extends Controller
{
    public function mypage()
    {
        $menuRoute = 'menu1';
        if (Auth::check()) {
            $user = Auth::user();
            $user->load(['reservations.shop', 'favoriteShops']);
            return view('mypage', compact('user', 'menuRoute'));
        } else {
            return redirect()->route('login');
        }
    }

    public function cancelReservation($reservation_id)
    {
        Reservation::where('id', $reservation_id)
                    ->where('user_id', Auth::id())
                    ->delete();

        return redirect()->route('mypage');
    }

    public function toggleFavorite($shop_id)
    {
        $user = Auth::user();
        $shop = Shop::find($shop_id);

        if (!$shop) {
            return back()->with('error', '店舗が見つかりませんでした。');
        }

        if ($user->favoriteShops()->where('shop_id', $shop_id)->exists()) {
            $user->favoriteShops()->detach($shop_id);
        } else {
            $user->favoriteShops()->attach($shop_id);
        }

        return back();
    }

    public function create(Request $request)
    {
        $userService = new UserService();
        $userService->create($request);

        $tokenService = new TokenService();
        $tokenService->create($request);

        $email = $request->email;
        $url = request()->getSchemeAndHttpHost(). "/user/register?token=". $tokenService->getToken();

        Mail::to($email)
            ->send(new AuthMail($url));

        return redirect('/join')->with('email', $email);
    }

    public function register(Request $request)
    {
        $tokenService = new TokenService();
        $userService = new UserService();

        $token = $request->token;
        $authResult = $tokenService->matchToken($token);

        if ($authResult == "OK") {
            $email = $tokenService->getEmailByToken($token);
            $userService->changeEmailFlag($email);
            $id = $userService->getIdByEmail($email);

            $request->session()->put('logind', 'true');
            $request->session()->put('id', $id);
            return redirect('/user/' . $id);
        } else if ($authResult == "ALREADY") {
            return redirect('/')->with('message', 'このメールアドレスはすでに認証されています。');
        } else if ($authResult == "WRONG") {
            return redirect('/')->with('message', 'メールアドレス認証に失敗しました。URLを確認してもう一度やり直してください。');
        } else if ($authResult == "EXPIRE") {
            return redirect('/')->with('message', '認証URLの有効期限が切れています。最初からもう一度やり直してください。');
        } else {
            return redirect('/');
        }
    }

    public function showRoles($id)
    {
        $user = User::find($id);
        $roles = $user ? $user->roles : collect();

        return view('user_roles', compact('roles'));
    }
}
