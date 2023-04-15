<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

@include('layout.partials.head')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>
@include('SuperAdmin.css.custom-css')
</head>
<body>

<div class="container-fluid sticky-top header shadow">
    <div class="row collapse show no-gutters d-flex h-100 position-relative">
        <div class="col-3 px-0 w-sidebar navbar-collapse collapse d-none d-md-flex">
            <!-- spacer col -->
            <a href="#" class="navbar-brand">My Schools</a>
        </div>
        <div class="col px-3 px-md-0 py-3">
            <div class="d-flex justify-content-between">
                <!-- toggler -->
                <div class="dsse">
                    <a data-toggle="collapse" href="#" data-target=".collapse" role="button" class="">
                        <i class="fa fa-bars fa-lg"></i>
                    </a>
                </div>
                <div class="d-flex header-info-icons">
                    <a href="#" class="ml-auto text-white"><i class="fa fa-cog"></i></a>
                    <a href="#" class="ml-auto text-white"><i class="fa fa-cog"></i></a>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown"></li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('subdomain.logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('subdomain.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid px-0">
    <div class="row vh-100 collapse show no-gutters d-flex h-100 position-relative align-items-start">
        <div class="col-3 p-0 min-vh-100 text-white w-sidebar navbar-collapse collapse d-none d-md-flex sidebar">
            <!-- fixed sidebar -->
            <div class="navbar-dark  position-fixed h-100 w-sidebar sidebar">
                <ul class="nav flex-column flex-nowrap text-truncate pt-3">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('superadmin.dashboard.index') ? 'active' : '' }}" href="{{ route('superadmin.dashboard.index') }}"><i class="fa fa-signal" aria-hidden="true"></i> Dashboard</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('superadmin.school.*') ? 'active' : '' }}">
                        <a class="nav-link" href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle "><i class="fa fa-university" aria-hidden="true"></i> School<i class="fa fa-angle-down float-right" aria-hidden="true"></i></a>
                        <ul class="nav-item collapse list-unstyled  {{ request()->routeIs('superadmin.school.*') ? 'show' : '' }}" id="homeSubmenu">
                            <li class="{{ request()->routeIs('superadmin.school.list') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('superadmin.school.list') }}">List</a>
                            </li>
                            <li class="{{ request()->routeIs('superadmin.school.create') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('superadmin.school.create') }}">Create</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item {{ request()->routeIs('superadmin.subdomain.*') ? 'active' : '' }}">
                        <a class="nav-link" href="#envsubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle "><i class="fa fa-university" aria-hidden="true"></i> ENV<i class="fa fa-angle-down float-right" aria-hidden="true"></i></a>
                        <ul class="nav-item collapse list-unstyled  {{ request()->routeIs('superadmin.subdomain.*') ? 'show' : '' }}" id="envsubmenu">
                            <li class="{{ request()->routeIs('superadmin.subdomain.list') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('superadmin.subdomain.list') }}">List Subdomains</a>
                            </li>
                            <li class="{{ request()->routeIs('superadmin.subdomain.add') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('superadmin.subdomain.add') }}">Add Subdomains</a>
                            </li>
                            <li class="{{ request()->routeIs('superadmin.subdomain.get.env') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('superadmin.subdomain.get.env') }}">Check ENV</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item {{ request()->routeIs('superadmin.modules.*') ? 'active' : '' }}">
                        <a class="nav-link" href="#module" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle "><i class="fa fa-list" aria-hidden="true"></i> Modules<i class="fa fa-angle-down float-right" aria-hidden="true"></i></a>
                        <ul class="nav-item collapse list-unstyled  {{ request()->routeIs('superadmin.modules.*') ? 'show' : '' }}" id="module">
                            <li class="{{ request()->routeIs('superadmin.modules.list') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('superadmin.modules.list') }}">List</a>
                            </li>
                            <li class="{{ request()->routeIs('superadmin.modules.add') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('superadmin.modules.add') }}">Create</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-bullhorn" aria-hidden="true"></i> Subscriptions</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col p-3 overflow-auto h-100 content-main-outer mr-2">
            <div class=""><a class="nav-link"href="{{ url()->previous() }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a></div>
            @yield('content')
        </div>
    </div>
</div>

@include('layout.partials.footer-scripts')
</body>
</html>
