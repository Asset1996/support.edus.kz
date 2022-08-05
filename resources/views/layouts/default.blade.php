<!doctype html>
<html>
    <head>
        @include('includes.head')
    </head>
    <body>
        <header>
            @include('includes.header')
        </header>
        <div class="container">
            <div class="flash-messages">
                @if (Session::has('error_message'))
                    <div class="alert alert-danger" role="alert">{{ Session::get('error_message') }}</div>
                @endif
                @if (Session::has('success_message'))
                    <div class="alert alert-success" role="alert">{{ Session::get('success_message') }}</div>
                @endif
                @if (Session::has('info_message'))
                    <div class="alert alert-info" role="alert">{{ Session::get('info_message') }}</div>
                @endif
            </div>
            <div class="content-page">
                @yield('content')
            </div>
            <footer class="row">
                @include('includes.footer')
            </footer>
        </div>
    </body>
</html>