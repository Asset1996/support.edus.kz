@include('modals.login-modal')
@include('modals.register-modal')
@include('modals.reset-password-modal')

<div class="container">
  <div class="header-content">
    <nav class="navbar navbar-expand-lg navbar-light">
      <a class="navbar-brand" href="{{ route('home') }}">
        <img style="width: 110px;" src="{{ asset('images/logo.png') }}" alt="">
        <span class="logo-text">{{ Lang::get('Technical support') }}</span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Переключатель навигации">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse mt-2" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          @if (auth()->check())
          <li class="nav-item">
            <a class="nav-link" href="{{ route('tickets-list') }}">{{ Lang::get('My appeals') }}</a>
          </li>
          @endif
          <li class="nav-item active">
            <a class="nav-link link-color" href="#">
              <img style="width: 30px; height: 30px;" src="{{ asset('images/telegram.png') }}" alt="">
              <span>{{ Lang::get('Telegram bot') }}</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('ask-question') }}" class="nav-link btn pdBtn text-white">{{ Lang::get('Write to support') }}</a>
          </li>
        </ul>
        <div class="header-button ml-10">
          @if (Lang::locale() == 'ru')
            <a style="padding: 8px 10px;" href="{{ URL::toRoute($cur = Route::current(), ['lang' => 'kk'] + $cur->parameters(), true) }}" class="btn btColor text-white">KAZ</a>
          @elseif(Lang::locale() == 'kk')
            <a style="padding: 8px 10px;" href="{{ URL::toRoute($cur = Route::current(), ['lang' => 'ru'] + $cur->parameters(), true) }}" class="btn btColor text-white">RUS</a>
          @endif
        </div>
        @if (auth()->check())
        <div class="header-button ml-10">
          <form class="form-inline" method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="auth-action-button" type="submit">{{ Lang::get('Logout') }}</button>
          </form>
        </div>
        <div class="header-button person ml-10">
          <a href="{{ route('profile') }}">
            <img style="width: 49px;" src="{{ asset('images/ava.svg') }}" alt="">
          </a>
        </div>
        @else


        <div class="header-button">
          <button type="button" class="auth-action-button" data-toggle="modal" data-target="#loginModal">
            {{Lang::get("Login")}}
          </button>
        </div>

        <div class="header-button">
          <button type="button" class="auth-action-button" data-toggle="modal" data-target="#registerModal">
            {{Lang::get("Register")}}
          </button>
        </div>
        @endif
      </div>
    </nav>
  </div>
</div>