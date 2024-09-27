<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} :: Admin</title>
    <link rel="icon" type="image/png" href="{{ asset('img/tc-ico.png') }}">

    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/front.css') }}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
       <nav  class="navbar navbar-expand-lg navbar-light   fixed-top menu">
            <div class="container">
                <div class="navbar-brand">
                    <a class="navbar-brand page-scroll" href="{{ url('') }}">
                        <img src="{{ asset('images/real_estate1.svg')}}" class="w-100 d-none d-md-inline" style="height: 40px;">
                        <img src="{{ asset('images/home.svg')}}" class="w-100 d-md-none" style="height: 40px;">
                    </a>
                </div>

                <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse"
                    data-bs-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
        <div class="my-container mt-8">
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </div>
    <div style="background-color: #f4f4f4;">
    <div class="container text-center">
        <div class="footer p-3 pt-4 ">
            <p>&copy; 2023 Renter's Estate Inc. All Rights Reserved</p>
        </div>
    </div>
</div>
</body>
</html>
