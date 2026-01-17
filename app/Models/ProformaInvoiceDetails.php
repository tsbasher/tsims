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
}
