@extends('layouts.default')
@section('title', Lang::get('Email verification'))

@section('content')
    <body>
        <div class="main-banner">
            @if (Session::has('error_message'))
                <div class="alert">{{ Session::get('error_message') }}</div>
            @endif
            @if (Session::has('success_message'))
                <div class="alert">{{ Session::get('success_message') }}</div>
            @endif
        </div>
    </body>
@stop