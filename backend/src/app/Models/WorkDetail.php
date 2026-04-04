<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkDetail extends Model
{
    protected $fillable = [
        'work_reports_id',
        'makers_id',
        'tasks_id',
        'quantity',
    ];
}
