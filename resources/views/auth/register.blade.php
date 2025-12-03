@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div style="max-width: 500px; margin: 3rem auto;">
    <div class="card">
        <h1 style="text-align: center; margin-bottom: 2rem;">Daftar Akun Baru</h1>

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <span style="color: #e74c3c; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="nip">NIP</label>
                <input type="text" id="nip" name="nip" value="{{ old('nip') }}" required>
                @error('nip')
                    <span style="color: #e74c3c; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <span style="color: #e74c3c; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">Daftar</button>
        </form>

        <p style="text-align: center; margin-top: 1rem;">
            Sudah punya akun? <a href="{{ route('login') }}" style="color: #3498db;">Login di sini</a>
        </p>
    </div>
</div>
@endsection
