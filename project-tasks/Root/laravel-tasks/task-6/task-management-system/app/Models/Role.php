<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $fillable = [
        'role_name'
    ];

    // one role has many users
    public function users()
    {
        return $this->hasMany(User::class);
    }

    
}
