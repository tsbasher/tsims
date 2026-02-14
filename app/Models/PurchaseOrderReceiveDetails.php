<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderReceiveDetails extends Model
{
    //
    protected $fillable = [
        'purchase_order_receive_id',
        'purchase_order_detail_id',
        'quantity_received',
        'work_order_detail_id',
    ];
    public function purchase_order_receive()
    {
        return $this->belongsTo(PurchaseOrderReceive::class, 'purchase_order_receive_id');
    }
    public function purchase_order_detail()
    {
        return $this->belongsTo(PurchaseOrderDetails::class, 'purchase_order_detail_id');
    }
    public function work_order_detail()
    {
        return $this->belongsTo(WorkOrderDetails::class, 'work_order_detail_id');
    }   
}
