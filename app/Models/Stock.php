<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = ['product_id', 'type', 'quantity', 'current_stock', 'total_amount', 'unit_price', 'date_time'];

    /**
     * Get the products that owns the stocks.
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
