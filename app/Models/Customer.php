<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Customer extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['first_name', 'last_name', 'email', 'phone_number', 'password', 'address_id', 'preferred_locale'];

    protected $hidden = ['password', 'created_at', 'updated_at'];

    protected $appends = ['is_admin'];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, "customer_roles");
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function isAdmin()
    {
        return $this->roles->contains('name', 'admin');
    }

    public function getIsAdminAttribute()
    {
        return $this->isAdmin();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
