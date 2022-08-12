@extends('layouts.default')
@section('title', Lang::get('My appeal') . ' - #' . $ticket->ticket_uid)

@section('content')
<body>
    <div class="main-banner">
        <h3>{{ Lang::get('My appeal') }} - #{{ $ticket->ticket_uid }}</h3>
        <div class="row">
            <div class="col-md-9 col-sm-12">
                <div class="operators-message">
                    <p>{{ $ticket->ticket_status->name_ru }}<span class="created-date">{{ $ticket->created_at }}</span>   </p>
                    <p class="paragraph"><h4>{{ $ticket->title }}</h4></p>
                    <p class="paragraph">{{ $ticket->initial_message }}</p>
                    <p class="paragraph">{{ Lang::get('Attached files') }}</p>
                    @if ($ticket->uploads->isNotEmpty())
                        <div id="images-preview">
                            @foreach ($ticket->uploads as $upload)
                                <img class="uploading-files col-sm" src="{{URL::asset($upload->path)}}" alt="">
                            @endforeach
                        </div>
                    @endif
                </div>
                @foreach ($ticket->messages as $message)
                    <div 
                    @if ($message->created_by_type == 1)
                        class="clients-message"
                    @else
                        class="operators-message"
                    @endif
                    >
                        <p><span class="created-date">{{ $message->created_at }}</span></p>
                        <p class="paragraph"><h4>{{ $message->message_body }}</h4></p>
                        @if ($message->created_by_type != 1)
                        <p class="paragraph">
                            <form action="">
                                <div class="starrating risingstar d-flex flex-row-reverse">
                                    @for ($i = 1; $i < 6; $i++)
                                        <input onclick="evaluate_ajax(value, {{ $message->id }})" type="radio" id="star{{$i}}{{ $message->id }}" name="rating" value="{{$i}}" 
                                            @if ($message->evaluation == $i)
                                                checked
                                            @endif
                                        /><label for="star{{$i}}{{ $message->id }}"></label>
                                    @endfor
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-6">
                                    <div id="eval-message{{ $message->id }}" class="alert alert-light evaluation-message" role="alert"></div>
                                </div>
                                <div class="col-6">
                                    <p><span class="created-by">{{ $message->message_created_by->name }}</span></p>
                                </div>
                            </div>
                            
                            
                        </p>
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="col-md-3 col-sm-12">
                Col 2
            </div>
        </div>
    </div>
</body>
<script>
    $(".evaluation-message").hide();
    function evaluate_ajax(value, message_id){
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
                console.log(res);
                console.log("#eval-message" + message_id);
            },
            error: function (res) {
                console.log('error')
            }
        });
    }
</script>
@stop
