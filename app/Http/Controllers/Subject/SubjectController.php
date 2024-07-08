<?php

namespace App\Http\Controllers\Subject;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubjectController extends Controller
{
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
}
