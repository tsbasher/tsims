<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderReceive extends Model
{
    //
    protected $fillable = [
        'purchase_order_id',
        'receive_number',
        'supplier_id',
        'work_order_id',
        'received_date',
        'description',
    ];
    public function purchase_order()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function work_order()
    {
        return $this->belongsTo(WorkOrder::class);
    }
    public function details()
    {
        return $this->hasMany(PurchaseOrderReceiveDetails::class, 'purchase_order_receive_id')->with('purchase_order_detail', 'work_order_detail');
    }
}
