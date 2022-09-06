@extends('layouts.default')
@section('title', Lang::get('New password'))

@section('content')
    <body>
        <div class="container">
            <div class="main-banner">
                
                <h3>{{ Lang::get('Welcome to the password recovery page') }}, {{ $name }}</h3>
                <p></p>
                {{ Lang::get('Please, enter the new password') }}
                <form method="POST" action="{{ route('set-new-password-post', ['lang' => 'ru', 'token' => $token]) }}">
                    @csrf
                    <div class="d-flex flex-row align-items-cente">
                        <div class="form-outline flex-fill mb-0">
                            <input type="password" id="new_password" name="password" class="form-control" required/>
                            <label class="form-label" for="new_password">{{Lang::get("Password")}}</label>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                        <div class="form-outline flex-fill mb-0">
                            <input type="password" id="new_password_confirmation" name="password_confirmation" class="form-control" required/>
                            <label class="form-label" for="new_password_confirmation">{{Lang::get("Repeat your password")}}</label>
                            <p></p>
                            <span id="reset_message"></span>
                        </div>
                    </div>
                    <div class="d-flex mb-3 mb-lg-4">
                        <button type="submit" id="set_new_password_submit" class="btn btn-primary">{{Lang::get("Accept")}}</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
@stop