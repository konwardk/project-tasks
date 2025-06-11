<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    //
    protected $fillable = [
        'uploadfile',
        'user_id'
    ];


    //relation
    public function user() {
        return $this->belongsTo(User::class);
    }
}
