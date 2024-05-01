<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'parent_category_id'];

    protected $hidden = ['created_at', 'updated_at'];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_category_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_category_id');
    }

    public function translations()
    {
        return $this->hasMany(CategoryLanguage::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function media() {
        return $this->belongsTo(CategoryMedia::class, 'category_id');
    }
}
