<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'FutbolDB')</title>
    @vite('resources/sass/app.scss')
</head>
<body>
    @include('layouts.header')

    <main class="page-wrap">
        <div class="app-shell">
            @if(session('success'))
                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    {{ implode(' | ', $errors->all()) }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>
    @include('partials.footer')
</body>
</html>
