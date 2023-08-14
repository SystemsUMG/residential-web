<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="{{ auth()->user()->theme }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logos/favicon.png') }}"/>
    <link href="{{ asset('css/styles.min.css') }}" rel="stylesheet">
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
@livewireScripts
<script src="{{ asset('js/theme.js') }}"></script>
<script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/sidebarmenu.js') }}"></script>
<script src="{{ asset('js/app.min.js') }}"></script>
<script src="{{ asset('libs/apexcharts/dist/apexcharts.min.js') }}"></script>
<script src="{{ asset('libs/simplebar/dist/simplebar.js') }}"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
