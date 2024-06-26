<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherModel extends Model
{
    use HasFactory;

    protected $table = 'teacher';
    protected $guarded = ['_token'];  

    protected $fillabale = [
        'name',
        'gender',
        'phone',
        'gender',
        'dob',
        'profile_image',
        'current_address',
        'permanent_address',
    ];

    

}
