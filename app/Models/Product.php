<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'price', 'sku', 'status', 'ean_barcode', 'brand_id', 'category_id'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function translations()
    {
        return $this->hasMany(ProductLanguage::class);
    }

    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    public function media(){
        return $this->hasMany(ProductMedia::class);
    }

    public function stock() {
        return $this->hasMany(ProductStock::class);
    }
}
