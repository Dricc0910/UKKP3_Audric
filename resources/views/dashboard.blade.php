@extends('layouts.app')
@section('title', 'Dashboard')
@section('heading', 'Dashboard')
@section('sub', 'Ringkasan pengaduan dan akun.')

@section('content')
    <div class="stats">
        <div class="stat stat--main">
            <span class="stat__label">Total pengaduan</span>
            <span class="stat__value">{{ $total }}</span>
        </div>
        <div class="stat">
            <span class="stat__label">Masuk hari ini</span>
            <span class="stat__value">{{ $hariIni }}</span>
        </div>
        <div class="stat">
            <span class="stat__label">7 hari terakhir</span>
            <span class="stat__value">{{ $mingguIni }}</span>
        </div>
        <div class="stat">
            <span class="stat__label">Akun customer</span>
            <span class="stat__value">{{ $customer }}</span>
        </div>
    </div>

    <section class="card">
        <div class="card__head">
            <h2>Pengaduan terbaru</h2>
            <a class="link" href="{{ route('pengaduan.index') }}">Lihat semua &rarr;</a>
        </div>
        @include('pengaduan._table', ['items' => $terbaru])
    </section>

    <section class="card">
        <div class="card__head">
            <h2>Akun terbaru</h2>
            <a class="link" href="{{ route('akun.index') }}">Lihat semua &rarr;</a>
        </div>
        @include('akun._table', ['items' => $akunBaru])
    </section>
@endsection