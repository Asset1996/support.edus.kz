@extends('layouts.default')

@section('content')
  <body>
    <div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
              <div class="col-lg-6 align-self-center">
                <div>
                  <div class="row">
                    <div class="col-lg-12">
                      <h2>{{ Lang::get('Online technical support service') }}</h2>
                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div>
                  <img src="{{ asset('images/banner-right-image.png') }}" alt="" style="width:100%">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
@stop
