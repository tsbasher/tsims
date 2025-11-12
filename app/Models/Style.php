<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    protected $table = 'styles';

    protected $fillable = [
        'buyer_id',
        'customer_id',
        'name',
        'code',
        'internal_code',
        'description',
        'image',
        'is_active',
        'created_by',
        'updated_by',
    ];
    public function buyer()
    {
        return $this->belongsTo(Buyers::class, 'buyer_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
