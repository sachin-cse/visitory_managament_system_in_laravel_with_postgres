<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassModel extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected  $primaryKey = 'class_id';
    protected $table = 'class';
    protected $guarded = ['_token'];  

    protected $fillabale = [
        'class_name',
        'subject_id',
        'teacher_id',
        'class_status'
    ];
}
