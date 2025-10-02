<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'code',
        'internal_code',
        'content',
        'featured_image',
        'is_active',
        'created_by',
        'updated_by',
    ];
}
