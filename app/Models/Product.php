<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'product_name',
        'product_price',
        'product_photo',
        'product_description',
        'is_active'
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
