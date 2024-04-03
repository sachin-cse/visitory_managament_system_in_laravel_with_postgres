@extends('dashboard')

@section('content')
<main class="signup-form">
    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <h3 class="card-header text-center">Login User</h3>
                    <div class="card-body">
                        <form action="{{route('admin.loginUser')}}" method="POST" id="loginUser">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" name="email" class="form-control" placeholder="enter your email">
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" name="password" class="form-control" placeholder="enter your password">
                            </div>

                            <div class="d-grid mx-auto">
                                <span id="loader-login" class="text-center"></span>
                                <button type="submit" class="btn btn-dark btn-block" id="submitbtn-login">Sign in</button>
                            </div>
                            <a href="{{route('admin.reset-password')}}">Forgot Password ? </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
    @if(\Session::has('message'))
    <script>
        toastr.error('{{\Session::get('message')}}');
    </script>
    @endif
@endpush

