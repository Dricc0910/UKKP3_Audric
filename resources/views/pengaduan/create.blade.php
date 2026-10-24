@extends('layouts.app')
@section('title', 'Buat Pengaduan')
@section('heading', 'Buat pengaduan')
@section('sub', 'Isi datamu, lalu ceritakan masukannya.')

@section('actions')
    <a class="btn btn--ghost" href="{{ route('pengaduan.index') }}">Lihat daftar pengaduan</a>
@endsection

@section('content')
    @include('pengaduan._form', [
        'action' => route('pengaduan.store'),
        'method' => 'POST',
        'submit' => 'Kirim pengaduan',
    ])
@endsection