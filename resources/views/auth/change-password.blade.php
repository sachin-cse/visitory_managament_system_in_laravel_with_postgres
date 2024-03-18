@extends('dashboard')

@section('content')
<main class="signup-form">
    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <h3 class="card-header text-center">Change Password</h3>
                    <div class="card-body">
                        <form action="{{route('admin.change-password')}}" method="POST" id="change-password">
                            @csrf
                            <input type="hidden" name="reset_password_token" value="{{ $token }}">
                            <div class="form-group mb-3">
                                <input type="password" name="new_password" class="form-control" placeholder="enter your new password">
                            </div>

                            <div class="d-grid mx-auto">
                                <span id="change-password-loader" class="text-center"></span>
                                <button type="submit" class="btn btn-dark btn-block" id="submitbtn-password">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection