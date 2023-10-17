<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('dashboard-title')</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @yield('styles')
</head>
<body>
@auth
<div id="dashboard-main">
    <div class="dashboard-menu position-relative">
        <div class="dashboard-menu-branding">
            <img src="{{ asset('img/logo/logo-color.svg') }}" alt="Acht Logo - Color SVG">
        </div>
        <div class="dashboard-menu-company">
            <div class="dashboard-menu-company--left">
                @if (!empty($company->company_logo_folder))
                    <img src="{{ asset('img/company/logo').'/'.$company->company_logo_folder }}" alt="Customer - Logo PNG" id="company_menu_logo">
                @else
                    <img src="{{ asset('img/logo/logo-color.svg' )}}" alt="Customer - Logo PNG" id="company_menu_logo">
                @endif
            </div>
            <div class="dashboard-menu-company--right">
                <p>{{ $user->name }}</p>
                <p>{{ $company->company_name }}</p>
            </div>
        </div>
        <div class="dashboard-menu-nav">
            <ul class="dashboard-menu-nav-ul">
                <li class="dashboard-menu-nav-item {{ request()->is('dashboard') ? 'active' : ''}}">
                    <span class="material-icons">dashboard</span>
                    <a href="{{ url('/dashboard') }}" class="dashboard-menu-nav-item-link">Dashboard</a>
                </li>
                @if (auth()->user()->role == 2 || auth()->user()->role == 3)
                <li class="dashboard-menu-nav-item  {{ request()->is('dashboard/overcategory') ? 'active' : '' }} {{ request()->is('dashboard/overcategory/*') ? 'active' : '' }}  ">
                    <span class="material-icons">category</span>
                    <a href="{{ route('overcategory') }}" class="dashboard-menu-nav-item-link">Top Kategorien</a>
                </li>
                <li class="dashboard-menu-nav-item  {{ request()->is('dashboard/category') ? 'active' : '' }} {{ request()->is('dashboard/category/*') ? 'active' : '' }}  ">
                    <span class="material-icons">view_list</span>
                    <a href="{{ route('category') }}" class="dashboard-menu-nav-item-link">Kategorien</a>
                </li>
                <li class="dashboard-menu-nav-item {{ request()->is('dashboard/product') ? 'active' : ''}} {{ request()->is('dashboard/product/edit/*') ? 'active' : '' }}">
                    <span class="material-icons">event_seat</span>
                    <a href="{{route('product.index')}}" class="dashboard-menu-nav-item-link">Produkte</a>
                </li>
                <li class="dashboard-menu-nav-item {{request()->is('dashboard/editor') ? 'active' : ''}}  {{ request()->is('dashboard/site/home') ? 'active' : ''}} {{ request()->is('dashboard/site/about') ? 'active' : ''}}">
                    <span class="material-icons">view_compact</span>
                    <a href="{{route('editor.index')}}" class="dashboard-menu-nav-item-link">Seiten Editor</a>
                </li>
                <li class="dashboard-menu-nav-item {{ request()->is('dashboard/apps') ? 'active' : '' }}  {{ request()->is('dashboard/apps/*') ? 'active' : '' }} ">
                    <span class="material-icons">app_registration</span>
                    <a href="{{ route('apps') }}" class="dashboard-menu-nav-item-link">Apps</a>
                </li>
                <li class="dashboard-menu-nav-item {{ request()->is('dashboard/settings') ? 'active' : '' }} {{ request()->is('dashboard/company/*') ? 'active' : '' }} {{ request()->is('dashboard/user/*') ? 'active' : '' }}">
                    <span class="material-icons">settings_applications</span>
                    <a href="{{ route('settings') }}" class="dashboard-menu-nav-item-link">Einstellungen</a>
                </li>
                @endif
                @if (auth()->user()->role == 3)
                <li class="dashboard-menu-nav-item">
                    <span class="material-icons">admin_panel_settings</span>
                    <a href="#" class="dashboard-menu-nav-item-link">Admin</a>
                </li>
                @endif
            </ul>
        </div>
        <div class="dashboard-menu-logout">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="dashboard-menu-logout-btn">
                    <span class="material-icons">login</span>
                </button>
            </form>
        </div>
    </div>
    <div class="dashboard-content">
        <div class="dashboard-content-heading">
            <div class="dashboard-content-heading-searchbox">
                <span class="material-icons">search</span>
                <input type="text" placeholder="Search..." class="form-control d-block form-search-dashboard">
            </div>
            <div class="dashboard-content-heading-customer">
                <div class="dashboard-content-heading-customer-avater">
                    @if(!empty($user->user_avater_folder))
                        <img src="{{ asset('img/customer/avatar/'.$user->user_avater_folder) }}" alt="Customer {{ $company->owner }} - Avatar" id="customer_avater_menu">
                    @else
                        <img src="{{ asset('img/logo/logo-color.svg') }}" alt="Customer {{ $company->owner }} - Avatar" id="customer_avater_menu">
                    @endif
                </div>
                <div class="customer-dropdown" id="heading-dropdown">
                    <span class="material-icons">arrow_drop_down</span>
                    <ul class="customer-dropdown-items">
                        <li class="customer-dropdown-items-list">
                            <span class="material-icons">manage_accounts</span>
                            <a href="{{route('user_settings', ['id' => $id])}}" class="customer-dropdown-items-list-link">Einstellungen</a>
                        </li>
                        <li class="customer-dropdown-items-list">
                            <span class="material-icons">lock</span>
                            <a href="#" class="customer-dropdown-items-list-link">Privacy</a>
                        </li>
                        <li class="customer-dropdown-items-list">
                            <span class="material-icons">logout</span>
                            <form action="{{route('logout')}}" method="post">
                                @csrf
                                <button type="submit" class="customer-dropdown-items-list-link btn-transparent">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="dashboard-content-body position-relative">
            <div class="dashboard-content-body-heading">
                <h1>@yield('dashboard-body-title')</h1>
                <p>@yield('dashboard-body-desc')</p>
            </div>
            <div class="dashboard-content-body-inner">
@if(session('error'))
<div class="notification-area">
    <div class="notification noti-error mb-3">
        <div class="noti-left">
            <span class="material-icons">error</span>
        </div>
        <div class="noti-right">
            <div class="noti-right-top">
                <span>Fehler!</span>
            </div>
            <div class="noti-right-bottom">
                {{session('error')}}
            </div>
        </div>
    </div>
</div>
@endif
@if(session('success'))
<div class="notification-area">
    <div class="notification noti-success mb-3">
        <div class="noti-left">
            <span class="material-icons">check_circle</span>
        </div>
        <div class="noti-right">
            <div class="noti-right-top">
                <span>Erfolg!</span>
            </div>
            <div class="noti-right-bottom">
                {{ session('success') }}
            </div>
        </div>
    </div>
</div>
@endif

    @if(isset($success))
        <div class="notification-area">
            <div class="notification noti-success mb-3">
                <div class="noti-left">
                    <span class="material-icons">check_circle</span>
                </div>
                <div class="noti-right">
                    <div class="noti-right-top">
                        <span>Erfolg!</span>
                    </div>
                    <div class="noti-right-bottom">
                        {{ $success }}
                    </div>
                </div>
            </div>
        </div>
    @endif


@if(session('info'))
<div class="notification-area">
    <div class="notification noti-update mb-3">
        <div class="noti-left">
            <span class="material-icons">tips_and_updates</span>
        </div>
        <div class="noti-right">
            <div class="noti-right-top">
                <span>Info !</span>
            </div>
            <div class="noti-right-bottom">
                {{ session('info') }}
            </div>
        </div>
    </div>
</div>
@endif
                @yield('dashboard-content')
            </div>
        </div>
        <div class="dashboard-content-footer">

        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>
<script src="{{ asset('js/plugins/jqueryui.js') }}"></script>
@yield('script')
@endauth
</body>
</html>
