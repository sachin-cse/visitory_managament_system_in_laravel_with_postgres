@extends('layouts.app')

@section('title')
Class
@endsection

@section('content')
    <div class="roles-permissions">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Class</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{route('admin.handle_class_request', 'add')}}" data-url="{{route('admin.handle_class_request', 'add')}}" class="bg-green-500 text-white text-sm uppercase py-2 px-4 flex items-center rounded action_type">
                    <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" class="svg-inline--fa fa-plus fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path></svg>
                    <span class="ml-2 text-xs font-semibold">Add New Class</span>
                </a>
            </div>
        </div>
        <!-- Log on to codeastro.com for more projects -->
        <div class="mt-8 bg-white rounded border-b-4 border-gray-300">
            <table class="w-full border-collapse" id="table">
                <thead>
                    <tr class="uppercase text-sm font-semibold bg-gray-600 text-white rounded-tl rounded-tr">
                        <th class="px-4 py-3">SN.</th>
                        <th class="px-4 py-3">Subject Name</th>
                        <th class="px-4 py-3">Subject Code</th>
                        <th class="px-4 py-3">Teacher Name</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp
                        @if($subject_data->count() > 0)
                            @foreach($subject_data as $value)
                                <tr class="text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300">
                                    <td class="px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{$i++}}</td>
                                    <td class="px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{$value->subject_name}}</td>
                                    <td class="px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{$value->subject_code}}</td>
                                    @if($value->teachers->count() > 0)
                                        <td class="px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{$value->teachers->name}}</td>
                                    @endif
                                    <td class="px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{$value->status}}</td>
                                    <td class="flex items-center justify-end px-3 py-4">
                                        <a href="{{route('admin.handle_subject_request', ['action_type'=>'edit','id'=>$value->subject_id])}}" title="Edit User">
                                            <svg class="h-6 w-6 fill-current text-green-600" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="pen-square" class="svg-inline--fa fa-pen-square fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M400 480H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48v352c0 26.5-21.5 48-48 48zM238.1 177.9L102.4 313.6l-6.3 57.1c-.8 7.6 5.6 14.1 13.3 13.3l57.1-6.3L302.2 242c2.3-2.3 2.3-6.1 0-8.5L246.7 178c-2.5-2.4-6.3-2.4-8.6-.1zM345 165.1L314.9 135c-9.4-9.4-24.6-9.4-33.9 0l-23.1 23.1c-2.3 2.3-2.3 6.1 0 8.5l55.5 55.5c2.3 2.3 6.1 2.3 8.5 0L345 199c9.3-9.3 9.3-24.5 0-33.9z"></path></svg>
                                        </a>
                                        <a href="javascript:void(0);" data-url="{{route('admin.handle_subject_request', ['action_type'=>'delete','id'=>$value->subject_id])}}" class="deletebtn ml-1 bg-red-600 block p-1 border border-red-600 rounded-sm delete-user" title="Delete User">
                                            <svg class="h-3 w-3 fill-current text-gray-100" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash" class="svg-inline--fa fa-trash fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path></svg>
                                        </a>
                                        @if(($value->subject_status??'') == '1')
                                        <!-- Active status -->
                                        <a href="javascript:void(0);" data-value="2" data-url="{{route('admin.handle_subject_request', ['action_type'=>'change-status','id'=>$value->subject_id])}}" class="ml-1 bg-green-600 block p-1 border border-none-600 rounded-sm change-status" title="Change User Status">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 fill-current text-gray-100" data-prefix="fas" data-icon="fa-thumbs-up" class="svg-inline--fa fa-thumbs-up fa-w-14" role="img" viewBox="0 0 512 512"><path d="M313.4 32.9c26 5.2 42.9 30.5 37.7 56.5l-2.3 11.4c-5.3 26.7-15.1 52.1-28.8 75.2H464c26.5 0 48 21.5 48 48c0 18.5-10.5 34.6-25.9 42.6C497 275.4 504 288.9 504 304c0 23.4-16.8 42.9-38.9 47.1c4.4 7.3 6.9 15.8 6.9 24.9c0 21.3-13.9 39.4-33.1 45.6c.7 3.3 1.1 6.8 1.1 10.4c0 26.5-21.5 48-48 48H294.5c-19 0-37.5-5.6-53.3-16.1l-38.5-25.7C176 420.4 160 390.4 160 358.3V320 272 247.1c0-29.2 13.3-56.7 36-75l7.4-5.9c26.5-21.2 44.6-51 51.2-84.2l2.3-11.4c5.2-26 30.5-42.9 56.5-37.7zM32 192H96c17.7 0 32 14.3 32 32V448c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32V224c0-17.7 14.3-32 32-32z"/></svg>
                                        </a>

                                        @elseif(($value->subject_status??'') == '2')
                                        <!-- Inactive status -->
                                        <a href="javascript:void(0);" data-value="1" data-url="{{ route('admin.handle_subject_request', ['action_type' => 'change-status', 'id' => $value->subject_id]) }}" class="ml-1 bg-yellow-600 block p-1 border border-none-600 rounded-sm change-status" title="Change User Status">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 fill-current text-gray-100" data-prefix="fas" data-icon="fa-thumbs-down" class="svg-inline--fa fa-thumbs-down fa-w-14" role="img" viewBox="0 0 512 512"><path d="M313.4 479.1c26-5.2 42.9-30.5 37.7-56.5l-2.3-11.4c-5.3-26.7-15.1-52.1-28.8-75.2H464c26.5 0 48-21.5 48-48c0-18.5-10.5-34.6-25.9-42.6C497 236.6 504 223.1 504 208c0-23.4-16.8-42.9-38.9-47.1c4.4-7.3 6.9-15.8 6.9-24.9c0-21.3-13.9-39.4-33.1-45.6c.7-3.3 1.1-6.8 1.1-10.4c0-26.5-21.5-48-48-48H294.5c-19 0-37.5 5.6-53.3 16.1L202.7 73.8C176 91.6 160 121.6 160 153.7V192v48 24.9c0 29.2 13.3 56.7 36 75l7.4 5.9c26.5 21.2 44.6 51 51.2 84.2l2.3 11.4c5.2 26 30.5 42.9 56.5 37.7zM32 384H96c17.7 0 32-14.3 32-32V128c0-17.7-14.3-32-32-32H32C14.3 96 0 110.3 0 128V352c0 17.7 14.3 32 32 32z"/></svg>
                                        </a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        @endif

                </tbody>
            </table>
        </div>
        
    </div>
@endsection