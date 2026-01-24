<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProformaInvoiceDetails extends Model
{
    protected $fillable = [
        'proforma_invoice_id',
        'work_order_id',
        'product_id',
        'style_id',
        'color_id',
        'measurement',
        'weight',
        'weight_unit_id',
        'quantity',
        'quantity_unit_id',
        'description',
        'unit_price',
        'total_price',
    ];
    public function proformaInvoice()
    {
        return $this->belongsTo(ProformaInvoice::class, 'proforma_invoice_id');
    }
    public function workOrder()
    {
        return $this->belongsTo(WorkOrder::class, 'work_order_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function style()
    {
        return $this->belongsTo(Style::class);
    }
    public function color()
    {
        return $this->belongsTo(Color::class);
    }
    public function quantity_unit()
    {
        return $this->belongsTo(Unit::class, 'quantity_unit_id');
    }
    public function weight_unit()
    {
        return $this->belongsTo(Unit::class, 'weight_unit_id');
    }
}
