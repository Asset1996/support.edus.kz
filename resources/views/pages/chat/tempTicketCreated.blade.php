@extends('layouts.default')
@section('title', Lang::get('Request activation'))

@section('content')
    <body>
        <div class="container">
            <div class="main-banner">
                <h1>{{ Lang::get('Request activation') }}</h1>
                <p><strong>{{ $ticket->user->name }}</strong>, {{ Lang::get('you have created a new request, but it is inactive - in order for technical support specialists to see it, you need to confirm the email you specified') }} <strong>{{ $ticket->user->email }}</strong>.</p>
                <p style="color: red">{{ Lang::get('An activation link has been sent to your email, please check your inbox') }}.</p>
            </div>
        </div>
    </body>
@stop
