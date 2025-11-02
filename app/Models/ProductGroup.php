<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductGroup extends Model
{
    
    protected $fillable = [
        'name',
        'slug',
        'description',
        'code',
        'internal_code',
        'featured_image',
        'show_as_featured',
        'is_active',
        'created_by',
        'updated_by',
    ];
    public function categories()
    {
        return $this->hasMany(ProductCategory::class, 'group_id')->with('sub');
    }

    public function featured_products()
    {
        return $this->hasMany(Product::class, 'group_id')->where('show_as_featured', 1)->where('is_active', 1)->limit(12);
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'group_id')->where('is_active', 1);
    }
}
