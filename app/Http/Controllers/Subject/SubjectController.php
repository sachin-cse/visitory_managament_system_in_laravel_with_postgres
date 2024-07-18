<?php

namespace App\Http\Controllers\Subject;

use Exception;
use App\Models\SubjectModel;
use App\Models\TeacherModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubjectController extends Controller
{

    public function __construct(SubjectModel $SubjectModel, TeacherModel $TeacherModel){
        $this->SubjectModel = $SubjectModel;
        $this->TeacherModel = $TeacherModel;
    }
    //subject view
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

    // handle subject request
    public function handleSubjectRequest(Request $request, $action_type){
        if($action_type == 'add' || $action_type == 'edit'){
            $subject_data = $request->all();
            $teacher_data = $this->TeacherModel->get();
            if(($subject_data['id']??0) > 0){
                $data = $this->SubjectModel->find($subject_data['id']);
            }

            return view('subject.add_edit_form', ['data'=>$data??[], 'teacher_data'=>$teacher_data??[]]);
        }
    }
}
