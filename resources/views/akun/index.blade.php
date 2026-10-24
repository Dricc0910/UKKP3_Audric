@extends('layouts.app')
@section('title', 'Akun')
@section('heading', 'Akun')
@section('sub', 'Daftar akun yang terdaftar.')

@section('content')
    <section class="card">
        <div class="card__head">
            <h2>Daftar akun</h2>
            <form method="GET" action="{{ route('akun.index') }}" class="search" role="search">
                <input type="search" name="q" value="{{ $q }}" placeholder="Cari nama atau email" aria-label="Cari akun">
                <button class="btn btn--sm" type="submit">Cari</button>
                @if ($q !== '')
                    <a class="btn btn--ghost btn--sm" href="{{ route('akun.index') }}">Reset</a>
                @endif
            </form>
        </div>

        @include('akun._table', ['items' => $items])

        {{ $items->links('pagination.custom') }}
    </section>
@endsection