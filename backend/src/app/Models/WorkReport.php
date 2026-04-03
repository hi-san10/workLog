<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkReport extends Model
{
    protected $fillable = [
        'date',
        'contractors_id',
        'work_sites_id',
    ];
}
