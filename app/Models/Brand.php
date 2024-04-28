<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'logo_url'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function translations()
    {
        return $this->hasMany(BrandLanguage::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
