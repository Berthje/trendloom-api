<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'email', 'phone_number', 'password', 'address_id'];

    protected $hidden = ['password'];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
