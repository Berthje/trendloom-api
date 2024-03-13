<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductLanguage extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'language_id', 'name', 'description', 'price', 'tags'];

    protected $casts = [
        'tags' => 'array',
    ];
}
