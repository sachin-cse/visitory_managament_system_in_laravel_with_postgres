@extends('layouts.app')

@section('title')
Teachers
@endsection 
@section('content')
    <div class="roles-permissions">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Teacher</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{route('admin.teacher.handle_teacher_action_type', 'add')}}" data-url="{{route('admin.teacher.handle_teacher_action_type', 'add')}}" class="bg-green-500 text-white text-sm uppercase py-2 px-4 flex items-center rounded action_type">
                    <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" class="svg-inline--fa fa-plus fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path></svg>
                    <span class="ml-2 text-xs font-semibold">Add New Teacher</span>
                </a>
            </div>
        </div>
        <!-- Log on to codeastro.com for more projects -->
        <div class="mt-8 bg-white rounded border-b-4 border-gray-300">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="uppercase text-sm font-semibold bg-gray-600 text-white rounded-tl rounded-tr">
                        <th>SN.</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Gender</th>
                        <th class="px-4 py-3">Phone</th>
                        <th class="px-4 py-3">Date of Birth</th>
                        <th class="px-4 py-3">Current Address</th>
                        <th class="px-4 py-3">Permanent Address</th>
                        <th class="px-4 py-3">Profile Image</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                     $i=1;   
                    @endphp
                    @foreach($data as $value)
                        <tr class="text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300">
                            <td class="px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{$i++}}</td>
                            <td class="px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{$value->name}}</td>
                            <td class="px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{$value->gender}}</td>
                            <td class="px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{$value->phone}}</td>
                            <td class="px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{$value->dob}}</td>
                            <td class="px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{$value->current_address}}</td>
                            <td class="px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{$value->permanent_address}}</td>
                            <td class="px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight"><img src="{{!empty($value->profile_image) ? asset('assets/teacher_profile/'.$value->profile_image):asset('assets/user/profile/no_image.jpg')}}" width="50" height="50"></td>
                            <td class="px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{$value->status}}</td>
                            <td class="flex items-center justify-end px-3 py-4">
                                <a href="{{route('admin.teacher.handle_teacher_action_type',['action_type'=>'edit', 'id'=>$value->id])}}" title="Edit User">
                                    <svg class="h-6 w-6 fill-current text-green-600" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="pen-square" class="svg-inline--fa fa-pen-square fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M400 480H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48v352c0 26.5-21.5 48-48 48zM238.1 177.9L102.4 313.6l-6.3 57.1c-.8 7.6 5.6 14.1 13.3 13.3l57.1-6.3L302.2 242c2.3-2.3 2.3-6.1 0-8.5L246.7 178c-2.5-2.4-6.3-2.4-8.6-.1zM345 165.1L314.9 135c-9.4-9.4-24.6-9.4-33.9 0l-23.1 23.1c-2.3 2.3-2.3 6.1 0 8.5l55.5 55.5c2.3 2.3 6.1 2.3 8.5 0L345 199c9.3-9.3 9.3-24.5 0-33.9z"></path></svg>
                                </a>
                                <a href="javascript:void(0);" data-url="{{route('admin.teacher.handle_teacher_action_type',['action_type'=>'delete','id'=>$value->id])}}" class="deletebtn ml-1 bg-red-600 block p-1 border border-red-600 rounded-sm delete-user" title="Delete User">
                                    <svg class="h-3 w-3 fill-current text-gray-100" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash" class="svg-inline--fa fa-trash fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path></svg>
                                </a>
                                @if($value->status == 'Active')
                                <!-- Active status -->
                                <a href="javascript:void(0);" data-value="2" data-url="{{ route('admin.teacher.handle_teacher_action_type', ['action_type' => 'change-status', 'id' => $value->id]) }}" class="ml-1 bg-green-600 block p-1 border border-none-600 rounded-sm change-status" title="Change User Status">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 fill-current text-gray-100" data-prefix="fas" data-icon="fa-thumbs-up" class="svg-inline--fa fa-thumbs-up fa-w-14" role="img" viewBox="0 0 512 512"><path d="M313.4 32.9c26 5.2 42.9 30.5 37.7 56.5l-2.3 11.4c-5.3 26.7-15.1 52.1-28.8 75.2H464c26.5 0 48 21.5 48 48c0 18.5-10.5 34.6-25.9 42.6C497 275.4 504 288.9 504 304c0 23.4-16.8 42.9-38.9 47.1c4.4 7.3 6.9 15.8 6.9 24.9c0 21.3-13.9 39.4-33.1 45.6c.7 3.3 1.1 6.8 1.1 10.4c0 26.5-21.5 48-48 48H294.5c-19 0-37.5-5.6-53.3-16.1l-38.5-25.7C176 420.4 160 390.4 160 358.3V320 272 247.1c0-29.2 13.3-56.7 36-75l7.4-5.9c26.5-21.2 44.6-51 51.2-84.2l2.3-11.4c5.2-26 30.5-42.9 56.5-37.7zM32 192H96c17.7 0 32 14.3 32 32V448c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32V224c0-17.7 14.3-32 32-32z"/></svg>
                                </a>

                                @elseif($value->status == 'Inactive')
                                <!-- Inactive status -->
                                <a href="javascript:void(0);" data-value="1" data-url="{{ route('admin.teacher.handle_teacher_action_type', ['action_type' => 'change-status', 'id' => $value->id]) }}" class="ml-1 bg-yellow-600 block p-1 border border-none-600 rounded-sm change-status" title="Change User Status">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 fill-current text-gray-100" data-prefix="fas" data-icon="fa-thumbs-down" class="svg-inline--fa fa-thumbs-down fa-w-14" role="img" viewBox="0 0 512 512"><path d="M313.4 479.1c26-5.2 42.9-30.5 37.7-56.5l-2.3-11.4c-5.3-26.7-15.1-52.1-28.8-75.2H464c26.5 0 48-21.5 48-48c0-18.5-10.5-34.6-25.9-42.6C497 236.6 504 223.1 504 208c0-23.4-16.8-42.9-38.9-47.1c4.4-7.3 6.9-15.8 6.9-24.9c0-21.3-13.9-39.4-33.1-45.6c.7-3.3 1.1-6.8 1.1-10.4c0-26.5-21.5-48-48-48H294.5c-19 0-37.5 5.6-53.3 16.1L202.7 73.8C176 91.6 160 121.6 160 153.7V192v48 24.9c0 29.2 13.3 56.7 36 75l7.4 5.9c26.5 21.2 44.6 51 51.2 84.2l2.3 11.4c5.2 26 30.5 42.9 56.5 37.7zM32 384H96c17.7 0 32-14.3 32-32V128c0-17.7-14.3-32-32-32H32C14.3 96 0 110.3 0 128V352c0 17.7 14.3 32 32 32z"/></svg>
                                </a>
                                @endif

                                <a href="javascript:void(0);" data-value="{{$value->id??''}}" data-url="{{route('admin.teacher.listing', 'listing')}}" class="ml-1 bg-grey-600 block p-1 border border-none-600 rounded-sm show_user_model" title="Set User Role">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="h-3 w-3 fill-current text-grey-100" data-prefix="fas" data-icon="fa-user" class="svg-inline--fa fa-user fa-w-14" role="img" viewBox="0 0 512 512"><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>
                                </a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>
@endsection

{{-- model for set user role --}}
<div class="modal fade" id="UserRoleModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Set User Role</h5>
                <button type="button" class="close close-model" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.teacher.handle_teacher_action_type', 'user-role') }}" id="user_role">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="user_name">Username<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{ $teacherData->username ?? '' }}" name="username" id="user_name">
                                <input type="hidden" value="{{ $teacherData->id ?? 0 }}" name="hidden_id" id="hidden_id">
                                <input type="hidden" value="{{ $teacherData->teacher->id ?? 0 }}" name="teacher_id" id="teacher_id">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="user_email">Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" value="{{ $teacherData->email ?? '' }}" name="email" id="user_email">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="user_password">Password<span class="text-danger">*</span></label>
                                <input type="password" class="form-control password" value="12345678" name="password" id="user_password">
                                <span toggle="#user_password" class="fa fa-eye toggle-password"></span>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="user_role">User Role<span class="text-danger">*</span></label>
                                <select name="user_role" class="form-control" id="user_type">
                                        <option value="teacher" {{($teacherData->type??'') == 'teacher' ? 'selected':''}}>Teacher
                                        </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-model" data-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-primary">@if(!empty($teacherData->id))Save changes @else Update changes @endif</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



