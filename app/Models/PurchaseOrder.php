<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    //

    protected $fillable = [
        'po_number',
        'supplier_id',
        'customer_id',
        'work_order_id',
        'refference_number',
        'description',
        'po_date',
        'payments_terms_id',
        'currency_id',
        // Add other fields as needed
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function work_order()
    {
        return $this->belongsTo(WorkOrder::class, 'work_order_id');
    }
    public function payment_terms()
    {
        return $this->belongsTo(Payment_terms::class, 'payment_terms_id');
    }
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
    public function details()
    {
        return $this->hasMany(PurchaseOrderDetails::class);//->with('work_order','product', 'color', 'style', 'weight_unit', 'quantity_unit');
    }
    public function terms()
    {
        return $this->hasMany(PurchaseOrderTerms::class, 'purchase_order_id')->orderby('serial_no');
    }
    public function receives()
    {
        return $this->hasMany(PurchaseOrderReceive::class, 'purchase_order_id');
    }
}
