<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProformaInvoice extends Model
{
    protected $fillable = [
        'pi_number',
        'customer_id',
        'buyer_id',
        'refference_number',
        'description',
        'pi_date',
        'pi_expire_date',
        'payments_terms_id',
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function buyer()
    {
        return $this->belongsTo(Buyers::class, 'buyer_id');
    }
    public function details()
    {
        return $this->hasMany(ProformaInvoiceDetails::class);
    }
}
