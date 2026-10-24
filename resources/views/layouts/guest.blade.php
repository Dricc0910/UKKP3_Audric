<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<main class="auth">
    <a href="{{ route('home') }}" class="brand">
        <span class="brand__logo">P</span>
        <span class="brand__name">{{ config('app.name') }}</span>
    </a>

    <div class="card auth__card">
        <h1 class="auth__title">@yield('heading')</h1>
        <p class="auth__sub">@yield('sub')</p>
        @yield('content')
    </div>

    <p class="auth__alt">@yield('alt')</p>
</main>

@if (session('success'))
    <div class="toast" role="status" data-toast>{{ session('success') }}</div>
@endif

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>