<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class slider extends Model
{
    protected $fillable = [
        'title',
        'sub_title',
        'slug',
        'image',
        'action_button_url',
        'is_active',
        'created_by',
        'updated_by',
    ];
}
