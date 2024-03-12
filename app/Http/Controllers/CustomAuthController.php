<?php

namespace App\Http\Controllers;

use Hash;
use Session;

use Exception;

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

    // login view
    public function login(){
        return view('auth.login');
    }

    // loginUser
    public function loginUser(Request $request){

        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules, [
            'email.required' => 'email field is required',
            'email.email' => 'please enter a valid email',
            'password.required' => 'password field is required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'message' => $validator->errors()->first()
            ]);
        }

        $credentials = $request->only('email', 'password');


        try{
            if(Auth::attempt($credentials)){
                return response()->json([
                    'status' => 200,
                    'message' => 'User logged in successfully'
                ]);
            } else {
                return response()->json([
                    'status' => 401,
                    'message' => 'Invalid credentials'
                ]);
            }
        }
        catch (Exception $e){
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }
}