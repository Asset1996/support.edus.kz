<!doctype html>
<html>

<head>
    @include('includes.head')
</head>

<body>
    <div id="wrap">
        <header style="padding: 30px 0;">
            @include('includes.header')
        </header>

        <div class="flash-messages">
            @if (Session::has('error_message'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('error_message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if (Session::has('success_message'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success_message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if (Session::has('info_message'))
            <div class="alert alert-info" role="alert">{{ Session::get('info_message') }}</div>
            @endif
        </div>
        <main class="mains">
            <div class="container">
                <div class="row py-3">
                    <div class="col-3" id="sticky-sidebar">
                        @include('includes.controlPanel.sidebar')
                    </div>
                    <div class="col-9" id="main">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>

        <footer class="footer_area section_padding_130_0 mt-5">
            @include('includes.footer')
        </footer>
 </div>
</body>

</html>