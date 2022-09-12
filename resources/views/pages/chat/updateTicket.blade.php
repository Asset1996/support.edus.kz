@extends('layouts.default')
@section('title', Lang::get('Update appeal No') . $my_ticket->id)

@section('content')
<body>
    <div class="container">
        <div class="main-banner"> 
            <h3>{{ Lang::get('Update appeal No') }} {{$my_ticket->ticket_uid}}</h3>
            <div class="row justify-content-between">
                <div class="col-md-8 col-sm-12">
                    <form method="POST" action="{{ route('update-ticket-post', ['ticket_uid' => $my_ticket->ticket_uid]) }}">
                        @csrf
                        {{-- Second page --}}
                        <div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div class="form-outline flex-fill mb-0 w-100">
                                            <label class="form-label" for="ask_email">{{Lang::get("Email")}}</label>
                                            @if ($user)
                                                <input type="email" value="{{ $user->email }}" id="ask_email" name="email" class="form-control myInput" required readonly/>
                                            @else
                                                <input type="email" id="ask_email" name="email" class="form-control myInput" required/>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div class="form-outline flex-fill mb-0 w-100">
                                            <label class="form-label" for="ask_name">{{Lang::get("Your name")}}</label>
                                            @if ($user)
                                                <input type="text" value="{{ $user->name }}" id="ask_name" name="name" class="form-control myInput" required readonly/>
                                            @else
                                                <input type="text" id="ask_name" name="name" class="form-control myInput" required/>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <span style="color:red">{{ Lang::get("Your question regarding") }}:</span>
                                <span id="service_type_text" style="font-weight:bold"></span>
                            </div>
                            <div class="form-group">
                                <label for="ask_title">{{ Lang::get('Message subject') }}</label>
                                <input type="text" class="form-control myInput" id="ask_title" name="title" value="{{ $my_ticket->title }}" required>
                            </div>
                            <div class="form-group">
                                <label for="ask_initial_message">{{ Lang::get('Detailed description of your request') }}</label>
                                <textarea class="form-control myInput" id="ask_initial_message" name="initial_message" rows="6" required>{{ $my_ticket->initial_message }}</textarea>
                            </div>

                            <div id="uploads-preview">
                                @if ($my_ticket->uploads->isNotEmpty())
                                    @foreach ($my_ticket->uploads as $upload)
                                    @if ($upload->type == 'image')
                                        <img class="uploading-files col-sm" src="{{URL::asset($upload->path)}}" alt="">
                                    @else 
                                        <p>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' fill='currentColor' class='bi bi-file-earmark-text-fill' viewBox='0 0 16 16'>
                                                <path d='M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM4.5 9a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 1 0-1h4a.5.5 0 0 1 0 1h-4z'/>
                                            </svg>{{ $upload->original_name }}
                                        </p>
                                    @endif
                                    @endforeach
                                @endif
                            </div>

                            <div class="form-group form-check mt-5">
                                <input type="checkbox" class="form-check-input" id="update_ticket_not_robot" name="not_robot">
                                <label style="font-size: 17px;" class="form-check-label" for="update_ticket_not_robot">{{ Lang::get('I\'m not robot:') }}</label>
                            </div>

                            <div class="d-flex mx-4 mb-3 mb-lg-4">
                                <button type="submit" class="btn btn-primary btn-lg">{{Lang::get("Save request")}}</button>
                            </div>
                        </div>
                        {{-- Second page END --}}
                    </form>
                </div>
                <div class="col-md-4 col-sm-12 info-block">
                    <h5>{{ Lang::get('Hint') }}</h5>
                    <p>{{ Lang::get('We try to respond to all requests (tickets) as soon as possible. But we can do it even faster if you write your request in more detail and clearly') }}. </p>
                    <p>{{ Lang::get('Please note that if you supplement an already open request with new details, the response time may increase as the request is re-added to the queue. Therefore, it is important to send a detailed request right away') }}. </p>
                </div>
            </div>
        </div>
    </div>
</body>
@stop
