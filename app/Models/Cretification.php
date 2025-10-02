<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cretification extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'company_name',
        'id_number',
        'comments',
        'featured_image',
        'is_active',
        'created_by',
        'updated_by',
    ];
}
