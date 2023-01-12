<?php

namespace App\Models;

use App\Enums\ProductType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'type' => ProductType::class
    ];

    public function scopeSearch($query, $keyword){
        return $query->where('name', 'LIKE' , '%' . $keyword . '%');
    }
}
