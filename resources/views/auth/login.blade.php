@extends('layouts.guest')
@section('title', 'Masuk')
@section('heading', 'Masuk')
@section('sub', 'Masuk sebagai admin atau customer.')

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="field @error('email') field--error @enderror">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autofocus>
            @error('email') <p class="field__error">{{ $message }}</p> @enderror
        </div>

        <div class="field @error('password') field--error @enderror">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" placeholder="Password kamu" required>
            @error('password') <p class="field__error">{{ $message }}</p> @enderror
        </div>

        <button class="btn btn--block" type="submit">Masuk</button>
    </form>
@endsection

@section('alt')
    Belum punya akun? <a class="link" href="{{ route('register') }}">Daftar sebagai customer</a>
@endsection