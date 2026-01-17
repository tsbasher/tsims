<?php

namespace App\Models;

use App\Http\Controllers\MerchandiserController;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    //
    protected $fillable = [
        'order_number',
        'customer_id',
        'buyer_id',
        'merchandiser_id',
        'refference_number',
        'description',
        'order_date',
        'delivery_date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function buyer()
    {
        return $this->belongsTo(Buyers::class, 'buyer_id');
    }
    public function merchant()
    {
        return $this->belongsTo(Merchandiser::class, 'merchandiser_id');
    }

    public function details()
    {
        return $this->hasMany(WorkOrderDetails::class, 'work_order_id')->with('product','color','style','weightUnit','quantityUnit');
    }
}
