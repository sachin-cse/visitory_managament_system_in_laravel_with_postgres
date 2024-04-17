<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function handleMyprofileRequest(Request $request, $request_type)
    {
    
        if($request_type == 'edit'){
            $userDetails = Auth::user();
            return view('profile.edit', compact('userDetails'));
        } elseif($request_type == 'update'){
            $rules = [
                'username' => 'required|regex:/^[a-zA-Z0-9@ ]+$/|max:30',
                'name' => 'required|max:30',
                'profile_picture' => 'sometimes|required|mimes:jpeg,png,jpg|max:200',
            ];

            $validator = Validator::make($request->all(), $rules, [
                'username.required' => 'username is required field',
                'username.regex' => 'please enter a valid username',
                'username.max' => 'username maximum 30 characters long',
                'name.required' => 'name is required field',
                'name.max' => 'name maximum 30 characters long',
                'profile_picture.required' => 'profile picture is required field',
                'profile_picture.mimes' => 'allowed profile picture extension is jpeg,png,jpg',
                'profile_picture.max' => 'profile picture maximum 200 kb'
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 500,
                    'message' => $validator->errors()->first(),
                ]);
            }

            $folder = public_path('\assets\user\profile');

            if(!File::isDirectory($folder)){
                File::makeDirectory($folder, 0777, true, true);
            }


            if($request->hasFile('profile_picture') && $request->hasFile('hidden_image')){
                $file = $request->file('profile_picture');
                $image_name = pathinfo($request->profile_picture->getClientOriginalName(), PATHINFO_FILENAME);
                $extenstion = $file->getClientOriginalExtension();
                $filename = $image_name.'.'.$extenstion;
                if(file_exists(public_path($folder.'/'.$filename))){
                    unlink(public_path($folder.'/'.$filename));
                }
                $file->move($folder, $filename);
            } else {
                $filename = $request->hidden_image;
            }

            try{

                $updateProfile = User::where('id', Auth::user()->id)->update(['name' => $request->name, 'username' => $request->username, 'profile_image' => $filename, 'updated_by' => \Auth::user()->id]);
                if($updateProfile){
                    return response()->json([
                        'status' => 200,
                        'message' => 'Profile updated successfully',
                    ]);
                } else {
                    return response()->json([
                        'status' => 500,
                        'message' => 'internal server error',
                    ]);
                }
            }
            catch (QueryException $e) {
                return response()->json([
                    'status' => 500,
                    'message' => 'Database error: ' . $e->getMessage(),
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 500,
                    'message' => $e->getMessage(),
                ]);
            }
        }
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
       
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
       
    }
}
