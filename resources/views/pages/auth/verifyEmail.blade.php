@extends('layouts.default')

@section('content')
    <body>
        <div class="main-banner">
            <section class="vh-100" style="background-color: white;">
                <div class="container h-100">
                    @if (Session::has('error_message'))
                        <div class="alert">{{ Session::get('error_message') }}</div>
                    @endif
                    @if (Session::has('success_message'))
                        <div class="alert">{{ Session::get('success_message') }}</div>
                    @endif
                </div>
            </section>
        </div>
    </body>
@stop