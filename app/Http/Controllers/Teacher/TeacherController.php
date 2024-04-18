<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

}
