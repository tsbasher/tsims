<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDetails extends Model
{
    //
    protected $fillable = [
        'purchase_order_id',
        'work_order_details_id',
        'product_id',
        'color_id',
        'style_id',
        'measurement',
        'weight',
        'weight_unit_id',
        'quantity',
        'quantity_unit_id',
        'description',
        'unit_price',
        'total_price',
        // Add other fields as needed
    ];

    public function purchase_order()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }   
    public function work_order()
    {
        return $this->belongsTo(WorkOrder::class, 'work_order_id');
    }
    public function work_order_details()
    {
        return $this->belongsTo(WorkOrderDetails::class, 'work_order_details_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
    public function style()
    {
        return $this->belongsTo(Style::class, 'style_id');
    }   
    public function weight_unit()
    {
        return $this->belongsTo(Unit::class, 'weight_unit_id');
    }
    public function quantity_unit()
    {
        return $this->belongsTo(Unit::class, 'quantity_unit_id');
    }
    public function receive_details()
    {
        return $this->hasMany(PurchaseOrderReceiveDetails::class, 'purchase_order_detail_id');
    }
}
