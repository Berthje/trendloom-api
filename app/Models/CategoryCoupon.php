<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryCoupon extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'coupon_id'];

    protected $hidden = ['created_at', 'updated_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
