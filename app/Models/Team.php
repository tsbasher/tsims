<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'designation_id',
        'name',
        'description',
        'photo',
        'facebook_url',
        'instagram_url',
        'x_url',
        'linkedin_url',
        'is_active',
        'created_by',
        'updated_by',
    ];
    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }
}
