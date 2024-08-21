<?php

namespace App\Models;

use App\Models\TeacherModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubjectModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected  $primaryKey = 'subject_id';
    protected $table = 'subject';
    protected $guarded = ['_token'];  

    protected $fillabale = [
        'subject_name',
        'subject_code',
        'teacher_id',
        'subject_description',
        'subject_status'
    ];

    // set created and updated by
    public static function boot(){
        parent::boot();
        static::creating(function($model){
            $user = \Auth::user();           
            $model->created_by = $user->id;
            $model->updated_by = NULL;
        });

        static::updating(function($model){
            $user = \Auth::user();
            $model->updated_by = $user->id;
        });

        static::deleting(function($model)  {
            $user = \Auth::user();
            $model->deleted_by = $user->id;
            $model->save();
        });
    }

    // has many relationship teacher between subject
    function teachers() {
        return $this->hasMany(TeacherModel::class, 'id', 'teacher_id');
    }

}
