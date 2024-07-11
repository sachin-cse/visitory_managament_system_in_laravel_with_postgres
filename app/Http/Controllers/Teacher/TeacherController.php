<?php

namespace App\Http\Controllers\Teacher;

use App\Models\User;
use App\Models\TeacherModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{

    function __construct(TeacherModel $TeacherModel, User $userModel){
        $this->TeacherModel = $TeacherModel;
        $this->User = $userModel;
    }

    // view part of teacher listing
    public function index(Request $request, $request_type){
        try{
            if(view()->exists('teacher.'.$request_type.'')){
                $teacherData = $this->User->with('teacher')->where('teacher_id', $request->id)->first();
                if(!empty($teacherData->teacher)){
                    return response()->json(['teacherData'=>$teacherData]);
                }
                $data = $this->TeacherModel->select('*',\DB::raw('CASE WHEN teacher_status = 1 THEN "Active" ELSE "Inactive" END AS status'))->get();
                return view('teacher.'.$request_type.'', ['data' => $data??'', 'teacherData'=>$teacherData]);
            } else {
                throw new \Exception('teacher.'.$request_type.' view does not exist');
            }
        }
        catch(\Exception $e){
            echo 'Error: '.$e->getMessage();
        }
    }

    // handle teacher action type
    public function handleTeacherActionType(Request $request, $action_type, $id=''){
            $post_data = $request->all();
            if($action_type == 'add' || $action_type == 'edit'){
                if($post_data['id']??'' > 0){
                    $data = $this->TeacherModel->find($post_data['id']);
                }
                return view('teacher.add_edit_form', ['data' => $data??'']);
            }
    
            if($post_data['mode']??'' == 'save_data'){
                // dd($post_data['mode']);
                $rules = [
                    'name' => 'required|regex:/^[a-zA-Z ]+$/u',
                    'phone' => 'required|regex:/^[0-9]{10,15}+$/u',
                    'gender' => 'required',
                    'teacher_status' => 'required',
                    'dob' => 'required',
                    'current_address' => 'required',
                    'permanent_address' => 'required',
                    'profile_image' => 'sometimes|required|mimes:jpg,jpeg,png|max:200'
                ];

                $validator = Validator::make($request->all(), $rules, [
                    'name.required' => 'please enter your name',
                    'name.regex' => 'please enter your name properly',
                    'phone.required' => 'please enter your phone number',
                    'phone.regex' => 'Please enter your phone number properly',
                    'teacher_status.required' => 'please choose your status',
                    'dob.required' => 'please choose your date of birth',
                    'current_address.required' => 'please enter your current address',
                    'permanent_address.required' => 'please enter your permanent address',
                    'profile_image.required' => 'please upload your profile picture',
                    'profile_image.mimes' => 'allowed file extension is png and jpeg',
                    'profile_image.max' => 'allowed file size is 200 kb'
                ]);

                $folder = public_path('\assets\teacher_profile');
                // dd($validator);
                if($validator->fails()){
                    return response()->json([
                        'status' => 500,
                        'message'=>$validator->errors()->first()
                    ]);
                }
                try{
                    // dd($post_data['id']);
                    if($post_data['id'] > 0){   
                        if($request->hasfile('profile_image')){
                            $file = $request->file('profile_image');
                            $image_name = pathinfo($request->profile_image->getClientOriginalName(), PATHINFO_FILENAME);
                            $extenstion = $file->getClientOriginalExtension();
                            $filename = $image_name.'.'.$extenstion;
                            if(file_exists(public_path($folder.'/'.$filename))){
                                unlink(public_path($folder.'/'.$filename));
                            }
                            $file->move($folder, $filename);
                            $post_data['profile_image'] = $filename;
                        } else {
                            $post_data['profile_image'] = $request->hidden_profile_image;
                        }
                        $update_data = $this->TeacherModel->find($post_data['id']);
                        $update_data->fill($request->all());
                        $update_data->save();
                        return response()->json([
                            'status' => 200,
                            'message' => 'Data updated successfully',
                        ]);
                    } else {
                        // dd($request->all());
                        if($request->hasfile('profile_image')){
                            $file = $request->file('profile_image');
                            $image_name = pathinfo($request->profile_image->getClientOriginalName(), PATHINFO_FILENAME);
                            // dd($image_name);
                            $extenstion = $file->getClientOriginalExtension();
                            $filename = $image_name.'.'.$extenstion;
                            if(file_exists(public_path($folder.'/'.$filename))){
                                unlink(public_path($folder.'/'.$filename));
                            }
                            $file->move($folder, $filename);
                            // $request->profile_image = $filename;
                        }
                        // $data = $request->all();
                        $post_data['profile_image'] = $filename;
                        $post_data['user_id'] = \Auth::user()->id;
                        $save_data = $this->TeacherModel;
                        $save_data->fill($post_data);
                        $save_data->save();
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
                // dd($post_data['id']);
                try{
                    $this->TeacherModel->find($post_data['id']??'')->delete();
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

            if($action_type == 'change-status'){
                try{
                    $this->TeacherModel->find($post_data['id']??'')->update(['teacher_status' => $post_data['statusVal']??'']);
                    return response()->json([
                        'status' => 200,
                        'message' => 'Status change successfully'
                    ]);
                }
                catch(\Exception $e){
                    return response()->json([
                        'status' => 500,
                        'message' => $e->getMessage(),
                    ]);
                }
            }
            // user role
            if($action_type == 'user-role'){
                $data = $request->all();

                $rules = [
                    'username' => 'required|regex:/^[a-zA-Z0-9 ]+$/u|unique:users,username,'.$data['hidden_id'].',id,deleted_at,NULL',
                    'email'=>'required|email|unique:users,email,'.$data['hidden_id'].',id,deleted_at,NULL'
                ];

                $validator = Validator::make($request->all(), $rules, [
                    'username.required'=>'Please enter your username',
                    'username.regex' => 'Please enter your username properly',
                    'username.unique'=>'This username is already taken',
                    'email.required'=>'Please enter your email address',
                    'email.email'=>'Please enter your valid email address',
                    'email.unique'=>'This email is already taken',
                ]);

                if($validator->fails()){
                    return response()->json([
                        'status'=>500,
                        'message'=>$validator->errors()->first()
                    ]);
                }
                if($request->ajax() && $request->method() == 'POST'){
                    if($data['hidden_id'] <= 0){
                        $saveData = $this->User;
                        $saveData['teacher_id'] = $data['teacher_id'];
                        $saveData['type'] = $data['user_role'];
                        $saveData->fill($data);
                        $saveData->save();
                        return response()->json([
                            'status'=>200,
                            'message'=> 'User Role create successfully',
                        ]);
                    } else {
                        $saveData = $this->User->find($data['hidden_id']);
                        $saveData['teacher_id'] = $data['teacher_id'];
                        $saveData['type'] = $data['user_role'];
                        $saveData->fill($data);
                        $saveData->save();
                        return response()->json([
                            'status'=>200,
                            'message'=> 'User update successfully',
                        ]);
                    }
                }
            }
        
        
    }
}