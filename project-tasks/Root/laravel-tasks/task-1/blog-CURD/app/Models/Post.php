<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    
    protected $fillable = ['title', 'body', 'user_id'];


    // function to get the user who created the post
    // one post belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
