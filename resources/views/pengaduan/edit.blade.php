@extends('layouts.app')
@section('title', 'Edit Pengaduan')
@section('heading', 'Edit pengaduan')
@section('sub', 'Ubah data, lalu simpan.')

@section('content')
    @include('pengaduan._form', [
        'action' => route('pengaduan.update', $pengaduan),
        'method' => 'PUT',
        'submit' => 'Simpan perubahan',
    ])
@endsection