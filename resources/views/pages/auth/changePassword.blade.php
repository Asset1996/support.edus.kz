@extends('layouts.default')
@section('title', Lang::get('New password'))

@section('content')
    <body>
        <div class="main-banner">
            
            <h3>{{ Lang::get('Welcome to the password recovery page') }}, {{ auth()->user()->name }}</h3>
            <p style="margin-bottom: 30px">{{ Lang::get('Please, enter the old and new password') }}</p>
            <form method="POST" action="{{ route('change-password-post') }}">
                @csrf
                <div class="d-flex flex-row align-items-cente">
                    <div class="form-outline flex-fill mb-0">
                        <input type="password" id="old_password" name="old_password" class="form-control" required/>
                        <label class="form-label" for="old_password">{{Lang::get("Old password")}}</label>
                    </div>
                </div>
                <div class="d-flex flex-row align-items-cente">
                    <div class="form-outline flex-fill mb-0">
                        <input type="password" id="new_password" name="password" class="form-control" required/>
                        <label class="form-label" for="new_password">{{Lang::get("New password")}}</label>
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
    </body>
@stop