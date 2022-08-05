@extends('layouts.default')

@section('content')
<body>
    <div class="main-banner">
        <section class="vh-100" style="background-color: white;">
            <div class="container">
                <div>
                    <h1>{{ Lang::get('Ticket created') }}</h1>
                    <p>{{ Lang::get('Thank you') }}, <strong>{{ $ticket->user->name }}</strong>,</p>
                    <p>{{ Lang::get('Your appeal has been registered, please wait for a response from specialists') }}.</p>
                    <p>{{ Lang::get('The history of your requests is in the section') }} "<a href="{{ route('tickets-list') }}">{{Lang::get('My appeals')}}</a>"</p>
                </div>
                <div class="created-ticket">
                    <p class="paragraph">{{ $ticket->service_type->name_ru }} <a href="#" class="change-button">{{ Lang::get('Update') }}</a></p>
                    <p class="paragraph"><h4>{{ $ticket->title }}</h4></p>
                    <p class="paragraph">{{ $ticket->initial_message }}</p>
                    <p class="paragraph">{{ Lang::get('Attached files') }}</p>
                </div>
            </div>
        </section>
    </div>
</body>
@stop
