@extends('layouts.default')

@section('content')
    <body>
        <div class="main-banner">
            <section class="vh-100" style="background-color: white;">
                <div class="container">
                    <h1>{{ Lang::get('Request activation') }}</h1>
                    <p><strong>{{ $ticket->user->name }}</strong>, {{ Lang::get('you have created a new request, but it is inactive - in order for technical support specialists to see it, you need to confirm the email you specified') }} <strong>{{ $ticket->user->email }}</strong>.</p>
                    <p style="color: red">{{ Lang::get('An activation link has been sent to your email, please check your inbox') }}.</p>
                </div>
            </section>
        </div>
    </body>
@stop
