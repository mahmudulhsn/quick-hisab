<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'amount', 'purpose', 'expense_by', 'date_time'
    ];
}
