<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'code',
        'internal_code',
        'name',
        'slug',
        'address',
        'country_id',
        'mobile',
        'is_active',
        'created_by',
        'updated_by',
    ];
}
