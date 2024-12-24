<?php

namespace App\Models;

use App\Models\User;
use App\Models\SubjectModel;
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

    protected $with=['subjects'];

       // has many relationship teacher between subject
       function subjects() {
        return $this->hasMany(SubjectModel::class, 'teacher_id', 'id');
    }
}
