<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransportAgent extends Model
{
    //
    protected $fillable = [
        'driver_name',
        'driver_mobile',
        'vehicle_type',
        'vehicle_number',
        'company_name',
        'company_address',
        'company_mobile',
    ];
}
