<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">

    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:image" content="@yield('og_image')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="@yield('og_site_name')">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <link rel="icon" href="" sizes="32x32" />
    <link rel="icon" href="" sizes="192x192" />
    <link rel="apple-touch-icon" href="" sizes="180x180" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- Start MDBootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    {{-- <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700&display=swap" rel="stylesheet" /> --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> --}}
    <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet" />
    <!-- End MDBootstrap -->

    <!-- Styles -->
    <link href="{{ asset('css/style1.css') }}" rel="stylesheet">

    @yield('css')
</head>

<body>
    <div id="wrapper">
        <div class="body-wrap">
            <div class="body">
                @include('templates.header')
                <div class="body-content" style="padding-bottom: 50px">
                    @yield('content')
                </div>
            </div>
        </div>


        @include('modals.modal-login')
        @include('modals.modal-register')

        @if (auth()->check())
            @include('modals.modal-akun')
        @endif

        @include('templates.menubar-footer')
    </div>

    <!-- MDB -->
    <script src="{{ asset('js/mdb.min.js') }}"></script>

    <!-- JQUERY -->
    <script src="{{ asset('js/jquery-3.6.3.min.js') }}"></script>

    {{-- Sweet Alert --}}
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>

    {{-- Custom JS --}}
    @yield('js')

    {{-- Sweet Alert JS --}}
    <script type="text/javascript">
        var storage = [];

        @if (Session::has('success'))
            swal({
                title: "Berhasil!",
                text: "{{ Session::get('success') }}",
                icon: "success",
                button: "Ok",
            });
        @endif

        @if (Session::has('error'))
            swal({
                title: "Gagal!",
                text: "{{ Session::get('error') }}",
                icon: "warning",
                button: "Ok",
            });
        @endif
    </script>

    {{-- Auth JS --}}
    @include('js.auth')

    {{-- show password --}}
    <script src="{{ asset('js/js-password.js') }}"></script>

    {{-- TinyMCE --}}
    {{-- <script src="https://cdn.tiny.cloud/1/fioab1f7iscuty6onrm6ezlq795cnlvwjy81btkvag3piuoj/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> --}}
    {{-- <script>
        tinymce.init({
            selector: 'textarea.tiny'
        });
    </script> --}}
</body>

</html>
