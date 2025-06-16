<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable = [
        'task_name',
        'project_id',
        'start_date',
        'end_date',
        'assigned_to',
        'assigned_by',
        'status_id'
    ];
}
