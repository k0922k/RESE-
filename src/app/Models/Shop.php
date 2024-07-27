<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'user_id',
        'area',
        'genre',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }


    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'favorite_shops', 'shop_id', 'user_id');
    }

    public function isFavoritedByUser($userId)
    {
        return $this->favoritedByUsers()->where('user_id', $userId)->exists();
    }
}
