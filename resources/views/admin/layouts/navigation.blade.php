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
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
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
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                CMS
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.cms.expert-picks.edit') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Expert Picks</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.cms.leagues.edit') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Leagues</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.cms.testimonials.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Testimonials</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.cms.pricing.edit') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pricing</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Home CMS
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('cms.home-banner.edit') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Home Banner</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('cms.featured-picks.edit') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Featured Picks</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.featured-players.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Featured Players CRUD</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.how-it-works.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>How It Works</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('cms.members-section.edit') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Members Section</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.twitter-section.edit') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Twitter Section</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.twitter-items.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manage Tweets CRUD</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('cms.success-stories.edit') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Success Stories</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('cms.saying.edit') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Saying CMS </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.saying.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Sayings CRUD </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.settings.show') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Settings</p>
                                </a>
                            </li>



                        </ul>
                    </li>
                    <li
                        class="nav-item has-treeview {{ in_array(Route::currentRouteName(), ['admin.profile.index', 'admin.profile.update']) ? 'menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ in_array(Route::currentRouteName(), ['admin.profile.index', 'admin.profile.update']) ? 'active' : '' }}">
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
                                <a href="#" class="nav-link"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
