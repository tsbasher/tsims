<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquery extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'company',
        'is_read',
        'is_reply',
    ];

    public function details()
    {
        return $this->hasMany(InqueryDetails::class)->with('product');
    }
}
