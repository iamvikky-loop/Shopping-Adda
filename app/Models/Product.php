<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [

        'category_id',
        'sub_category_id',
        'brand_id',

        'name',
        'slug',
        'sku',

        'description',

        'price',
        'sale_price',
        'stock',

        'thumbnail',

        'featured',
        'trending',
        'status',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

   public function variants()
{
    return $this->hasMany(ProductVariant::class)
        ->with([
            'attributes.attribute',
            'attributes.value',
            'images'
        ]);
}
}