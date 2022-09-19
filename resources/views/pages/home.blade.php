@extends('layouts.default')
@section('content')
    <div class="main">
        <div class="container-fluid">
            <div class="main_content">
                <div class="main_items">
                    <div class="row">
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12" style="padding-right: 0;">
                            <div style="width: 335px;" class="main_item main_right">
                                <div class="main_item_text">
                                    <h1>{{ Lang::get('Write to tech support') }}</h1>
                                    <p>{{ Lang::get('Help system for the operation of systems and modules of the EDUS platform - write your questions and get answers from technical support specialists.') }}</p>
                                    <a href="{{ route('create-ticket') }}">{{ Lang::get('Go') }} <span class="fArrow"><img src="{{ asset('images/firstArrow.svg') }}"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                            <div style="width: 335px;" class="main_item main_left">
                                <div class="main_item_text">
                                    <h1>{{ Lang::get('Find in directory') }}</h1>
                                    <p>{{ Lang::get('Convenient search and reference base will help you quickly find the right answers to your problems and questions. You do not need to wait for a support response.') }}</p>
                                    <a href="{{ route('reference-book') }}">{{ Lang::get('Go') }} <span class="fArrow"><img src="{{ asset('images/firstArrow.svg') }}"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="support_bot" style="margin-top: 66px;">
        <div class="container-fluid">
            <div class="support_bot_items">
                <div class="row">
                    <div style="padding-right: 0;" class="col-lg-3">
                        <div class="support_bot_item">
                            <a target="_blank" href="">
                                <img style="width: 64px;" src="{{ asset('images/telegram.png') }}" alt="">
                                <span style="color: #278DEB; font-size: 20px; margin-left: 16px;">@edus_support_bot</span>
                            </a>
                        </div>
                    </div>
                    <div style="padding-left: 8px;" class="col-lg-5">
                        <div class="support_bot_item support_bot_item_right">
                            <p class="">{{ Lang::get('We launched support in Telegram, where you can get') }} <a style="border-bottom: 1px solid #278DEB;" href="">{{ Lang::get('online answers') }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="anonse" style="margin-top: 115px;">
        <div class="container-fluid">
            <div class="anon">
                <div class="anonse-header">
                    <h1 class="anonse-title">{{ Lang::get('Announcements and messages') }}</h1>
                    <img style="width: 40px; margin-left: 20px;" src="{{ asset('images/newArrow.svg') }}" alt="">
                </div>
                <div class="anonse-items mt-3">
                    <div class="row">
                        @foreach ($announcements as $announcement)
                            <div class="col-lg-4">
                                <div class="anonse-item mt-3">
                                    <a class="e-school" href="{{ $announcement->link }}">
                                        <p class="e-school">{{ $announcement['theme_'.Lang::locale()] }}</p>
                                        <p class="e-text text-dark">{{ $announcement['message_'.Lang::locale()] }}</p>
                                        <span class="anonse-data text-muted">{{ $announcement->date }}</span>
                                        <img style="width: 40px;" src="{{ asset('images/newArrow.svg') }}" alt="">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="social mt-5" >
        <div class="container-fluid">
            <div class="social-items">
                <div class="row align-items-center">
                    <div class="col-lg-4">
                        <div style="width: 90%;" class="social-item"><img class="social-img" src="{{ asset('images/call-girl.png') }}" alt=""></div>
                    </div>
                    <div class="col-lg-4">
                        <div class="social-item">
                            <img class="social-img-you" src="{{ asset('images/you.svg') }}" alt="">
                            <p class="social-text">{{ Lang::get('We have created a channel with many video instructions and answers to frequently asked questions') }}</p>
                            <p class=" social-text2">{{ Lang::get('Video instructions in') }}<a href="https://www.youtube.com/c/EDUS-system/featured">{{ Lang::get('Youtube channel') }}</a></p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="social-item">
                            <img class="social-img-tel" src="{{ asset('images/telegram.png') }}" alt="">
                            <span style="font-size: 32px; font-weight: 400; margin-top: 10px; color: #000000;">Telegram</span>
                            <p class="social-text">{{ Lang::get('Instant answers to many questions can be obtained using the telegram bot') }}</p>
                            <p class="social-text2">{{ Lang::get('Subscribe on') }}
                                <a href="#">{{ Lang::get('Telegram channel') }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="counter mt-5">
        <div class="container-fluid">
            <div class="counter-main">
                <h3 class="anonse-title">{{ Lang::get('Request dynamics') }}</h3>
                <div class="counter-lists mt-3">
                    <div class="row">
                        <div class="col-lg-4 col-sm-12">
                            <div class="counter-item">
                                <h4 class="counter-num">{{ $statistics->last_30_days }}</h4>
                                <p class="counter-text">{{ Lang::get('Requests within 30 days') }}</p>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <div class="counter-item ">
                                <h4 class="counter-num">{{ $statistics->last_7_days }}</h4>
                                <p class="counter-text">{{ Lang::get('Requests within a week') }}</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <div class="counter-item">
                                <h4 class="counter-num" style="color: #FFB800;">{{ $statistics->percent_of_processed }}%</h4>
                                <p class=" counter-text">{{ Lang::get('questions answered') }}</p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="last_center">
                    <p class="last-text text-muted">{{ Lang::get('Help system for the operation of systems and modules of the EDUS platform - write your questions and get answers from technical support specialists') }}</p>
                </div>
            </div>
        </div>
    </section>
@stop
