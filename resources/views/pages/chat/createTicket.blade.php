@extends('layouts.default')
@section('title', Lang::get('New appeal'))

@section('content')
<body>
    <div class="container">
        <div class="main-banner">
            <h3>{{ Lang::get('New appeal') }}</h3>
            <div class="row" style="justify-content: space-between;">
                <div class="col-md-8 col-sm-12">
                    {{
                    Lang::get('Our support team makes his best effort to process your request ASAP. As soon as we respond to your request (ticket), you will receive an email notification')
                }}
                    <form method="POST" action="{{ route('ask-question-post') }}" enctype="multipart/form-data">
                        @csrf
                        {{-- First page --}}
                        <div id="first_block">
                            @foreach ($service_types as $service_type)
                            <div class="form-check mt-4">
                                <label style="font-weight: 700;" class="form-check-label formLabel" for="service_types_id_{{ $service_type->id }}">
                                    <input value="{{ $service_type->id }}" class="form-check-input PodsInput" type="radio" name="service_types_id" id="service_types_id_{{ $service_type->id }}" @if ($service_type->id == 1)
                                    checked
                                    @endif>
                                    {{ $service_type["name_" . Lang::locale()] }}
                                </label>
                            </div>
                            @endforeach

                            <div class="d-flex mb-3 mt-4 mb-lg-4">
                                <button style="min-width: 300px;" id="write_text_button" type="button" class="btn btn-primary btn-lg" onclick="toggle_blocks()">{{Lang::get("Write request")}}</button>
                            </div>
                        </div>
                        {{-- First page END --}}
                        {{-- Second page --}}
                        <div id="second_block">
                            <div class="row">
                                <div class="col-6">
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div class="form-outline flex-fill mb-0 w-100">
                                            <label class="form-label" for="ask_email">{{Lang::get("Email")}}</label>
                                            @if ($user)

                                            <input type="email" value="{{ $user->email }}" id="ask_email" name="email" class="form-control myInput" required readonly />
                                            @else
                                            <input type="email" id="ask_email" name="email" class="form-control myInput" required />
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div class="form-outline flex-fill mb-0 w-100">
                                            <label class="form-label" for="ask_name">{{Lang::get("Your name")}}</label>
                                            @if ($user)
                                            <input type="text" value="{{ $user->name }}" id="ask_name" name="name" class="form-control myInput" required readonly />
                                            @else
                                            <input type="text" id="ask_name" name="name" class="form-control myInput" required />
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
                                <input type="text" class="form-control myInput" id="ask_title" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="ask_initial_message">{{ Lang::get('Detailed description of your request') }}</label>
                                <textarea class="form-control myInput" id="ask_initial_message" name="initial_message" rows="6" required></textarea>
                            </div>

                            {{-- File upload --}}

                            <label for="ask-file-input" class="" style="cursor: pointer;"><img src="/images/pin.png" alt=""> <span style="color: #76AFE4; font-size: 18px;">Прикрепить файл</span></label>
                            <input name='ask_images[]' style="display: none;" class="form-control " type='file' data-classButton="btn btn-primary" id="ask-file-input" data-input="false" multiple />
                            {{-- File upload END --}}

                            <div class="form-group form-check mt-5">
                                <input type="checkbox" class="form-check-input" id="create_ticket_not_robot" name="not_robot">
                                <label style="font-size: 17px;" class="form-check-label" for="create_ticket_not_robot">{{ Lang::get('I\'m not robot:') }}</label>
                            </div>

                            <div class="d-flex mb-3 mb-lg-4">
                                <button style="min-width: 300px;" type="submit" class="btn btn-primary btn-lg">{{Lang::get("Send request")}}</button>
                            </div>
                        </div>
                        {{-- Second page END --}}
                    </form>
                    <div id="images-preview"></div>

                </div>
                <div class="col-md-3 col-sm-12 info-block">
                    <h5>{{ Lang::get('Hint') }}</h5>
                    <p>{{ Lang::get('We try to respond to all requests (tickets) as soon as possible. But we can do it even faster if you write your request in more detail and clearly') }}. </p>
                    <p>{{ Lang::get('Please note that if you supplement an already open request with new details, the response time may increase as the request is re-added to the queue. Therefore, it is important to send a detailed request right away') }}. </p>
                </div>
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

    $("#images-preview").hide();
    function readURL(input) {
        $("#images-preview").show();
        $("#images-preview").empty();
        
        files = input.files

        if (files) {
            for (let i = 0; i < files.length; i++) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    jQuery('<img>', {
                        id: 'image-' + i,
                        class: 'uploading-files col-sm',
                    }).appendTo('#images-preview');
                    $('#image-' + i).attr('src', e.target.result);
                }
                reader.readAsDataURL(files[i]);
                
            }
        }
    }
    $("#ask-file-input").change(function(){
        readURL(this);
    });
</script>
@stop
