<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <title>{{ $pageData->pageTabTitle }} | {{ app_setting('application_name') }}</title> --}}

    <link
        rel="stylesheet"href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('admin_assets/css/tempusdominus-bootstrap-4.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/css/select2-bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/css/all.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('admin_assets/assets/plugins/dropzone/dropzone.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('admin_assets/css/toastr/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/css/waitMe/waitMe.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/css/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/css/datatables/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/css/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/css/sweetalert2.min.css') }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="{{ asset("admin_assets/css/buttons.dataTables.min.css") }}">
    <link rel="stylesheet" href="{{ asset("admin_assets/css/dropzone.min.css") }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    {{-- @if (Auth::user()->role === 2 || Auth::user()->role === 3)
        <link rel="stylesheet" href="{{ asset('admin_assets/css/customer-template.css') }}">
    @endif --}}
    <link rel="stylesheet" href="{{ asset('admin_assets/css/admin-template.css') }}">

    <link rel="stylesheet" href="{{ asset('admin_assets/css/custom.css?v=' . time()) }}">
    @stack('custom-css')

    <style>
       .dataTables_length{
                margin-top: 10px;
                margin-left: 5px;
        }
        div:where(.swal2-container) h2:where(.swal2-title) {
            padding: .1em 1em 0;
        }

        div:where(.swal2-container) .swal2-html-container {
            padding: 0.3em 1.6em .3em;
        }

        div:where(.swal2-container) button:where(.swal2-close) {
            box-shadow: none !important;
        }

        .swal2-close {
            color: black;
        }
#currentTime {
    display: inline-block;
    padding: 8px 15px 7px 15px;
    font-size: 16px;
    font-weight: bold;
    color: #ffffff;
    border: 2px solid #6c757d;
    border-radius: 8px;
    font-family: 'Digital-7', sans-serif;
    letter-spacing: 4px;
    transition: opacity 0.4s ease-in-out;
    /* box-shadow: 0.5px 0.5px 12px -1px rgb(0 191 255 / 20%); */
    background-color: #222;
}
    </style>
</head>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-light" style="padding-right:15px; ">
            <ul class="navbar-nav">

            </ul>


            <ul class="navbar-nav ml-auto" style="display: flex; align-items:center;">
                <li>
                <a href="{{ route('front.index') }}" target="_blank">
                    <img src="{{ asset('admin_assets/images/globe.png') }}" style="height:30px; width:30px; margin-right: 30px; " alt="">
                </a>

                </li>

                <li class="nav-item dropdown" style="margin-right: 50px;">
                    <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" id="userDropdown"
                        role="button" data-toggle="dropdown" aria-expanded="false"
                        style="padding: 10px; border-radius: 8px; transition: 0.3s;">
                        <img src="{{ Auth::user()->image ? Storage::url(Auth::user()->image) : asset('admin_assets/images/avatar.png') }}"
                            class="rounded-circle border"
                            style="width: 45px; height: 45px; object-fit: cover; border: 2px solid #ddd;">


                        <span class="ms-2 text-dark fw-bold"
                            style="padding-left: 10px; font-size: 16px;">{{ Auth::user()->first_name }}
                            {{ Auth::user()->last_name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-md border-0 rounded-3"
                        aria-labelledby="userDropdown" style="min-width: 180px; border-radius:16px; ">
                        <li class="text-center p-3">
                            <img src="{{ Auth::user()->image ? Storage::url( Auth::user()->image) : asset('admin_assets/images/avatar.png') }}"
                            class="rounded-circle border mb-2"
                            style="width: 60px; height: 60px; object-fit: cover; border: 2px solid #ddd;">

                            <strong class="d-block"
                                style="color: black; font-size: 16px;">{{ Auth::user()->first_name }}
                                {{ Auth::user()->last_name }}
                            </strong>
                            {{-- @if($role = auth()->user()->getRoleNames()->first())
                                <span class="badge badge-pill bg-dark text-white mt-2"
                                    style="font-size: 13px; padding: 6px 10px; border-radius: 12px;">
                                    {{ ucwords(str_replace('_', ' ', $role)) }}
                                </span>
                            @endif --}}
                        </li>
                        @can('general-settings')
                            <li><a class="dropdown-item py-2" href="/admin/global-settings/general-settings"><i
                                        class="fas fa-cog me-2" style="margin-right: 5px;"></i>Settings</a></li>
                        @endcan
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item py-2" href="{{ route('admin.profile.index') }}">
                                <i class="fas fa-user-edit me-2" style="margin-right: 5px;"></i>Edit Profile
                            </a>
                        </li>
                        <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" class="dropdown-item text-danger py-2">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->


        @include('admin.layouts.navigation')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            @isset($pageData->showTableInfo)
                                @if ($pageData->showTableInfo == false)
                                    {{-- <h1 class="m-0">{{ $pageData ?? '' }}</h1> --}}
                                    <h1 class="m-0">{{ $pageData->title ?? '' }}</h1>

                                @endif
                            @else
                                {{-- <h1 class="m-0">{{ $pageData ?? '' }}</h1> --}}
                                <h1 class="m-0">{{ $pageData->title ?? '' }}</h1>

                            @endisset
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        @include('admin.layouts.sidebar')
        @include('admin.layouts.footer')
    </div>
    @include('admin.layouts.scripts')



</body>

</html>
