<div class="bg-blue-700 px-4 sm:px-6 py-3 flex items-center justify-between shadow h-16 fixed top-0 left-0 right-0 z-50">
    <div class="flex items-center text-white">
    <svg class="h-6 w-6 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 640 512"><path d="M337.8 5.4C327-1.8 313-1.8 302.2 5.4L166.3 96H48C21.5 96 0 117.5 0 144V464c0 26.5 21.5 48 48 48H592c26.5 0 48-21.5 48-48V144c0-26.5-21.5-48-48-48H473.7L337.8 5.4zM256 416c0-35.3 28.7-64 64-64s64 28.7 64 64v96H256V416zM96 192h32c8.8 0 16 7.2 16 16v64c0 8.8-7.2 16-16 16H96c-8.8 0-16-7.2-16-16V208c0-8.8 7.2-16 16-16zm400 16c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v64c0 8.8-7.2 16-16 16H512c-8.8 0-16-7.2-16-16V208zM96 320h32c8.8 0 16 7.2 16 16v64c0 8.8-7.2 16-16 16H96c-8.8 0-16-7.2-16-16V336c0-8.8 7.2-16 16-16zm400 16c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v64c0 8.8-7.2 16-16 16H512c-8.8 0-16-7.2-16-16V336zM232 176a88 88 0 1 1 176 0 88 88 0 1 1 -176 0zm88-48c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16s-7.2-16-16-16H336V144c0-8.8-7.2-16-16-16z"/></svg>
        <span class="font-semibold text-sm sm:text-xl tracking-tight">SCHOOL MANAGEMENT SYSTEM</span>
    </div>
    <div class="relative">
        @auth
            <a href="{{route('admin.clear-cache', ['command_type' => 'clear-cache'])}}" class="bg-gray-600 text-white text-sm uppercase py-2 px-4 flex items-center rounded">
                <span class="ml-2 text-xs font-semibold">Clear Cache</span>
            </a>
      
            <div class="flex items-center cursor-pointer" id="opennavdropdown">
                <img class="w-8 h-8 rounded-full mr-2" src="{{!empty(\Auth::user()->profile_image) ? asset('assets/user/profile/'. \Auth::user()->profile_image):asset('assets/user/profile/no_image.jpg')}}" alt="Avatar">
                <p class="text-sm text-white font-semibold leading-none">{{ auth()->user()->name }}</p>
                <svg class="w-4 h-4 stroke-current text-gray-200 ml-1 feather feather-chevron-down" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </div>
            <div class="bg-blue-700 absolute top-0 right-0 mt-12 -mr-6 shadow rounded-bl rounded-br">
                <div class="hidden h-24 w-48" id="navdropdown">
                    <div class="px-8 py-4 border-t border-blue-800">
                        <a href="{{route('admin.handle_my_profile_request', 'edit')}}" class="flex items-center pb-3 text-sm text-gray-200 font-semibold">
                            <svg class="h-4 w-4 mr-2 fill-current text-gray-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm80 256h64c44.2 0 80 35.8 80 80c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16c0-44.2 35.8-80 80-80zm96-96c0 35.3-28.7 64-64 64s-64-28.7-64-64s28.7-64 64-64s64 28.7 64 64zm128-32H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>
                            <span>Profile</span>
                        </a>
                        <form action="{{route('admin.logoutUser')}}" method="POST" class="pb-2" id="logoutUser">
                            @csrf
                            <button class="flex items-center text-sm text-gray-200 font-semibold focus:outline-none" type="submit">
                                <svg class="h-4 w-4 mr-2 fill-current text-gray-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V256c0 17.7 14.3 32 32 32s32-14.3 32-32V32zM143.5 120.6c13.6-11.3 15.4-31.5 4.1-45.1s-31.5-15.4-45.1-4.1C49.7 115.4 16 181.8 16 256c0 132.5 107.5 240 240 240s240-107.5 240-240c0-74.2-33.8-140.6-86.6-184.6c-13.6-11.3-33.8-9.4-45.1 4.1s-9.4 33.8 4.1 45.1c38.9 32.3 63.5 81 63.5 135.4c0 97.2-78.8 176-176 176s-176-78.8-176-176c0-54.4 24.7-103.1 63.5-135.4z"/></svg>
                                <span>{{ __('Logout') }}</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endauth

    </div>
</div>
@push('scripts')
@if(\Session::has('success'))
    <script>
        toastr.success('{{\Session::get('success')}}');
    </script>
@endif
@endpush
<!-- Log on to codeastro.com for more projects -->