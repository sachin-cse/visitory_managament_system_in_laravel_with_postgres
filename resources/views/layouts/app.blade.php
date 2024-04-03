<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <link rel="stylesheet" href={{asset('assets/css/toastr.min.css')}}>
    
</head>
<!-- Log on to codeastro.com for more projects -->
<body class="bg-gray-100 font-sans antialiased">
    <div id="app">

        @include('layouts.navbar')
        
        <div class="main flex flex-wrap justify-end mt-16">
            
            @include('layouts.sidebar')

            <div class="content w-full sm:w-5/6">
                <div class="container mx-auto p-4 sm:p-6">

                    @yield('content')
                    
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{asset('assets/js/toastr.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <script>
        $(function() {
            $( "#opennavdropdown" ).on( "click", function() {
                $( "#navdropdown" ).toggleClass( "hidden" );
            })
        })
    </script>

    @stack('scripts')

</body>
</html>