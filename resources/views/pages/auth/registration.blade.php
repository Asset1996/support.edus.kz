@extends('layouts.default')

@section('content')
<body>
    <div class="main-banner">
        <section class="vh-100" style="background-color: white;">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center">
                    @if (Session::has('error_message'))
                        <div class="alert">{{ Session::get('error_message') }}</div>
                    @endif
                    @if (Session::has('success_message'))
                        <div class="alert">{{ Session::get('success_message') }}</div>
                    @endif
                    <div class="col-lg-12 col-xl-11">
                        <div class="card text-black" style="border-radius: 25px;">
                            <div class="card-body p-md-5">
                                <div class="row justify-content-center">
                                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                    
                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">{{Lang::get("Sign up")}}</p>
                    
                                    <form method="POST" action="{{ route('registration-post') }}" class="mx-1 mx-md-4">
                                        @csrf
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" id="form3Example1c" name="name" class="form-control" />
                                                <label class="form-label" for="form3Example1c">{{Lang::get("Name")}}</label>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="email" id="form3Example3c" name="email" class="form-control" />
                                                <label class="form-label" for="form3Example3c">{{Lang::get("Email")}}</label>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" id="form3Example4c" name="password" class="form-control" />
                                                <label class="form-label" for="form3Example4c">{{Lang::get("Password")}}</label>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" id="form3Example4cd" name="password_confirmation" class="form-control" />
                                                <label class="form-label" for="form3Example4cd">{{Lang::get("Repeat your password")}}</label>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" class="btn btn-primary btn-lg">{{Lang::get("Register")}}</button>
                                        </div>
                                    </form>
                    
                                    </div>
                                    <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                                        class="img-fluid" alt="Sample image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

@stop