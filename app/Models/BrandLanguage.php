<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandLanguage extends Model
{
    use HasFactory;

    protected $fillable = ['brand_id', 'language_id', 'name', 'description'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
