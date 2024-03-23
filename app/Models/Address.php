<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ['address', 'city', 'state', 'zip', 'country'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
