@extends('layouts.default')
@section('title', Lang::get('New appeal'))

@section('content')
<body>
    <div class="container">
        <div class="main-banner">
            <h3 style="color: #000000; font-size: 40px;">{{ Lang::get('New appeal') }}</h3>
            <div class="row" style="justify-content: space-between;">
                <div class="col-md-8 col-sm-12">
                    <p style="color: #000000; max-width: 690px; line-height: 19px; margin-bottom: 32px;">
                        {{
                            Lang::get('Our support team makes his best effort to process your request ASAP. As soon as we respond to your request (ticket), you will receive an email notification')
                        }}
                    </p>
                    <form method="POST" action="{{ route('create-ticket-post') }}" enctype="multipart/form-data">
                        @csrf
                        {{-- First page --}}
                        <div id="first_block">
                            @foreach ($service_types as $service_type)
                            <div class="form-check mt-4">
                                <label style="font-weight: 700; font-size: 18px;" class="form-check-label formLabel" for="service_types_id_{{ $service_type->id }}">
                                    <div class="col-1">
                                        <input value="{{ $service_type->id }}" class="form-check-input PodsInput" type="radio" name="service_types_id" id="service_types_id_{{ $service_type->id }}" @if ($service_type->id == 1)
                                        checked
                                        @endif>
                                    </div>
                                    <div class="col">
                                        <p style="margin-bottom: 9px;"> {{ $service_type["name_" . Lang::locale()] }} </p>
                                    </div>
                                </label>
                            </div>
                            @endforeach

                            <div class="d-flex mb-3 mb-lg-4" style="margin-top: 45px;">
                                <button style="min-width: 300px;" id="write_text_button" type="button" class="btn btn-primary btn-lg" onclick="toggle_blocks()">{{Lang::get("Write request")}}</button>
                            </div>
                        </div>
                        {{-- First page END --}}
                        {{-- Second page --}}
                        <div id="second_block">
                            <div class="row">
                                <div class="col-6">
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div class="form-outline flex-fill mb-0 w-100 mx-303">
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
                                        <div class="form-outline flex-fill mb-0 w-100 mx-303 ml-43">
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
                                <p style="color: red; font-size: 14px; max-width: 610px;">{{ Lang::get("Your question regarding") }}:<span style="color: #777777;">
                                        <span id="service_type_text" style="font-weight: 700;"></span>
                                    </span>
                                </p>
                            </div>
                            <div style="max-width: 642px;" class="form-group">
                                <label for="ask_title">{{ Lang::get('Message subject') }}</label>
                                <input type="text" class="form-control myInput" id="ask_title" name="title" required>
                            </div>
                            <div style="max-width: 642px;" class="form-group">
                                <label for="ask_initial_message">{{ Lang::get('Detailed description of your request') }}</label>
                                <textarea class="form-control myInput" id="ask_initial_message" name="initial_message" rows="6" required></textarea>
                            </div>

                            {{-- File upload --}}
                            <label for="ask-file-input" class="" style="cursor: pointer;"><img src="{{ asset('/images/pin.png') }}" alt=""> <span style="color: #76AFE4; font-size: 18px;">Прикрепить файл</span></label>
                            <input
                                name='ask_images[]'
                                accept="image/png, image/jpeg, image/webp, application/pdf, application/vnd.ms-excel, application/msword, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                style="display: none;"
                                class="form-control "
                                type='file'
                                data-classButton="btn btn-primary"
                                id="ask-file-input"
                                data-input="false"
                                multiple
                            />
                            {{-- File upload END --}}

                            <div id="images-preview"></div>
                            <div id="documents-preview"></div>

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
        selected_service_type = $('input[name="service_types_id"]:checked').parent('div').parent('label').text();
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
                reader.fileName = files[i].name
                reader.onload = function (e) {
                    let mimeType = e.target.result.split(";")[0].substring(5);
                    let type = mimeType.split("/")[0];
                    let extension = mimeType.split("/")[1];
                    console.log(e.target.fileName)
                    if (type == 'image'){
                        jQuery('<img>', {
                            id: 'image-' + i,
                            class: 'uploading-files col-sm',
                        }).appendTo('#images-preview');
                        $('#image-' + i).attr('src', e.target.result);
                    }else{
                        $('#documents-preview').append("<p><svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' fill='currentColor' class='bi bi-file-earmark-text-fill' viewBox='0 0 16 16'> <path d='M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM4.5 9a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 1 0-1h4a.5.5 0 0 1 0 1h-4z'/></svg>" + e.target.fileName + "</p>")
                    }
                }
                reader.readAsDataURL(files[i]);
            }
        }
    }
    $("#ask-file-input").change(function(){
        if(this.files.length>5){
            alert('Too many files')
            $('#ask-file-input').val('');
        }
        else{
            readURL(this);
        }
    });
</script>
@stop
