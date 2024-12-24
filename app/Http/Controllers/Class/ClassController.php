<?php

namespace App\Http\Controllers\Class;

use Exception;
use App\Models\ClassModel;
use App\Models\TeacherModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubjectModel;

class ClassController extends Controller
{
    // constructor
    public function __construct(ClassModel $ClassModel)
    {
        $this->ClassModel = $ClassModel;
    }
    //class page view
    public function index(Request $request, $view_type){
        try{
            if(view()->exists($view_type.'.listing')){
                return view($view_type.'.listing');
            }

            throw new Exception('errors.404');
        }
        catch(Exception $e){
            return view($e->getMessage());
        }
    }

    // handle class request
    public function handleClassRequest(Request $request,$action_type,$id=0){
        if($action_type == 'add' || $action_type == 'edit'){
            $teacher_data = TeacherModel::where('teacher_status',1)->get();
            $subject_data = SubjectModel::where('subject_status',1)->get();
            if($id > 0){
                $data = $this->ClassModel->find($id);
            }
            return view('class.add_edit_form', ['data'=>$data??[], 'teacher_data'=>$teacher_data, 'subject_data'=>$subject_data]);
        }

        dd($request->all());
    }

}
