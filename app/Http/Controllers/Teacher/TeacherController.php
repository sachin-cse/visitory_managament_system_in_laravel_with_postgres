<?php

namespace App\Http\Controllers\Teacher;

use App\Models\TeacherModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeacherController extends Controller
{
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
            if($action_type == 'add' || $action_type == 'edit'){
                $data = TeacherModel::find($post_data['id']??'');
                return view('teacher.add_edit_form', ['data' => $data??'']);
            }
        }
    }
