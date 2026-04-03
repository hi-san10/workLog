<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkDetail extends Model
{
    protected $fillable = [
        'dairy_reports_id',
        'makers_id',
        'tasks_id',
        'quantity',
    ];
}
