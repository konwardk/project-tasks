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
}
