<?php

namespace App\Http\Controllers\Teacher;

use App\Models\TeacherModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeacherController extends Controller
{

    public function model(){
        return TeacherModel::class;
    }
    // view part of teacher listing
    public function index(Request $request, $request_type){
        // dd($request_type);
        try{
            if(view()->exists('teacher.'.$request_type.'')){
                return view('teacher.'.$request_type.'');
            } else {
                throw new \Exception('teacher.'.$request_type.' view does not exist');
            }
        }
        catch(\Exception $e){
            echo 'Error: '.$e->getMessage();
        }
    }

    // handle teacher action type
    public function handleTeacherActionType(Request $request, $action_type){
        $post_data = $request->all();
        dd($post_data);
        if($action_type == 'add' || $action_type == 'edit'){
            if($post_data['id'] > 0){
                $data = TeacherModel::find($post_data['id']);
            }
            return view('teacher.add_edit_form', ['data' => $data??'']);
        }

        if($post_data['mode'] == 'save_data'){
            try{
                if($post_data['id'] != 0){
                    $update_data = $this->model()->find($post_data['id']);
                    $update_date->fill($request->all());
                    $update->save();
                    return response()->json([
                        'status' => 200,
                        'message' => 'Data updated successfully',
                    ]);
                } else {
                    $update_date->fill($request->all());
                    $update->save();
                    return response()->json([
                        'status' => 200,
                        'message' => 'Data save successfully',
                    ]);
                }

            }
            catch(\Exception $e){
                return response()->json([
                    'status' => 500,
                    'message' => $e->getMessage(),
                ]);
            }
        }

        if($action_type == 'delete'){
            try{
                $this->model()->find($id)->delete();
                return response()->json([
                    'status' => 200,
                    'message' => 'data deleted successfully'
                ]);
            }
            catch(\Exception $e){
                return response()->json([
                    'status' => 500,
                    'message' => $e->getMessage(),
                ]);
            }
        }
        
    }
}