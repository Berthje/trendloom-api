<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ['address', 'city', 'state', 'zip', 'type', 'country'];

    protected $hidden = ['created_at', 'updated_at', 'customer_id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
