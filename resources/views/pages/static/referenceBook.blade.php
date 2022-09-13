@extends('layouts.default')
@section('content')
<body>
    <div class="container">
        <div class="main-banner">
            <h3>{{ Lang::get('Frequently sked questions') }}</h3>
            <div id="accordion">
                @foreach ($references as $reference)
                    <div class="card">
                        <div class="card-header" id="heading{{$reference->id}}">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse{{$reference->id}}" aria-expanded="true" aria-controls="collapse{{$reference->id}}">
                                    {{$reference['question_'.Lang::locale()]}}
                                </button>
                            </h5>
                        </div>
                        <div id="collapse{{$reference->id}}" class="collapse" aria-labelledby="heading{{$reference->id}}" data-parent="#accordion">
                            <div class="card-body">
                                {{$reference['answer_'.Lang::locale()]}}
                            </div>
                            @if ($reference->link)
                                <div class="card-body">
                                    <a href="{{$reference->link}}">{{ Lang::get('Link') }}</a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
@stop