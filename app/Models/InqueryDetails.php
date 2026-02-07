<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InqueryDetails extends Model
{
    protected $fillable = [
        'inquery_id',
        'product_id',
    ];

    public function inquery()
    {
        return $this->belongsTo(Inquery::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class)->with('group', 'category', 'subCategory', 'galleries');
    }
}
