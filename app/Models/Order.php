<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'address_id', 'coupon_id', 'order_date', 'status', 'amount_products', 'payment_method', 'shipping_method', 'tracking_number'];
}
