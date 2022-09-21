@if (!auth()->check())
  @include('modals.login-modal')
  @include('modals.register-modal')
  @include('modals.reset-password-modal')
@endif
<div class="container-fluid">
    <nav class="navbar navbar-expand-lg">
      <a class="navbar-brand logo" href="{{ route('home') }}">
        <img style="width: 90px;" src="{{ asset('images/logo.svg') }}" alt="">
        <span>{{ Lang::get('Technical support') }}</span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Переключатель навигации">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link link-color" href="#">
              <img style="width: 30px; height: 30px;" src="{{ asset('images/telegram.png') }}" alt="">
              <span>{{ Lang::get('Telegram bot') }}</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('create-ticket') }}" class="nav-link btn pdBtn text-white">{{ Lang::get('Write to support') }}</a>
          </li>

{{--        <div class="header-button ml-10">--}}
{{--          @if (Lang::locale() == 'ru')--}}
{{--            <a style="padding: 8px 10px;" href="{{ URL::toRoute($cur = Route::current(), ['lang' => 'kk'] + $cur->parameters(), true) }}" class="btn btColor text-white">KAZ</a>--}}
{{--          @elseif(Lang::locale() == 'kk')--}}
{{--            <a style="padding: 8px 10px;" href="{{ URL::toRoute($cur = Route::current(), ['lang' => 'ru'] + $cur->parameters(), true) }}" class="btn btColor text-white">RUS</a>--}}
{{--          @endif--}}
{{--        </div>--}}
        <li class="nav-item">
        @if (auth()->check())
            <div class="dropdown">
                  <button style="background: transparent;" class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <img style="width: 49px;" src="{{ asset('images/ava.svg') }}" alt="">
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="{{ route('profile') }}">{{ Lang::get('Profile') }}</a>
                      <a class="dropdown-item" href="{{ route('tickets-list') }}">{{ Lang::get('My appeals') }}</a>
                      <a class="dropdown-item" href="#">
                          <form class="form-inline" method="POST" action="{{ route('logout') }}">
                              @csrf
                              <button class="auth-action-button" type="submit">{{ Lang::get('Logout') }}</button>
                          </form>
                      </a>
                  </div>
            </div>
        @else
        <div class="header-button">
          <button type="button" class="auth-action-button" data-toggle="modal" data-target="#loginModal">
            {{Lang::get("Login")}}
          </button>
        </div>
        @endif
        </li>
        </ul>
      </div>
    </nav>
</div>
