<?php use App\Models\User; ?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="" class="brand-link">
        <img src="{{ asset('admin_assets/images/icon.png') }}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">FutWin Portal</span>
    </a>

  <div style="padding-bottom:10px; height:100vh">
    <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}"
                            class="nav-link {{ Route::currentRouteName() === 'admin.dashboard' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.users') }}"
                            class="nav-link {{ Route::currentRouteName() === 'admin.users' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.leagues.index') }}"
                            class="nav-link {{ Route::currentRouteName() === 'admin.leagues.index' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-flag-checkered"></i>
                                <p>League</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.plans.index') }}"
                            class="nav-link {{ Route::currentRouteName() === 'admin.plans.index' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-layer-group"></i>
                                <p>Plan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.teams.index') }}"
                            class="nav-link {{ Route::currentRouteName() === 'admin.teams.index' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Teams</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.predictions.index') }}"
                            class="nav-link {{ Route::currentRouteName() === 'admin.predictions.index' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>Predictions</p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview {{ in_array(Route::currentRouteName(), ['admin.profile.index', 'admin.profile.update']) ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), ['admin.profile.index', 'admin.profile.update']) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>
                                    Account Settings
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.profile.index') }}"
                                    class="nav-link {{ Route::currentRouteName() === 'admin.profile.index' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Profile Settings</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Logout</p>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                </ul>
            </nav>
        </div>
<!-- <div class="d-flex justify-content-center sidebar-scroll-to-top m-2">
         <svg xmlns="http://www.w3.org/2000/svg"  version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="20   " height="20   " x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="m270.9 437.6 166-166c13.2-13.2 3.9-35.9-14.9-35.9h-48.9c-5.6 0-10.9 2.2-14.9 6.2L256 344.1 153.8 241.9c-3.9-3.9-9.3-6.2-14.9-6.2H90c-18.7 0-28.1 22.6-14.9 35.9l166 166c8.3 8.2 21.5 8.2 29.8 0zm0-167.5 166-166c13.2-13.2 3.9-35.9-14.9-35.9h-48.9c-5.6 0-10.9 2.2-14.9 6.2L256 176.6 153.8 74.4c-3.9-4-9.3-6.2-14.9-6.2H90c-18.7 0-28.1 22.6-14.9 35.9l166 166c8.3 8.2 21.5 8.2 29.8 0z" fill="#ffffff" opacity="1" data-original="#000000" class=""></path></g></svg>

</div> -->
  </div>
</aside>
