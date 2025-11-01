<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    //
    protected $fillable = [
        'logo',
        'company_name',
        'head_address',
        'china_address',
        'factory_address',
        'phone',
        'email',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'contact_notification_email',
        'updated_by'
    ];
}
