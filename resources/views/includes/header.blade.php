  @include('modals.login-modal')
  @include('modals.register-modal')
  @include('modals.reset-password-modal')
  
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- ***** Logo Start ***** -->
      <a class="navbar-brand" href="{{ route('home') }}"><svg width="105" height="25" viewBox="0 0 105 25" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <rect width="105" height="25" fill="url(#pattern0)"></rect>
        <defs>
        <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
        <use xlink:href="#image0" transform="scale(0.008 0.0357143)"></use>
        </pattern>
        <image id="image0" width="105" height="25" xlink:href="data:image/png;base64,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"></image>
        </defs>
        </svg>
      </a>
    <!-- ***** Logo End ***** -->
    <!-- ***** Navbar toggler start ***** -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    <!-- ***** Navbar toggler end ***** -->

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <!-- ***** Home button start ***** -->
          <li class="nav-item active">
            <a class="nav-link" href="{{ route('home') }}">{{ Lang::get('Home') }} <span class="sr-only">(current)</span></a>
          </li>
        <!-- ***** Home button end ***** -->
        @if (auth()->check())
        <li class="nav-item">
          <a class="nav-link" href="{{ route('tickets-list') }}">{{ Lang::get('My appeals') }}</a>
        </li>
        @endif
      </ul>
      <div class="header-button">
        <a href="{{ route('ask-question') }}" class="btn btn-primary">{{Lang::get("Ask question")}}</a>
      </div>
      <div class="header-button">
        @if (Lang::locale() == 'ru')
          <a href="{{ URL::toRoute($cur = Route::current(), ['lang' => 'kk'] + $cur->parameters(), true) }}" class="btn btn-primary">KAZ</a>
        @elseif(Lang::locale() == 'kk')
        <a href="{{ URL::toRoute($cur = Route::current(), ['lang' => 'ru'] + $cur->parameters(), true) }}" class="btn btn-primary">RUS</a>
        @endif
      </div>
      @if (auth()->check())
        <div class="header-button">
          <form class="form-inline" method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="auth-action-button" type="submit">{{ Lang::get('Logout') }}</button>
          </form>
        </div>
        <div class="header-button person">
          <a href="{{ route('profile') }}">
            <p>
              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
              </svg>
            </p>
            <p style="font-size: 14px">{{ auth()->user()->name }}</p>
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
