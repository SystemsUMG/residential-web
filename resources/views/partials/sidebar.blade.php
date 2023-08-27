@php
    $colorText = auth()->user()->theme === 'dark' ? 'text-light' : '';
@endphp

<!-- Sidebar Start -->
<aside class="left-sidebar border-end border-light-subtle bg-body">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ route('home') }}" class="text-nowrap logo-img">
                <img src="{{ asset('images/logos/dark-logo.svg') }}" width="180" alt=""/>
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap text-dark-emphasis">
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ $colorText }}" href="{{ route('home') }}" aria-expanded="false">
                        <span><i class="ti ti-layout-dashboard"></i></span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                {{-- Penalties --}}
                <li class="nav-small-cap text-dark-emphasis">
                    <span class="hide-menu">Penalizaciones</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ $colorText }}" href="{{ route('penalties') }}" aria-expanded="false">
                        <span><i class="ti ti-receipt-2"></i></span>
                        <span class="hide-menu">Multas</span>
                    </a>
                </li>

                {{-- Tickets --}}
                <li class="nav-small-cap text-dark-emphasis">
                    <span class="hide-menu">Tickets</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ $colorText }}" href="{{ route('tickets') }}" aria-expanded="false">
                        <span><i class="ti ti-receipt-2"></i></span>
                        <span class="hide-menu">Tickets</span>
                    </a>
                </li>

                <li class="nav-small-cap text-dark-emphasis">
                    <span class="hide-menu">UI COMPONENTS</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ $colorText }}" href="{{ route('buttons') }}" aria-expanded="false">
                        <span><i class="ti ti-article"></i></span>
                        <span class="hide-menu">Buttons</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ $colorText }}" href="{{ route('alerts') }}" aria-expanded="false">
                        <span><i class="ti ti-alert-circle"></i></span>
                        <span class="hide-menu">Alerts</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ $colorText }}" href="{{ route('cards') }}" aria-expanded="false">
                        <span><i class="ti ti-cards"></i></span>
                        <span class="hide-menu">Card</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ $colorText }}" href="{{ route('forms') }}" aria-expanded="false">
                        <span><i class="ti ti-file-description"></i></span>
                        <span class="hide-menu">Forms</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ $colorText }}" href="{{ route('fonts') }}" aria-expanded="false">
                        <span><i class="ti ti-typography"></i></span>
                        <span class="hide-menu">Typography</span>
                    </a>
                </li>
                <li class="nav-small-cap text-dark-emphasis">
                    <span class="hide-menu">AUTH</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ $colorText }}" href="{{ route('login') }}" aria-expanded="false">
                        <span><i class="ti ti-login"></i></span>
                        <span class="hide-menu">Login</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ $colorText }}" href="{{ route('register') }}" aria-expanded="false">
                        <span><i class="ti ti-user-plus"></i></span>
                        <span class="hide-menu">Register</span>
                    </a>
                </li>
                <li class="nav-small-cap text-dark-emphasis">
                    <span class="hide-menu">EXTRA</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ $colorText }}" href="{{ route('icons') }}" aria-expanded="false">
                        <span><i class="ti ti-mood-happy"></i></span>
                        <span class="hide-menu">Icons</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ $colorText }}" href="{{ route('sample') }}" aria-expanded="false">
                        <span><i class="ti ti-aperture"></i></span>
                        <span class="hide-menu">Sample Page</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->
