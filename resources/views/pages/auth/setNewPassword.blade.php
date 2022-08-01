@extends('layouts.default')

@section('content')
    <body>
        <div class="main-banner">
            <section class="vh-100" style="background-color: white;">
                <div class="container">
                    @if (Session::has('error_message'))
                        <div class="alert">{{ Session::get('error_message') }}</div>
                    @endif
                    @if (Session::has('success_message'))
                        <div class="alert">{{ Session::get('success_message') }}</div>
                    @endif
                    {{ Lang::get('Welcome to the password recovery page') }}, {{ $name }}
                    <p></p>
                    {{ Lang::get('Please, enter the new password') }}
                    <form method="POST" action="{{ route('set-new-password-post', ['lang' => 'ru', 'token' => $token]) }}" class="mx-1 mx-md-4">
                        @csrf
                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <input type="password" id="new_password" name="password" class="form-control" required/>
                                <label class="form-label" for="new_password">{{Lang::get("Password")}}</label>
                            </div>
                        </div>
                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <input type="password" id="new_password_confirmation" name="password_confirmation" class="form-control" required/>
                                <label class="form-label" for="new_password_confirmation">{{Lang::get("Repeat your password")}}</label>
                                <p></p>
                                <span id="reset_message"></span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                            <button type="submit" id="set_new_password_submit" class="btn btn-primary btn-lg">{{Lang::get("Accept")}}</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </body>

    <script>
        window.onload = function() {
            $('#new_password, #new_password_confirmation').on('keyup', function () {
    
                $('#reset_message').html('Отлично!').css('color', 'green');
                $("#set_new_password_submit").prop("disabled",false);
                pass_input = $('#new_password').val()
                pass_confirm_input = $('#new_password_confirmation').val()
    
                if (pass_input != pass_confirm_input) {
                    $('#reset_message').html('Пароли не совпадают').css('color', 'red');
                    $("#set_new_password_submit").prop("disabled",true);
                }
                if (pass_input.length < 7) {
                    $('#reset_message').html('Минимальная длина пароли - 7 символов').css('color', 'red');
                    $("#set_new_password_submit").prop("disabled",true);
                }
                if(!/[0-9]/.test(pass_input) || !/[a-zA-Z]/.test(pass_input)) {
                    $('#reset_message').html('Пароль должен содержать минимум 1 букву и 1 цифру').css('color', 'red');
                    $("#set_new_password_submit").prop("disabled",true);
                }
            });
        }
  </script>
@stop