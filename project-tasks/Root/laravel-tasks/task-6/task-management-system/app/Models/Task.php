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

    
    // Task belongs to a project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Task is assigned to a user
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // Task is assigned by a user
    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    // Task has a status
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
