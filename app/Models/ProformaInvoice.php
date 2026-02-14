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
        'currency_id'
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
    public function terms_conditions()
    {
        return $this->hasMany(ProformaInvoiceTerms::class, 'proforma_invoice_id')->orderBy('serial_no', 'asc');
    }
    public function payment_terms()
    {
        return $this->belongsTo(Payment_terms::class, 'payments_terms_id');
    }
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
}
