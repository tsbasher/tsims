<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = [
        'group_id',
        'category_id',
        'sub_category_id',
        'name',
        'description',
        'slug',
        'code',
        'internal_code',
        'featured_image',
        'is_active',
        'show_as_featured',
        'created_by',
        'updated_by',
    ];
    public function group()
    {
        return $this->belongsTo(ProductGroup::class, 'group_id');
    }
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
    public function subCategory()
    {
        return $this->belongsTo(ProductSubCategory::class, 'sub_category_id'); 
    }
}
