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
}
