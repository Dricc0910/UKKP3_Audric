@extends('layouts.guest')
@section('title', 'Daftar')
@section('heading', 'Daftar')
@section('sub', 'Buat akun customer untuk mengirim pengaduan.')

@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="field @error('name') field--error @enderror">
            <label for="name">Nama</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Nama lengkap kamu" maxlength="100" required autofocus>
            @error('name') <p class="field__error">{{ $message }}</p> @enderror
        </div>

        <div class="field @error('email') field--error @enderror">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" maxlength="150" required>
            @error('email') <p class="field__error">{{ $message }}</p> @enderror
        </div>

        <div class="field @error('password') field--error @enderror">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" placeholder="Minimal 6 karakter" required>
            @error('password') <p class="field__error">{{ $message }}</p> @enderror
        </div>

        <button class="btn btn--block" type="submit">Daftar</button>
    </form>
@endsection

@section('alt')
    Sudah punya akun? <a class="link" href="{{ route('login') }}">Masuk</a>
@endsection