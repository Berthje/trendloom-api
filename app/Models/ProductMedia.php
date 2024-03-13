<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMedia extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'image_url', 'is_primary'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
