<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'is_active',
        'created_by',
        'updated_by',
    ];
}
