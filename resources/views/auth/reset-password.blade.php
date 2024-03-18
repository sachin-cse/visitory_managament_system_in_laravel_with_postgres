@extends('dashboard')

@section('content')
<main class="signup-form">
    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <h3 class="card-header text-center">Reset Password</h3>
                    <p class="card-header text-center">Enter your registered email we will sent reset password link in your email</p>
                    <div class="card-body">
                        <form action="{{route('admin.send-link')}}" method="POST" id="send-reset-link">
                            @csrf
                            {{-- <input type="hidden" name="token" value="{{ $token }}"> --}}
                            <div class="form-group mb-3">
                                <input type="email" name="email" class="form-control" placeholder="enter your email">
                            </div>

                            <div class="d-grid mx-auto">
                                <span id="loader-reset" class="text-center"></span>
                                <button type="submit" class="btn btn-dark btn-block" id="submitbtn-reset">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection