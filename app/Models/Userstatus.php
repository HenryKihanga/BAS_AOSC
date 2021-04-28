<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userstatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fingerprint_id',
        'enrollement_status',
        'middle_name',
        'delete_status',
        
    ];
}
