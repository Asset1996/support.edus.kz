@extends('layouts.default')
@section('title', Lang::get('Update appeal No') . $my_ticket->id)

@section('content')
<body>
    <div class="main-banner"> 
        <h3>{{ Lang::get('Update appeal No') }} {{$my_ticket->ticket_uid}}</h3>
        <div class="row">
            <div class="col-md-8 col-sm-12">
                {{ 
                    Lang::get('Our support team makes his best effort to process your request ASAP. As soon as we respond to your request (ticket), you will receive an email notification.') 
                }}
                <form method="POST" action="{{ route('update-ticket-post', ['ticket_uid' => $my_ticket->ticket_uid]) }}">
                    @csrf
                    {{-- First page --}}
                    <div id="first_block">
                        @foreach ($service_types as $service_type)
                            <div class="form-check">
                                <label class="form-check-label" for="service_types_id_{{ $service_type->id }}">
                                    <input value="{{ $service_type->id }}" class="form-check-input" type="radio" name="service_types_id" id="service_types_id_{{ $service_type->id }}"
                                    @if ($my_ticket->service_types_id == $service_type->id)
                                        checked
                                    @endif>
                                    {{ $service_type->name_ru }}
                                </label>
                            </div>
                        @endforeach
                        
                        <div class="d-flex mx-4 mb-3 mb-lg-4">
                            <button 
                                id="write_text_button" 
                                type="button" 
                                class="btn btn-primary btn-lg"
                                onclick="toggle_blocks()"
                            >{{Lang::get("Write request")}}</button>
                        </div>
                    </div>
                    {{-- First page END --}}
                    {{-- Second page --}}
                    <div id="second_block">
                        <div class="row">
                            <div class="col-6">
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <div class="form-outline flex-fill mb-0">
                                        <label class="form-label" for="ask_email">{{Lang::get("Email")}}</label>
                                        @if ($user)
                                            <input type="email" value="{{ $user->email }}" id="ask_email" name="email" class="form-control" required readonly/>
                                        @else
                                            <input type="email" id="ask_email" name="email" class="form-control" required/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <div class="form-outline flex-fill mb-0">
                                        <label class="form-label" for="ask_name">{{Lang::get("Your name")}}</label>
                                        @if ($user)
                                            <input type="text" value="{{ $user->name }}" id="ask_name" name="name" class="form-control" required readonly/>
                                        @else
                                            <input type="text" id="ask_name" name="name" class="form-control" required/>
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
                            <input type="text" class="form-control" id="ask_title" name="title" value="{{ $my_ticket->title }}" required>
                        </div>
                        <div class="form-group">
                            <label for="ask_initial_message">{{ Lang::get('Detailed description of your request') }}</label>
                            <textarea class="form-control" id="ask_initial_message" name="initial_message" rows="6" required>{{ $my_ticket->initial_message }}</textarea>
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
</body>
<script>
    function toggle_blocks(){ 
        selected_service_type = $('input[name="service_types_id"]:checked').parent('label').text();
        $("#service_type_text").text(selected_service_type);
        $('#first_block').hide();
        $('#second_block').show(); 
    }
</script>
@stop
