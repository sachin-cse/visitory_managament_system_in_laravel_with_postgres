<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
