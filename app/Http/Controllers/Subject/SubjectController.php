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
                $subject_data = $this->SubjectModel->with('teachers')->get();
                // dd($subject_data);
                return view($view_type.'.listing', ['subject_data'=>$subject_data??'']);
            }

            throw new Exception('errors.404');
        }
        catch(Exception $e){
            return view($e->getMessage());
        }
    }

    // handle subject request
    public function handleSubjectRequest(Request $request, $action_type){
        $subject_data = $request->all();
        if($action_type == 'add' || $action_type == 'edit'){
            $teacher_data = $this->TeacherModel->get();
            if(($subject_data['id']??0) > 0){
                $data = $this->SubjectModel->find($subject_data['id']);
            }

            return view('subject.add_edit_form', ['data'=>$data??[], 'teacher_data'=>$teacher_data??[]]);
        }
        // check subject exist or not
        $subject_exist = $this->SubjectModel->where('subject_code', $request->subject_code)->first();
        // dd($subject_exist);
        if($subject_exist != null){
            if($subject_exist->count() > 1 ){
                return response()->json([
                    'status' => 200,
                    'flag'=>'error',
                    'message' => 'This subject is already assign another teacher',
                ]);
            }else{
                goto save_response;
            }
        }

        save_response:
        try{
            if($subject_data['mode'] == 'save_data'){
                if(($subject_data['id']??0) > 0){
                    dd('Hare Krishna');
                } else {
                    $data = $this->SubjectModel->fill($subject_data);
                    if($data->save()){
                        return response()->json([
                            'status' => 200,
                            'message' => 'Subject add successfully',
                        ]);
                    }
                }
            }
        }catch(Exception $e){
            return response()->json([
                'status' => 200,
                'flag'=>'error',
                'message' => $e->getMessage(),
            ]);
        }

    }
}
