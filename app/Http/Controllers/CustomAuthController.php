<?php

namespace App\Http\Controllers;

use Hash;
use Session;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class CustomAuthController extends Controller
{
    //registration method

    public function registration(Request $request){

        // validation rules
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ];

        $validator = Validator::make($request->all(), $rules, [
            'name.required' => 'Please enter your name',
            'email.required' => 'Please enter your email address',
            'email.email' => 'Please enter your valid email address',
            'email.unique' => 'This email address is already taken'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'message' => $validator->errors()->first()
            ]);
        }

        $saveUser = new User;

        $saveUser->name = $request->name;
        $saveUser->email = $request->email;
        $saveUser->password = $request->password;

        try{
            if($saveUser->save()){    
                return response()->json([
                'status' => 201,
                'message' => 'User created successfully'
            ]);
        } 
      } catch(QueryException $e){
        return response()->json([
            'status' => 500,
            'message' => $e->getMessage()
        ]);
    }


    }
}