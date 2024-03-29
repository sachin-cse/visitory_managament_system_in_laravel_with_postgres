@extends('dashboard')

@section('content')
<main class="signup-form">
    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <h3 class="card-header text-center">Register User</h3>
                    <div class="card-body">
                        <form action="{{route('admin.register')}}" method="POST" id="registerUser">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" name="name" class="form-control" placeholder="enter your name">
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" name="username" class="form-control" placeholder="enter your username">
                            </div>
                            <div class="form-group mb-3">
                                <input type="email" name="email" class="form-control" placeholder="enter your email">
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" name="password" class="form-control" placeholder="enter your password">
                            </div>

                            <div class="d-grid mx-auto">
                                <span id="loader" class="text-center"></span>
                                <button type="submit" class="btn btn-dark btn-block" id="submitbtn">Sign Up</button>
                            </div>
                            <span>if you have an account please ? <a href="{{route('admin.login')}}">login</a></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection