<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderTerms extends Model
{
    //
    protected $fillable = [
        'purchase_order_id',
        'term_description',
        'serial_no',
        // Add other fields as needed
    ];
    public function purchase_order()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }   

}
