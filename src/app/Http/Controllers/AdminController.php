<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\UserNotificationMail;
use App\Models\Reservation;
use App\Models\Shop;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
        return view('admin.users');
    }

    public function reservations()
    {
        $reservations = Reservation::all();
        return view('admin.reservations', compact('reservations'));
    }

    public function index()
    {
        $representatives = User::whereHas('roles', function ($query) {
            $query->where('slug', 'store_representative');
        })->get();

        return view('admin.store_representatives.index', compact('representatives'));
    }

    public function create()
    {
        $shops = Shop::all();
        return view('admin.store_representatives.create', compact('shops'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:8|max:191',
            'shop_id' => 'required|exists:shops,id',
        ]);

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => 'store_representative',
            'shop_id' => $validatedData['shop_id'],
        ]);

        return redirect()->route('admin.store_representatives')->with('success', '店舗代表者を作成しました。');
    }

    public function edit($id)
    {
        $representative = User::findOrFail($id);
        $shops = Shop::all();
        return view('admin.store_representatives.edit', compact('representative', 'shops'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|max:191',
            'shop_id' => 'required|exists:shops,id',
        ]);

        $representative = User::findOrFail($id);
        $representative->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'shop_id' => $validatedData['shop_id'],
        ]);

        if ($request->filled('password')) {
            $representative->update(['password' => Hash::make($validatedData['password'])]);
        }

        return redirect()->route('admin.store_representatives')->with('success', '店舗代表者を更新しました。');
    }

    public function destroy($id)
    {
        $representative = User::findOrFail($id);
        $representative->delete();

        return redirect()->route('admin.store_representatives')->with('success', '店舗代表者を削除しました。');
    }

    public function sendNotification(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'user_ids' => 'required|array',
        ]);

        $users = User::whereIn('id', $validated['user_ids'])->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new UserNotificationMail($validated['subject'], $validated['message']));
        }

        return redirect()->back()->with('success', 'メールが送信されました');
    }

    public function showSendNotificationForm()
    {
        $users = User::all();
        return view('admin.send_notification', compact('users'));
    }

    public function list()
    {
        $representatives = User::whereHas('roles', function ($query) {
            $query->where('slug', 'store_representative');
        })->get();
        return view('admin.store_representatives.list', compact('representatives'));
    }
}

