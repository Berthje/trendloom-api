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

    public function translations()
    {
        return $this->hasMany(BrandLanguage::class);
    }
}
