<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="{{ auth()->user()->theme }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logos/favicon.png') }}"/>
    <link href="{{ asset('css/styles.min.css') }}" rel="stylesheet">
    @stack('styles')
    @livewireStyles
</head>

<body>
<!-- Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
     data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar -->
    @include('partials.sidebar')
    <!-- Main -->
    <div class="body-wrapper">
        @include('partials.navbar')
        <div class="pt-5 px-5">
            @yield('content')
            @if(isset($slot))
                <div class="mt-5">
                    {{ $slot }}
                </div>
            @endif
        </div>
        @include('partials.footer')
    </div>
</div>
<x-toast/>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
@livewireScripts
<script src="{{ asset('js/theme.js') }}"></script>
<script src="{{ asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/sidebarmenu.js') }}"></script>
<script src="{{ asset('js/app.min.js') }}"></script>
<script src="{{ asset('libs/apexcharts/dist/apexcharts.min.js') }}"></script>
<script src="{{ asset('libs/simplebar/dist/simplebar.js') }}"></script>
@stack('scripts')
</body>
</html>
