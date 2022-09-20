@extends('layouts.default')

@section('content')
<!-- <body>
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
                  <img src="{{ asset('images/banner-right-image.png') }}" alt="" style="width: 100%">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body> -->





<div class="main">
  <div class="container-fluid">
    <div class="bg">
      <div class="main_content">
        <div class="main_items">
          <div class="row">
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12" style="padding-right: 0;">
              <div style="width: 335px;" class="main_item main_right">
                <div class="main_item_text">
                  <h1>Пишите <br> в техподдержку</h1>
                  <p>Справочная система по работе систем и модулей платформы EDUS - пишите свои вопросы и получайте на них ответы от специалистов техподдержки</p>
                  <a href="#">Перейти <span class="fArrow"><img src="/images/firstArrow.svg"></span></a>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
              <div style="width: 335px;" class="main_item main_left">
                <div class="main_item_text">
                  <h1>Найдите в справочнике</h1>
                  <p>Удобный поиск и справочная база помогут вам быстро найти нужные ответы на ваши проблемы и вопросы. Вам не нужно ожидать ответа поддержки.</p>
                  <a href="#">Перейти <span class="fArrow"><img src="/images/firstArrow.svg"></span></a>
                </div>
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
              <img style="width: 64px;" src="/images/telegram.png" alt="">
              <span style="color: #278DEB; font-size: 20px; margin-left: 16px;">@edus_support_bot</span>
            </a>
          </div>
        </div>
        <div style="padding-left: 8px;" class="col-lg-5">
          <div class="support_bot_item support_bot_item_right">
            <p class="">Мы запустили поддержку в Телеграм, где вы
              можете получить <a style="border-bottom: 1px solid #278DEB;" href="">ответы в режиме онлайн</a></p>
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
        <h1 class="anonse-title">Анонсы и сообщения</h1>
        <img style="width: 40px; margin-left: 20px;" src="/public/images/newArrow.svg" alt="">
      </div>
      <div class="anonse-items mt-3">
        <div class="row">


          <div class="col-lg-4">
            <div class="anonse-item mt-3">
              <a class="e-school" href="#">
                <p class="e-school">Электронная школа</p>
                <p class="e-text text-dark">Добравлена видео-инструкция
                  по правильному заполнению
                  электронного журнала</p>
                <span class="anonse-data text-muted">24 февраля 2022</span>
                <img style="width: 40px;" src="/public/images/newArrow.svg" alt="">
              </a>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="anonse-item mt-3">
              <a class="e-school" href="#">
                <p class="e-school">Электронная школа</p>
                <p class="e-text text-dark">Добравлена видео-инструкция
                  по правильному заполнению
                  электронного журнала</p>
                <span class="anonse-data text-muted">24 февраля 2022</span>
                <img style="width: 40px;" src="/public/images/newArrow.svg" alt="">
              </a>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="anonse-item mt-3">
              <a class="e-school" href="#">
                <p class="e-school">Электронная школа</p>
                <p class="e-text text-dark">Добравлена видео-инструкция
                  по правильному заполнению
                  электронного журнала</p>
                <span class="anonse-data text-muted">24 февраля 2022</span>
                <img style="width: 40px;" src="/public/images/newArrow.svg" alt="">
              </a>
            </div>
          </div>

        </div>

      </div>

    </div>

  </div>
</section>



<section class="social mt-5" style="margin-bottom: 650px;">
  <div class="container-fluid">
    <div class="social-items">
      <div class="row align-items-center">
        <div class="col-lg-4">
          <div style="width: 90%;" class="social-item"><img class="social-img" src="/images/call-girl.png" alt=""></div>
        </div>

        <div class="col-lg-4">
          <div class="social-item">
            <img class="social-img-you" src="/images/you.svg" alt="">
            <p class="social-text">Мы создали канал со
              множеством видео-
              инструкций и ответов на
              частые вопросы</p>
            <p class=" social-text2">Видео-инструкции на
              канале <a href="https://www.youtube.com/">Ютуб</a></p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="social-item">
            <img class="social-img-tel" src="/images/tele2.svg" alt="">
            <span style="font-size: 32px; font-weight: 400; margin-top: 10px; color: #000000;">Telegram</span>
            <p class="social-text">Мгновенные ответы на
              множество вопросов можно
              получить с помощью
              телеграм-бота</p>
            <p class="social-text2">Подписывайтесь на
              <a href="www.youtube.com">Телеграм-канал</a>
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
      <h3 class="anonse-title">Динамика обращений</h3>
      <div class="counter-lists mt-3">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="counter-item">
              <h4 class="counter-num">2919</h4>
              <p class="counter-text">Запросы за 30
                дней</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="counter-item ">
              <h4 class="counter-num">343</h4>
              <p class="counter-text">Запросы за
                неделю
              </p>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="counter-item">
              <h4 class="counter-num" style="color: #FFB800;">83%</h4>
              <p class=" counter-text">отвеченных вопросов</p>
            </div>
          </div>
        </div>

      </div>
      <div class="last_center">
        <p class="last-text text-muted">Справочная система по работе систем и модулей платформы EDUS - пишите свои вопросы и
          получайте на них ответы от специалистов техподдержки</p>
      </div>
    </div>
  </div>
</section>



@stop