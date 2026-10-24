@extends('layouts.app')
@section('title', auth()->user()->isAdmin() ? 'Pengaduan' : 'Pengaduan Saya')
@section('heading', auth()->user()->isAdmin() ? 'Pengaduan' : 'Pengaduan saya')
@section('sub', auth()->user()->isAdmin() ? 'Semua pengaduan dari customer.' : 'Pengaduan yang pernah kamu kirim.')

@section('actions')
    @if (auth()->user()->isCustomer())
        <a class="btn" href="{{ route('pengaduan.create') }}">+ Buat pengaduan</a>
    @endif
@endsection

@section('content')
    <section class="card">
        <div class="card__head">
            <h2>Daftar pengaduan</h2>
            <form method="GET" action="{{ route('pengaduan.index') }}" class="search" role="search">
                <input type="search" name="q" value="{{ $q }}" placeholder="Cari nama, email, atau no. HP" aria-label="Cari pengaduan">
                <button class="btn btn--sm" type="submit">Cari</button>
                @if ($q !== '')
                    <a class="btn btn--ghost btn--sm" href="{{ route('pengaduan.index') }}">Reset</a>
                @endif
            </form>
        </div>

        @include('pengaduan._table', ['items' => $items])

        {{ $items->links('pagination.custom') }}
    </section>
@endsection