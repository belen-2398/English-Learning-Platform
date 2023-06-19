<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <title>@yield('title') | {{ config('app.name', 'Learn English') }}</title>
  @vite(['resources/css/app.css','resources/js/app.js'])


</head>
<body>
    @if (session('message'))
        <h6 class="alert alert-success">{{ session('message') }}</h6>          
    @endif

    @include('layouts.partials.admin.navbar')
    <div class="container-scroller">
        @include('layouts.partials.admin.sidebar')
        <div class="container-fluid page-body-wrapper">

            <div class="p-4 sm:ml-64">
                <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
                    <div class="main-panel">
                        <div class="content-wrapper">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>