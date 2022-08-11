@extends('layouts.default')
@section('title', Lang::get('My profile'))

@section('content')
<body>
    <div class="main-banner">
        <h3>{{ Lang::get('My profile') }}</h3>
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <hr class="my-4">
                <div class="row">
                    <div class="col-6" style="text-align:right">
                        <p>{{ Lang::get('Name') }}:</p>
                        <p>{{ Lang::get('Surname') }}:</p>
                        <p>{{ Lang::get('Email') }}:</p>
                        <p>{{ Lang::get('Phone') }}:</p>
                    </div>
                    <div class="col-6">
                        <p>{{ $user->name }}</p>
                        <p>
                            @if ($user->surname) 
                                <form id="profile-surname-form-default" method="POST" action="{{ route('profile-update') }}">
                                    @csrf
                                    <input class="form-control profile-input" type="text" name="surname" id="profile-surname" value="{{ $user->surname }}">
                                    <button type="submit" class="btn btn-primary btn-sm">Изменить</button>
                                </form>
                            @else 
                                <a href="#" id="toggle-surname-form">Указать</a>
                                <form id="profile-surname-form" method="POST" action="{{ route('profile-update') }}">
                                    @csrf
                                    <input class="form-control profile-input" type="text" name="surname" id="profile-surname">
                                    <button type="submit" class="btn btn-primary btn-sm">Изменить</button>
                                </form>
                            @endif
                        </p>
                        <p>{{ $user->email }}</p>
                        <p>
                            @if ($user->phone) 
                                <form id="profile-phone-form-default" method="POST" action="{{ route('profile-update') }}">
                                    @csrf
                                    <input class="form-control profile-input" type="text" name="phone" id="profile-phone" value="{{ $user->phone }}">
                                    <button type="submit" class="btn btn-primary btn-sm">Изменить</button>
                                </form>
                            @else 
                                <a href="#" id="toggle-phone-form">Указать</a>
                                <form id="profile-phone-form" method="POST" action="{{ route('profile-update') }}">
                                    @csrf
                                    <input class="form-control profile-input" class="profile-input" type="text" name="phone" id="profile-phone">
                                    <button type="submit" class="btn btn-primary btn-sm" id="profile-phone-submit">Изменить</button>
                                </form>
                            @endif
                        </p>
                    </div>
                </div>
                
                <hr class="my-4">
            </div>
            <div class="col-md-4 col-sm-12">
                <p>{{ Lang::get('Tickets amount') }}: {{$user->tickets->count()}}</p>
                <p>{{ Lang::get('Comments amount') }}: {{$user->created_messages->count()}}</p>
                <p>{{ Lang::get('Evaluations (average)') }}: 
                @if ($user->evaluated_messages->avg('evaluation'))
                    {{$user->evaluated_messages->avg('evaluation')}}
                @else
                    0
                @endif </p>
            </div>
        </div>
    </div>
</body>
<script>
    $('#profile-phone-form').hide();
    $('#profile-surname-form').hide();

    $('#toggle-phone-form').on('click', function () {
        $('#profile-phone-form').show();
        $(this).hide();
    })
    $('#toggle-surname-form').on('click', function () {
        $('#profile-surname-form').show();
        $(this).hide();
    })


    $("#profile-phone").keyup(function (e){
        pass_input = $(this).val()
        if (pass_input.length > 11 || pass_input.length < 11) {
            $("#profile-phone-submit").prop("disabled",true);
        }else{
            $("#profile-phone-submit").prop("disabled",false);
        }
    })

    $("#profile-phone").keypress(function (e){
        pass_input = $(this).val()
        length = pass_input.length + 1
        var charCode = (e.which) ? e.which : e.keyCode;

        if (pass_input.length > 11 || pass_input.length < 11) {
            $("#profile-phone-submit").prop("disabled",true);
        }else{
            $("#profile-phone-submit").prop("disabled",false);
        }

        if ((charCode > 31 && (charCode < 48 || charCode > 57)) || length > 11) {
            return false;
        }
    });
</script>
@stop
