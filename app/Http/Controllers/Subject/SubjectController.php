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
                $subject_data = $this->SubjectModel->select('*',\DB::raw('CASE WHEN subject_status = 1 THEN "Active" ELSE "Inactive" END AS status'))->with('teachers')->get();
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
    public function handleSubjectRequest(Request $request,$action_type,$id=0){
        $subject_data = $request->all();
        if($action_type == 'add' || $action_type == 'edit'){
            $teacher_data = $this->TeacherModel->get();
            if($id > 0){
                $data = $this->SubjectModel->find($id);
            }
            return view('subject.add_edit_form', ['data'=>$data??[], 'teacher_data'=>$teacher_data??[]]);
        }
        // check subject exist or not
        $subject_exist = $this->SubjectModel->where('subject_code', $request->subject_code)->count();
            if($subject_exist > 1 ){
                return response()->json([
                    'status' => 200,
                    'flag'=>'error',
                    'message' => 'This subject is already assign another teacher',
                ]);
            }

        // change status
        if($action_type == 'change-status'){
            $this->SubjectModel->find($id??'')->update(['subject_status' => $subject_data['statusVal']??'']);
            return response()->json([
                'status' => 200,
                'message' => 'Status change successfully'
            ]);
        }

        // delete data
        if($action_type == 'delete'){
            $this->SubjectModel->find($id??'')->delete();
            return response()->json([
                'status' => 200,
                'message' => 'data deleted successfully'
            ]);
        }

        try{
            if($subject_data['mode'] == 'save_data'){
                // dd($request->all());
                if(($subject_data['id']??0) > 0){
                    $update_data = $this->SubjectModel->where('subject_id',$subject_data['id']);
                    $update_data->update(['subject_name'=>$request->subject_name, 'subject_code'=>$request->subject_code, 'teacher_id'=>$request->teacher_id, 'subject_description'=>$request->subject_description]);
                    return response()->json([
                        'status' => 200,
                        'message' => 'Subject updated successfully',
                    ]);
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
