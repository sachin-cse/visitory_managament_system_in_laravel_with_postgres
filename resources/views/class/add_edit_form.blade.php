@extends('layouts.app')

@section('content')
    <div class="roles" id="teacher-show">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Add New Class</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="javascript:void(0);" class="bg-gray-700 text-white text-sm uppercase py-2 px-4 flex items-center rounded">
                    <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="long-arrow-alt-left" class="svg-inline--fa fa-long-arrow-alt-left fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"></path></svg>
                    <span class="ml-2 text-xs font-semibold">Back</span>
                </a>
            </div>
        </div>
        <!-- Log on to codeastro.com for more projects -->
        {{-- @dd($data->id); --}}
        <div class="table w-full mt-8 bg-white rounded">
            <form action="{{route('admin.handle_class_request','save')}}" method="POST" class="w-full max-w-xl px-6 py-12" enctype="multipart/form-data" id="myForm">
                @csrf
                <input type="hidden" value="save_data" name="mode">
                {{-- <input type="hidden" value="{{\Auth::user()->id}}" name="user_id"> --}}
                <input type="hidden" value="{{$data->class_id??0}}" name="class_id">
                @csrf
                
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Class Name
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input name="class_name validate[required]" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" value="{{ old('class_name', $data->class_name??'') }}">
                    </div>
                </div>

                <div class="md:flex md:items-center mb-6">
                    
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Select Subject
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <div class="flex flex-row items-center">
                            <select name="subject_id[]" class="block text-gray-500 font-bold select-2-multiple" multiple>
                                @if($subject_data->count() > 0)
                                    @foreach($subject_data as $value)
                                        <option value="{{$value->subject_id}}">{{$value->subject_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                </div>

                
                <div class="md:flex md:items-center mb-6">
                    
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Select Teacher
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <div class="flex flex-row items-center">
                            <select name="teacher_id" class="block text-gray-500 font-bold">
                                <option value="" disabled selected>--select teacher--</option>
                                @if($teacher_data->count() > 0)
                                    @foreach($teacher_data as $value)
                                        <option value="{{$value->id}}" {{($data->teacher_id??'') == $value->id ? 'selected':''}}>{{$value->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                </div>

                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Status
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <div class="flex flex-row items-center">
                            <select name="class_status" class="block text-gray-500 font-bold">
                                <option value="" disabled selected>--select status--</option>
                                    <option value="1">Active</option>
                                    <option value="2">In Active</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="md:flex md:items-center">
                    <div class="md:w-1/3"></div>
                    <div class="md:w-2/3">
                        <button class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                            Submit
                        </button>
                    </div>
                </div>
            </form>        
        </div>
        <!-- Log on to codeastro.com for more projects -->
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $('.select-2-multiple').select2({
                placeholder: "Please Choose Subject",
                allowClear: true,
            });
        });
    </script>
@endpush