<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name') }}</title>
    
    <!-- Bootstrap css-->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"/>

    <link href="{{ asset('vendor/dashboard/css/style.css') }}" rel="stylesheet"/>
    <link href="{{ asset('vendor/dashboard/css/components.css') }}" rel="stylesheet"/>

    <!-- SweetAlert css-->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">

    <!-- FontAwesome css-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    @stack('style')
</head>
<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
                @include('include.navbar')
                @include('include.sidebar')
            
                <!-- Main Content -->
                <div class="main-content">
                    @yield('content')
                </div>
                
                @include('include.footer')
        </div>
    </div>

    <!-- Jquery js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <!-- Custom js -->
    <script src="{{ asset('vendor/dashboard/js/stisla.js') }}"></script>
    <script src="{{ asset('vendor/dashboard/js/scripts.js') }}"></script>
    <script src="{{ asset('vendor/dashboard/js/custom.js') }}"></script>

    <script>
        $(function(){
            @if(Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: '<?= session("success") ?>'
                })
            @endif

            @if(Session::has('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '<?= session("error") ?>'
                })
            @endif

                @if(Session::has('warning'))
                Swal.fire({
                    icon: 'warning',
                    title: 'Maaf!',
                    text: '<?= session("warning") ?>'
                })
            @endif

            @if(Session::has('info'))
                Swal.fire({
                    icon: 'info',
                    title: 'Hi!',
                    text: '<?= session("info") ?>'
                })
            @endif
        });
    </script>

    @stack('script')
</body>
</html>