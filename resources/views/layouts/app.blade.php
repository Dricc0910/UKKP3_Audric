<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Pengaduan') | {{ config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('head')
</head>
<body>
@php($me = auth()->user())
<div class="shell">
    <aside class="side">
        <a href="{{ route('home') }}" class="brand">
            <span class="brand__logo">P</span>
            <span class="brand__name">{{ config('app.name') }}</span>
        </a>

        <nav class="nav">
            @if ($me->isAdmin())
                <a href="{{ route('dashboard') }}" class="nav__item {{ request()->routeIs('dashboard') ? 'is-active' : '' }}">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 11l9-8 9 8"/><path d="M5 10v10h14V10"/></svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('akun.index') }}" class="nav__item {{ request()->routeIs('akun.*') ? 'is-active' : '' }}">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/><path d="M21 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    <span>Akun</span>
                </a>
                <a href="{{ route('pengaduan.index') }}" class="nav__item {{ request()->routeIs('pengaduan.*') ? 'is-active' : '' }}">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/></svg>
                    <span>Pengaduan</span>
                </a>
            @else
                <a href="{{ route('pengaduan.create') }}" class="nav__item {{ request()->routeIs('pengaduan.create') ? 'is-active' : '' }}">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
                    <span>Buat pengaduan</span>
                </a>
                <a href="{{ route('pengaduan.index') }}" class="nav__item {{ request()->routeIs('pengaduan.index', 'pengaduan.show') ? 'is-active' : '' }}">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/></svg>
                    <span>Pengaduan saya</span>
                </a>
            @endif
        </nav>

        <div class="side__foot">
            <div class="side__user">
                <span class="avatar" aria-hidden="true">{{ mb_strtoupper(mb_substr($me->name, 0, 1)) }}</span>
                <div class="side__meta">
                    <div class="side__name">{{ $me->name }}</div>
                    <div class="side__role">{{ $me->isAdmin() ? 'Admin' : 'Customer' }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn--ghost btn--sm" type="submit">Keluar</button>
            </form>
        </div>
    </aside>

    <div class="main">
        <header class="topbar">
            <div>
                <h1 class="page-title">@yield('heading')</h1>
                <p class="page-sub">@yield('sub')</p>
            </div>
            <div class="topbar__actions">@yield('actions')</div>
        </header>

        @if (session('success'))
            <div class="toast" role="status" data-toast>{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="toast toast--error" role="alert" data-toast>{{ session('error') }}</div>
        @endif

        <main class="content">
            @yield('content')
        </main>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>