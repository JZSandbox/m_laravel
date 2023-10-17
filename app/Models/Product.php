<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_title',
        'product_desc',
        'product_preview_img',
        'product_price',
    ];

    public function category()
    {
        return $this->belongstoMany(Category::class);
    }
}
