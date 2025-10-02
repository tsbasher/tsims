<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'code',
        'internal_code',
        'is_active',
        'created_by',
        'updated_by',
    ];
}
