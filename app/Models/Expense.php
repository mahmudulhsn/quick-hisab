<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $casts = [
        'product_id' => 'array',
    ];
    protected $fillable = [
        'amount', 'purpose', 'expense_by', 'date_time', 'expense_type', 'product_id'
    ];
}
