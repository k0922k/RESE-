<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        $menuRoute = 'menu2';
        return view('auth.register', compact('menuRoute'));
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $adminRole = Role::where('slug', 'admin')->first();
        $userRole = Role::where('slug', 'user')->first();

        $isAdmin = $request->has('admin_role') && $request->input('admin_role') == '1';

        DB::transaction(function () use ($data, $isAdmin, $adminRole, $userRole) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            if ($isAdmin && $adminRole) {
                $user->roles()->attach($adminRole->id);
            } elseif ($userRole) {
                $user->roles()->attach($userRole->id);
            }

            Auth::login($user);
        });

        $redirectRoute = $isAdmin ? 'home' : 'thanks';

        return redirect()->route($redirectRoute)->with('success', '登録が完了しました');
    }

    public function thanks()
    {
        $menuRoute = 'menu1';
        return view('thanks', compact('menuRoute'));
    }
}
