<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
