<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = [
        'group_id',
        'name',
        'description',
        'slug',
        'code',
        'internal_code',
        'featured_image',
        'is_active',
        'show_as_featured',
    ];

    public function group()
    {
        return $this->belongsTo(ProductGroup::class, 'group_id');
    }
    public function sub()
    {
        return $this->hasMany(ProductSubCategory::class, 'category_id');
    }

    public function featured_products()
    {
        return $this->hasMany(Product::class, 'category_id')->where('show_as_featured', 1)->where('is_active', 1)->limit(12);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id')->where('is_active', 1);
    }
}
