<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkOrderDetails extends Model
{
    //
    protected $fillable = [
        'work_order_id',
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
    ];

    public function workOrder()
    {
        return $this->belongsTo(WorkOrder::class, 'work_order_id');
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
    public function weightUnit()
    {
        return $this->belongsTo(Unit::class, 'weight_unit_id');
    }
    public function quantityUnit()
    {
        return $this->belongsTo(Unit::class, 'quantity_unit_id');
    }
}
