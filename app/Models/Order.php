<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'address_id', 'coupon_id', 'order_date', 'status', 'total_price', 'amount_products', 'payment_method', 'shipping_method', 'tracking_number'];
    protected $hidden = ['customer_id', 'address_id', 'coupon_id', 'created_at', 'updated_at'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class)->whereHas('product', function ($query) {
            $query->whereNull('deleted_at');
        });
    }
}
