<?php

namespace App\Http\Controllers\Teacher;

use App\Models\TeacherModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{

    function __construct(TeacherModel $TeacherModel){
        $this->TeacherModel = $TeacherModel;
    }

    // view part of teacher listing
    public function index(Request $request, $request_type){
        try{
            if(view()->exists('teacher.'.$request_type.'')){
                $data = $this->TeacherModel->select('*',\DB::raw('CASE WHEN teacher_status = 1 THEN "Active" ELSE "Inactive" END AS status'))->get();
                // dd($data);
                return view('teacher.'.$request_type.'', ['data' => $data??'']);
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
        
        
    }
}