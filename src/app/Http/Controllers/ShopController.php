<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    public function shop_all()
{
    $shops = Shop::all();
    $areas = Shop::distinct()->pluck('area');
    $genres = Shop::distinct()->pluck('genre');
    $menuRoute = 'menu2';
    return view('shop_all', compact('shops', 'areas', 'genres', 'menuRoute'));
}


    public function showMenu1()
    {
    $menuRoute = 'menu1';
    return view('menu1', compact('menuRoute'));
    }

public function showMenu2()
    {
    $menuRoute = 'menu2';
    return view('menu2', compact('menuRoute'));
    }


    public function showCommon()
    {
    $areas = Shop::select('area')->distinct()->pluck('area')->toArray();
    $genres = Shop::select('genre')->distinct()->pluck('genre')->toArray();

    return view('layouts.common', compact('areas', 'genres'));
    }

    public function search(Request $request)
    {
        $query = Shop::query();

        if ($request->filled('area')) {
            $query->where('area', $request->area);
        }

        if ($request->filled('genre')) {
            $query->where('genre', $request->genre);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $shops = $query->get();
        $areas = Shop::select('area')->distinct()->pluck('area');
        $genres = Shop::select('genre')->distinct()->pluck('genre');

        return view('shop_all', compact('shops', 'areas', 'genres'));
    }

    public function showDetail($shop_id)
    {
        $menuRoute = 'menu2';
        $shop = Shop::findOrFail($shop_id);
        $user = $shop->user;
        $reservations = $shop->reservations()->latest()->first();
        $favoritedByUsers = $shop->favoritedByUsers;

        return view('shop_detail', [
            'shop' => $shop,
            'user' => $user,
            'reservation' => $reservations,
            'favoritedByUsers' => $favoritedByUsers,
            'menuRoute' => $menuRoute,
        ]);
    }

    public function reserve(Request $request, $shop_id)
    {
        $request->validate([
            'reservation_date' => 'required|date',
            'reservation_time' => 'required',
            'number_of_people' => 'required|integer',
        ]);

        Reservation::create([
            'user_id' => Auth::id(),
            'shop_id' => $shop_id,
            'reservation_date' => $request->reservation_date,
            'reservation_time' => $request->reservation_time,
            'number_of_people' => $request->number_of_people,
        ]);

        return redirect()->route('done');
    }

    public function done()
    {
        $menuRoute = 'menu1';
        return view('done', compact('menuRoute'));
    }

    public function toggleFavorite(Request $request, $shop_id)
    {
        $user = auth()->user();

        if ($user->favoriteShops()->where('shop_id', $shop_id)->exists()) {
            $user->favoriteShops()->detach($shop_id);
            return back();
        } else {
            $user->favoriteShops()->attach($shop_id);
            return back();
        }
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'area' => 'required',
        'genre' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $imagePath = $request->file('image')->store('public/images');

    $shop = new Shop();
    $shop->name = $request->input('name');
    $shop->area = $request->input('area');
    $shop->genre = $request->input('genre');
    $shop->image_url = Storage::url($imagePath);
    $shop->save();

    return redirect()->route('shop_all')->with('success', '追加されました');
}

    public function show($shop_id)
    {
        $shop = Shop::findOrFail($shop_id);
        return view('shop_detail', compact('shop'));
    }

    public function create()
    {
        return view('shops.create');
    }
}


