@extends('layouts.app')
@section('content')

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            {{-- Side Navigation Menu --}}
            @component('components.side-navigation-menu')
                @section('side-navigation-menu')
                    {{-- Side Navigation Menu Header --}}
                    @component('components.side-navigation-menu-header')
                    @slot('title') Цэс @endslot
                    @endcomponent
            
                    {{-- Side Navigation Menu Item --}}
                    @component('components.side-navigation-menu-item')
                        @slot('name') Самбар @endslot
                        @slot('icon') fas fa-tachometer-alt @endslot
                        @slot('route_name') {{route("admin.dashboard")}} @endslot
                    @endcomponent
            
                    {{-- Side Navigation Menu Item --}}
                    @can('see-product')
                        @component('components.side-navigation-menu-item')
                            @slot('name') Бараа @endslot
                            @slot('icon') fas fa-columns @endslot
                            @slot('route_name') {{route("products")}} @endslot
                        @endcomponent
                    @endcan

                    <!-- {{-- Side Navigation Menu Item --}}
                    @can('see-baskets')
                        @component('components.side-navigation-menu-item')
                        @slot('name') Сагс @endslot
                        @slot('icon') fas fa-shopping-basket @endslot
                        @slot('route_name') {{route("baskets")}} @endslot
                        @endcomponent
                    @endcan -->

                    {{-- Side Navigation Menu Item --}}
                    @can('anything-employees')
                        @component('components.side-navigation-menu-item')
                        @slot('name') Ажилчид @endslot
                        @slot('icon') fas fa-user-friends @endslot
                        @slot('route_name') {{route("employees")}} @endslot
                        @endcomponent
                    @endcan

                    {{-- Side Navigation Menu Item --}}
                    @component('components.side-navigation-menu-item')
                        @slot('name') Захиалгууд @endslot
                        @slot('icon') fas fa-columns @endslot
                        @slot('route_name') {{route("orders")}} @endslot
                    @endcomponent
            
                    {{-- Side Navigation Menu Item --}}
                    @can('see-users')
                        @component('components.side-navigation-menu-item')
                        @slot('name') Хэрэглэгчид @endslot
                        @slot('icon') fas fa-users @endslot
                        @slot('route_name') {{route("users")}} @endslot
                        @endcomponent
                    @endcan

                    {{-- Side Navigation Menu Item --}}
                    @can('anything-address')
                        @component('components.side-navigation-menu-item')
                        @slot('name') Хаяг @endslot
                        @slot('icon') fas fa-location-arrow @endslot
                        @slot('route_name') {{route("cities")}} @endslot
                        @endcomponent
                    @endcan

                    {{-- Side Navigation Menu Item --}}
                    @can('anything-shipments')
                        @component('components.side-navigation-menu-item')
                        @slot('name') Хүргэлтийн түүх @endslot
                        @slot('icon') fas fa-truck @endslot
                        @slot('route_name') {{route("shipments")}} @endslot
                        @endcomponent
                    @endcan

                    {{-- Side Navigation Menu Item --}}
                    @can('see-reports')
                        @component('components.side-navigation-menu-item')
                        @slot('name') Хүргэлтийн тайлан @endslot
                        @slot('icon') fas fa-columns @endslot
                        @slot('route_name') {{route("report.shipment")}} @endslot
                        @endcomponent
                    @endcan
                @endsection
            @endcomponent
        </nav>
    </div>
    {{-- Side Navigation Content Header --}}
    @yield('side-navigation-content-header')
</div>

@endsection
