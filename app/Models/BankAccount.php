<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $fillable = [
        'bank_id',
        'account_name',
        'account_number',
        'branch',
        'branch_address',
        'bin',
        'tin',
        'routing_number',
        'swiftcode',
        'account_for',
        'customer_id',
        'supplier_id',
        // 'slug',
        'created_by',
        'updated_by',
    ];

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
