<?php

namespace App\Models;

use App\Models\TeacherModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubjectModel extends Model
{
    use HasFactory;

    protected $table = 'subject';
    protected $guarded = ['_token'];  

    protected $fillabale = [
        'subject_name',
        'subject_code',
        'teacher_id',
        'subject_description',
        'subject_status'
    ];

    // has many relationship teacher between subject
    function teachers() {
        return $this->hasMany(TeacherModel::class, 'id', 'teacher_id');
    }

}
