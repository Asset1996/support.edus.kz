@extends('layouts.default')
@section('title', Lang::get('My appeal') . ' - #' . $ticket->ticket_uid)

@section('content')
<body>
    <div>
        <div class="container-fluid">
            <div class="main-banner">
                <h3 style="color: #000000; font-size: 40px; font-weight: 400;" class="ml-85">{{ Lang::get('My appeal') }} - <span style="color: #006BCE;">#{{ $ticket->ticket_uid }}</span></h3>
                <div class="ose" style="margin-top: 80px;">
                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <div class="view_item ml-85">
                                <div class="vmes">
                                    <div class="header_footer" style="margin-bottom: 15px;">
                                        <div class="d-flex flex-wrap justify-content-between align-items-end">
                                            <div style="margin-bottom: -10px;" class="badge"> <span style="padding: 5px 33px; background: #00B212; color: white;">{{ $ticket->ticket_status->name_ru }}</span> </div>
                                            <div class="badge" style="margin-top: 20px;"> <span>{{ $ticket->created_at }}</span> </div>
                                        </div>
                                    </div>
                                    <div style="word-break: break-word;" class="operators-message2">
                                        <h4 style="font-weight: 700; font-size: 20px; color: #000000;">{{ $ticket->title }}</h4>
                                        <p style="font-weight: 400; color: #000000; font-size: 18px;" class="paragraph">{{ $ticket->initial_message }}</p>
                                        @if ($ticket->uploads->isNotEmpty())
                                            <div id="images-preview">
                                                @foreach ($ticket->uploads as $upload)
                                                    <img style="width: 100px; height: 70px;" class="uploading-files col-sm" src="{{URL::asset($upload->path)}}" alt="">
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @foreach ($ticket->messages as $message)
                                    <div @if ($message->created_by_type == 1)
                                             class="clients-message"
                                         @else
                                             class="operators-message"
                                        @endif
                                    >
                                        <div class="header_footer">
                                            <div class="d-flex flex-wrap justify-content-between v">
                                                <div class="badge"> <span style="color:#CCCCCC;">Отвечен через 1 час 40 мин.</span> </div>
                                                <div class="badge"> <span>{{ $message->created_at }}</span> </div>
                                            </div>
                                        </div>
                                        <div @if ($message->created_by_type == 1)
                                                 class="clients-bg" style="margin-top: 20px; border-radius: 20px; padding: 20px 39px 14px 39px;"
                                             @else
                                                 class="operators-bg"
                                             @endif
                                             style="border-radius: 20px; padding: 43px 39px 0 39px; margin-top: 20px;" class="views_content">
                                            <div class="views_text">
                                                <p>
                                                    {{ $message->message_body }}
                                                </p>
                                            </div>
                                            <div @if ($message->created_by_type == 1)
                                                     class="d-none"
                                                 @endif
                                                 class="views_footer"
                                                 style="padding-bottom: 8px; padding-top: 21px;"
                                            >
                                                <div class="d-flex justify-content-between flex-wrap" style="align-items: center;">
                                                    <div class="badge">
                                                        <form action="">
                                                            <div class="starrating risingstar d-flex flex-row-reverse">
                                                                @for ($i = 1; $i < 6; $i++) <input onclick="evaluate_message_ajax(value, {{ $message->id }})" type="radio" id="star{{$i}}{{ $message->id }}" name="rating" value="{{6 - $i}}" @if ($message->evaluation == 6 - $i)
                                                                    checked
                                                                    @endif
                                                                /><label for="star{{$i}}{{ $message->id }}"></label>
                                                                @endfor
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="d-flex flex-row align-items-center">
                                                        <div class="icon">
                                                            <img src="{{ asset('images/admin.svg') }}" alt="">
                                                        </div>
                                                        <div style="margin-left: 13px;" class="ms-2 c-details">
                                                            <h6 class="mb-0">{{ $message->message_created_by->name }}</h6> <span>1 days ago</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div id="eval-message{{ $message->id }}" class="alert alert-light evaluation-message" role="alert"></div>
                                                    </div>
                                                    <div class="col-6">
                                                        <p><span class="created-by">{{ $message->message_created_by->name }}</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div style="margin-bottom: 16px;  padding-bottom: 13px; margin-left: 30px;   border-bottom: 0.5px solid #000000;" class="pos_ose">
                                    <div class="row align-items-center">
                                        <div class="col-sm col-lg-auto">
                                            <div class="pos_text">
                                                <p style="color: #000000;">Оцените, насколько удовлетворены ответом:</p>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="pos_R">
                                                <div class="starrating risingstar d-flex flex-row-reverse" style="margin-top: -8px;">

                                                    <form action="">
                                                        <div class="starrating risingstar d-flex flex-row-reverse">
                                                            @for ($i = 1; $i < 6; $i++) <input onclick="evaluate_ticket_ajax(value, {{ $ticket->id }})" type="radio" id="star{{$i}}{{ $ticket->id }}" name="rating" value="{{6 - $i}}" @if ($ticket->evaluation == 6 - $i)
                                                                checked
                                                                @endif
                                                            /><label for="star{{$i}}{{ $ticket->id }}"></label>
                                                            @endfor
                                                        </div>
                                                    </form>
                                                </div>
                                                <div id="eval-ticket" class="alert alert-light evaluation-ticket" role="alert"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($ticket->status_id == 1)
                                    <div class="view_btn_group mt-4">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="view_btn">
                                                    <form method="GET" action="{{ route('update-ticket', ['ticket_uid' => $ticket->ticket_uid]) }}">
                                                        @csrf
                                                        <div class="d-flex mb-3 mb-lg-4">
                                                            <button class="btn ticketBtn ticketBtn1" type="submit">{{ Lang::get('Update') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div style="margin-left: -20px;" class="view_btn">
                                                    <form method="POST" action="{{ route('delete-ticket', ['ticket_uid' => $ticket->ticket_uid]) }}">
                                                        @csrf
                                                        <div class="d-flex mb-3 mb-lg-4">
                                                            <button class="btn ticketBtn ticketBtn2" type="submit">{{ Lang::get('Cancel') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif ($ticket->status_id == 2)
                                    {{Lang::get('Your request is being processed by the operator. Wait for a response from the operator.')}}
                                @elseif ($ticket->status_id == 3)

                                    <form method="POST" action="{{ route('write-message', ['ticket_uid' => $ticket->ticket_uid]) }}" style="margin-left: 30px;">
                                        @csrf
                                        <div class="">
                                            <div style="max-width: 642px;" class="form-group">
                                                <label for="ask_initial_message">{{ Lang::get('Write new message') }}</label>
                                                <textarea class="form-control myInput" id="message_body" name="message_body" rows="6" required="" style="height: 170px;" required></textarea>
                                            </div>
                                        </div>
                                        <div class="d-flex mb-3 mb-lg-4">
                                            <button style="background: #006BCE; color: white;" class="btn" type="submit">{{ Lang::get('Send') }}</button>
                                        </div>
                                    </form>

                                    <form style="margin-left: 30px;" method="POST" action="{{ route('close-ticket', ['ticket_uid' => $ticket->ticket_uid]) }}">
                                        @csrf
                                        <div class="d-flex mb-3 mb-lg-4">
                                            <button style="background: #006BCE; border: 3px solid #006BCE; border-radius: 8px; color: white; padding: 8px 67px;" class="btn" type="submit">{{ Lang::get('Close ticket') }}</button>
                                        </div>
                                    </form>

                                @elseif ($ticket->status_id == 4)
                                    {{ Lang::get('Ticket is closed') }}
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="appeals-filter">
                                <p class="appleale-title">{{ Lang::get('Appeals filter') }}</p>
                                <div class="filter-inner-block">
                                    <p>{{ Lang::get('Appeals category') }}:</p>
                                    <p><strong>{{ $ticket->service_type->name_ru }}</strong></p>
                                </div>
                                <div class="filter-inner-block">
                                    <p>{{ Lang::get('Subcategory') }}:</p>
                                    <p><strong>{{ $ticket->subcategory }}</strong></p>
                                </div>
                                <div class="filter-inner-block">
                                    <p>{{ Lang::get('Appeals priority') }}:</p>
                                    <p><strong>{{ $ticket->priority }}</strong></p>
                                </div>
                                <div class="filter-inner-block">
                                    <p>{{ Lang::get('Tags') }}:</p>
                                    <p><strong>{{ $ticket->tags }}</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(".evaluation-message").hide();
    $(".evaluation-ticket").hide();
    //Evaluation of message
    function evaluate_message_ajax(value, message_id){
        console.log(value)
        console.log(message_id)
        $.ajax({
            url: "{{ route('evaluate-message') }}",
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'message_id': message_id,
                'evaluation': value
            },
            success: function(res){
                $("#eval-message"+message_id).show();
                $("#eval-message"+message_id).html(res);
                setTimeout(function(){ $("#eval-message"+message_id).hide(); },3000);
            },
            error: function (res) {
                console.log('error')
            }
        });
    }
    //Evaluation of ticket
    function evaluate_ticket_ajax(value, ticket_id){
        console.log(value)
        console.log(ticket_id)
        $.ajax({
            url: "{{ route('evaluate-ticket') }}",
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'ticket_id': ticket_id,
                'evaluation': value
            },
            success: function(res){
                console.log('success', res)
                $("#eval-ticket").show();
                $("#eval-ticket").html(res);
                setTimeout(function(){ $("#eval-ticket").hide(); },3000);
            },
            error: function (res) {
                console.log('error')
            }
        });
    }
</script>
@stop
