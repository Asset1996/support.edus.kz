@extends('layouts.default')
@section('title', Lang::get('Ticket created'))

@section('content')

<body>
    <div class="container">
        <div class="main-banner">
            <div>
                <h1>{{ Lang::get('Ticket created') }}</h1>
                <p>{{ Lang::get('Thank you') }}, <strong>{{ $ticket->user->name }}</strong>,</p>
                <p>{{ Lang::get('Your appeal has been registered, please wait for a response from specialists') }}.</p>
                <p>{{ Lang::get('The history of your requests is in the section') }} "<a href="{{ route('tickets-list') }}">{{Lang::get('My appeals')}}</a>"</p>
            </div>
            <div class="created-ticket">
                <p class="paragraph">{{ $ticket->service_type->name_ru }} <a href="#" class="change-button">{{ Lang::get('Update') }}</a></p>
                <p class="paragraph">
                <h4 style="font-weight: 700; font-size: 20px; color: #000000;">{{ $ticket->title }}</h4>
                </p>
                <p style="font-weight: 400; color: #000000; font-size: 18px;" class="paragraph">{{ $ticket->initial_message }}</p>
                <p class="paragraph">{{ Lang::get('Attached files') }}</p>
                @if ($ticket->uploads->isNotEmpty())
                <div id="images-preview">
                    @foreach ($ticket->uploads as $upload)
                    <img style="width: 100px; height: 70px;" class="uploading-files col-sm" src="{{URL::asset($upload->path)}}" alt="">
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</body>
@stop