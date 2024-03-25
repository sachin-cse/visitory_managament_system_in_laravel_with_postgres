<?php

namespace App\Http\Controllers;

use Hash;
use Session;

use Exception;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\BacancyMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        $saveUser->username = $request->username;
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
            'email' => 'required',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules, [
            'email.required' => 'email field is required',
            'password.required' => 'password field is required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'message' => $validator->errors()->first()
            ]);
        }

        $EmailorUsername = $request->get('email');

        if(filter_var($EmailorUsername, FILTER_VALIDATE_EMAIL)){
            $credential = User::where('email', $EmailorUsername)->first();
        } else {
            // DB::enableQueryLog();
            $credential = User::where('username', $EmailorUsername)->first();
            // $query = DB::getQueryLog();
            // dd($query);
        }


        try{
            if($credential && Hash::check($request->get('password'), $credential->password)){
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
        catch(ModelNotFoundException $e){
            return response()->json([
                'status' => 404,
                'message' => $e->getMessage()
            ]);
        }
        // catch (Exception $e){
        //     return response()->json([
        //         'status' => 500,
        //         'message' => $e->getMessage()
        //     ]);
        // }
    }

    // reset password view
    public function ShowResetPasswordView(Request $request){
        return view('auth.reset-password');
    }

    // 
    public function SendResetLink(Request $request){
        $email = $request->email;
        $token = Str::random(60);

        $body = [
            'email' => $email,
            'token' => $token
        ];

        try{

            $user = User::where('email', $email)->firstOrFail();
            $user->reset_password_token = $token;
            $user->token_expiry_at = Carbon::now()->addMinutes(5);
            $user->save();
            
            if(Mail::to($email)->send(new BacancyMail($body))){
                return response()->json([
                    'status' => 200,
                    'message' => 'reset password link sent successfully in your registered email address'
                ]);
            } else {
                return response()->json([
                    'status' => 401,
                    'message' => 'Failed to send reset password link. Please try again later.'
                ]);
            }
        }
        catch(ModelNotFoundException $e){
            return response()->json([
                'status' => 404,
                'message' => 'Please provide registered email address',
            ]);
       }
       catch(Exception $e){
        return response()->json([
            'status' => 500,
            'message' => $e->getMessage(),
        ]);
       }
}

// change password view
public function ChangePasswordView(Request $request, $token){
    return view('auth.change-password', ['token' => $token]);
}

// change password
public function ChangePassword(Request $request){
    $token = $request->reset_password_token;
    $new_password = $request->new_password;

    try{

        $token_expiry_at = User::select('token_expiry_at')->where('reset_password_token', '=', $token)->first();
        // dd($token_expiry_at);
        $current_time = date('H:i:s', time());
        if($current_time > $token_expiry_at->token_expiry_at){
            return response()->json([
                'status' => 401,
                'message' => 'Token has expired please try again',
            ]);
        } else {
            User::where('reset_password_token', '=', $token)->update([
                'password' => Hash::make($request->new_password)
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'Password updated successfully',
            ]);
        }
    }
    catch(ModelNotFoundException $e){
        return response()->json([
            'status' => 404,
            'message' => $e->getMessage(),
        ]);
   }
   catch(Exception $e){
    return response()->json([
        'status' => 500,
        'message' => $e->getMessage(),
    ]);
   }

}

}