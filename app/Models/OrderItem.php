<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'product_id', 'product_size_id', 'product_details', 'quantity', 'price'];

    protected $casts = [
        'product_details' => 'array'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function size() {
        return $this->belongsTo(ProductSize::class, 'product_size_id');
    }
}
