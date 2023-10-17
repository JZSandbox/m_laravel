<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_title',
        'category_description',
        'category_preview_img',
        'over_categories_id',
        'order'
    ];

    public function product()
    {
        return $this->belongstoMany(Product::class);
    }

    public function category()
    {
        return $this->belongsTo(OverCategories::class, 'over_categories_id', 'id');
    }
}
