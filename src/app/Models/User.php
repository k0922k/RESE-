<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Shop;
use App\Models\Reservation;
use App\Models\Role;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function shops()
    {
        return $this->hasMany(Shop::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function favoriteShops()
    {
        return $this->belongsToMany(Shop::class, 'favorite_shops', 'user_id', 'shop_id')->withTimestamps();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function hasRole($role)
    {
        return $this->roles()->where('slug', $role)->exists();
    }
}
