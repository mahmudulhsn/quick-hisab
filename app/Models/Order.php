<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $casts = [
        'product' => 'array',
    ];
    protected $fillable = ['customer_name', 'customer_email', 'customer_phone_no', 'product', 'discount', 'date_time', 'total_amount', 'sub_total_amount'];
}
