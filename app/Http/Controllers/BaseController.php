<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    //
    public function ClearCache(Request $request, $command_type){
        if($command_type == 'clear-cache'){
            \Session::flash('success', 'cache cleared successfully'); 
            \Artisan::call('cache:clear');
            return redirect()->back();
        } else {
            abort('404');
        }
    }
}
