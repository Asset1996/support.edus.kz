@extends('layouts.default')

@section('content')
<body>
    <div class="main-banner">
            <div class="container h-100">
                @if (Session::has('error_message'))
                    <div class="alert">{{ Session::get('error_message') }}</div>
                @endif
                @if (Session::has('success_message'))
                    <div class="alert">{{ Session::get('success_message') }}</div>
                @endif
                <div class="row d-flex justify-content-center align-items-center">
                    <div>
                        <form method="POST" action="{{ route('authenticate') }}" class="mx-1 mx-md-4">
                            @csrf
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
                            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                <button type="submit" class="btn btn-primary btn-lg">{{Lang::get("Login")}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</body>

@stop