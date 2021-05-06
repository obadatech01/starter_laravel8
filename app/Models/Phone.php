<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'phone',
        'user_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    ###########Begin Relations##########

     public function user()
     {
         return $this->belongsTo('App\Models\User', 'user_id');
     }

    ###########End Relations##########
}
