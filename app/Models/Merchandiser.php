<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Merchandiser extends Model
{
    //
    protected $fillable = [
        'customer_id',
        'name',
        'email',
        'phone',
        'is_active',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
