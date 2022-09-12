@extends('layouts.default')
@section('content')
  <div class="main">
    <div class="container">
      <section class="main_content">
        <div class="first-items">
          <div class="row">
            <div class="col-xl-4 col-lg-6 col-md-6">
              <div class="first-item mt-5">
                <div class="first-item-text-section">
                  <h1>{{ Lang::get('Write to tech support') }}</h1>
                  <p class="mb-4 text-white fs-17">{{ Lang::get('Help system for the operation of systems and modules of the EDUS platform - write your questions and get answers from technical support specialists.') }}</p>
                  <a class="myLink text-white" href="{{ route('create-ticket') }}">{{ Lang::get('Go') }} <span><img style="width: 20px; margin-left: 7px;" src="{{ asset('images/firstArrow.svg') }}" alt=""></span></a>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-xl-5 col-md-6">
              <div class="first-item leftM mt-5">
                <div class="first-item-text-section">
                  <h1>{{ Lang::get('Find in directory') }}</h1>
                  <p class="mb-4 text-white fs-17">{{ Lang::get('Convenient search and reference base will help you quickly find the right answers to your problems and questions. You do not need to wait for a support response.') }}</p>
                  <a class="myLink text-white" href="#">{{ Lang::get('Go') }} <span><img style="width: 20px; margin-left: 7px;" src="{{ asset('images/firstArrow.svg') }}" alt=""></span></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  <section class="support_bot" style="margin-top: 78px;">
    <div class="container">
      <div class="support_bot_items">
        <div class="row">
          <div class="col-lg-3">
            <div class="support_bot_item">
              <a target="_blank" href="">
                <img style="width: 60px;" src="{{ asset('images/telegram.png') }}" alt="">
                <span style="color: #278DEB; font-size: 20px;">@edus_support_bot</span>
              </a>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="support_bot_item">
              <p class="fw-600">{{ Lang::get('We launched support in Telegram, where you can get') }} <a href="">{{ Lang::get('online answers') }}</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>




  <section class="anonse" style="margin-top: 80px;">
    <div class="container">
      <div class="anon">
        <div class="anonse-header">
          <h1 class="anonse-title">{{ Lang::get('Announcements and messages') }}</h1>
          <img style="width: 40px;" src="{{ asset('images/newArrow.svg') }}" alt="">
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



  <section class="social mt-5">
    <div class="container">
      <div class="social-items">
        <div class="row align-items-center">
          <div class="col-lg-4">
            <div style="width: 90%;" class="social-item"><img class="social-img" src="{{ asset('images/call-girl.png') }}" alt=""></div>
          </div>
          <div class="col-lg-4">
            <div class="social-item">
              <img class="social-img-you" src="{{ asset('images/you.svg') }}" alt="">
              <p class="social-text">{{ Lang::get('We have created a channel with many video instructions and answers to frequently asked questions') }}</p>
              <p class="social-text2">{{ Lang::get('Video instructions in') }}<br>
                <a href="https://www.youtube.com/c/EDUS-system/featured"> {{ Lang::get('Youtube channel') }}</a></p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="social-item">
              <img class="social-img-tel" src="{{ asset('images/telegram.png') }}" alt="">
              <p class="social-text">{{ Lang::get('Instant answers to many questions can be obtained using the telegram bot') }}</p>
              <p class="social-text2">{{ Lang::get('Subscribe on') }}
                <a href="www.youtube.com">{{ Lang::get('Telegram channel') }}</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="counter mt-5">
    <div class="container">
      <div class="counter-main">
        <h3 class="anonse-title">{{ Lang::get('Request dynamics') }}</h3>
        <div class="counter-lists mt-3">
          <div class="row">
            <div class="col-lg-3 col-sm-12">
              <div class="counter-item">
                <h4 class="counter-num text-primary">{{ $statistics->last_30_days }}</h4>
                <p class="counter-text">{{ Lang::get('Requests within 30 days') }}</p>
              </div>
            </div>

            <div class="col-lg-3 col-sm-12">
              <div class="counter-item ">
                <h4 class="counter-num text-primary">{{ $statistics->last_7_days }}</h4>
                <p class="counter-text">{{ Lang::get('Requests within a week') }}</p>
              </div>
            </div>
            <div class="col-lg-3 col-sm-12">
              <div class="counter-item">
                <h4 class="counter-num text-warning">{{ $statistics->percent_of_processed }}%</h4>
                <p class="counter-text">{{ Lang::get('questions answered') }}</p>
              </div>
            </div>
          </div>
        </div>
        <p class="last-text text-muted">{{ Lang::get('Help system for the operation of systems and modules of the EDUS platform - write your questions and get answers from technical support specialists') }}</p>
      </div>
    </div>
  </section>
@stop
