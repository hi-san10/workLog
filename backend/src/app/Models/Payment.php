<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'contractors_id',
        'target_month',
        'amount',
        'payment_method',
    ];
}
