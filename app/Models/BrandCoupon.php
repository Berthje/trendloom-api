<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandCoupon extends Model
{
    use HasFactory;

    protected $fillable = ['brand_id', 'coupon_id'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
