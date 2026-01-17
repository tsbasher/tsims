<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProformaInvoiceTerms extends Model
{
    protected $fillable = [
        'proforma_invoice_id',
        'term_description',
    ];
}
