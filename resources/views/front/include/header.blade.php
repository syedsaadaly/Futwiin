<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- ALL CSS LIBRARY -->
    <link rel="stylesheet" href="{{ asset('front/css/all.min.css') }}" />

    <!-- CUSTOM STYLESHEET -->
    <link rel="stylesheet" href="{{ asset('front/css/custom.min.css')}}" />

    <!-- RESPONSIVE STYLESHEET -->
    <link rel="stylesheet" href="{{ asset('front/css/responsive.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<link rel="icon" href="{{ $global_settings['fav_icon'] ?? asset('front/images/default.png') }}" type="image/png">

    <title>FutWin</title>
</head>
<body>
@yield('style')
