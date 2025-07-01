<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $fillable = [
        'project_name',
        'start_date',
        'end_date',
        'created_by',
        'status_id'
    ];

    // one project has many tasks
    public function task(){
        return $this->hasMany(Task::class);
    }

    // Project belongs to a single creator (user)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Project belongs to many users (if shared/collaborative)
    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user', 'project_id', 'user_id');
    }

    // Project belongs to a status
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
