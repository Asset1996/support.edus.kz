<!doctype html>
<html>
    <head>
        @include('includes.head')
    </head>
    <body>
        <div class="container">
            <header class="row">
            @include('includes.header')
            </header>
            @if (Session::has('error_message'))
                <div class="alert">{{ Session::get('error_message') }}</div>
            @endif
            @if (Session::has('success_message'))
                <div class="alert">{{ Session::get('success_message') }}</div>
            @endif
            <div id="main" class="row">
                @yield('content')
            </div>
            <footer class="row">
            @include('includes.footer')
            </footer>
        </div>
    </body>
</html>