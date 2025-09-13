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
}
