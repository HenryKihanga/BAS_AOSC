<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'device_token';
    public $incrementing = false;

    protected $fillable = [
        'device_token','device_name', 'department_id','device_mode', 'device_location'
    ];

    protected $dates = ['deleted_at' , 'date_of_birth'];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function users(){
        return $this->hasMany(User::class , 'device_token');
    }
}
