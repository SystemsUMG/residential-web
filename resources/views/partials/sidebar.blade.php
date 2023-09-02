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

                <li class="nav-small-cap text-dark-emphasis">
                    <span class="hide-menu">Gestión de usuarios</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ $colorText }}" href="{{ route('users') }}" aria-expanded="false">
                        <span><i class="ti ti-users"></i></span>
                        <span class="hide-menu">Usuarios</span>
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
                <li class="sidebar-item">
                    <a class="sidebar-link {{ $colorText }}" href="{{ route('penalties.categories') }}" aria-expanded="false">
                        <span><i class="ti ti-category-2"></i></span>
                        <span class="hide-menu">Categorías de multas</span>
                    </a>
                </li>

                {{-- Tickets --}}
                <li class="nav-small-cap text-dark-emphasis">
                    <span class="hide-menu">Tickets</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ $colorText }}" href="{{ route('tickets') }}" aria-expanded="false">
                        <span><i class="ti ti-ticket"></i></span>
                        <span class="hide-menu">Tickets</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ $colorText }}" href="{{ route('tickets.categories') }}" aria-expanded="false">
                        <span><i class="ti ti-ticket-off"></i></span>
                        <span class="hide-menu">Categorías de tickets</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->
