<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buyers extends Model
{
    protected $fillable = [
        'country_id',
        'name',
        'country',
        'description',
        'slug',
        'code',
        'internal_code',
        'featured_image',
        'is_active',
        'created_by',
        'updated_by',
    ];
}
