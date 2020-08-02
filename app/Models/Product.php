<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description'];

    /**
     * Get the stocks for the product.
     */
    public function stocks()
    {
        return $this->hasMany('App\Models\Stock');
    }
}
