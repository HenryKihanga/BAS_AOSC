<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [

        'user_id','time_in', 'time_out' , 'date'
    ];

    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }
}
