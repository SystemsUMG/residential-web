<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logos/logo-residential.png') }}"/>
    <link href="{{ asset('css/styles.min.css') }}" rel="stylesheet">
    @livewireStyles
</head>

<body>
<nav class="navbar navbar-expand-lg bg-transparent fixed-top">
    <div class="col-12 text-end pe-5 text-dark-emphasis">
        <i class="ti ti-sun-high ti-moon fs-6" id="themeButton"></i>
    </div>
</nav>
<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6"
     data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div
        class="position-relative overflow-hidden bg-secondary-subtle min-vh-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
                <div class="col-md-8 col-lg-6 col-xxl-3">
                    <div class="card mb-0">
                        <div class="card-body">
                            <a href="#" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                <img src="{{ asset('images/logos/logo-residential.png') }}" width="180" alt="">
                            </a>
                            <p class="text-center text-dark-emphasis">"Tu Hogar, tu control, ¡simplifica y domina!"</p>
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-toast/>

<script src="{{ asset('js/theme.js') }}"></script>
<script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
@livewireScripts
@stack('scripts')
</body>
</html>
