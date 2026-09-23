@extends('layouts.app')

@section('title', 'Masuk ke InventarisHub')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="row justify-content-center align-items-center min-vh-75 py-5">
    <div class="col-md-5 col-lg-4">
        
        <!-- Card Login Modern -->
        <div class="card border-0 shadow-lg rounded-4 p-2 bg-white">
            <div class="card-body p-4">
                
                <!-- Header / Logo Kecil -->
                <div class="text-center mb-4">
                    <div class="bg-primary-subtle text-primary rounded-circle d-inline-flex p-3 fs-3 mb-3 shadow-sm">
                        <i class="bi bi-box-seam-fill"></i>
                    </div>
                    <h2 class="fw-bold text-dark fs-4 mb-1">Selamat Datang</h2>
                    <p class="text-muted small">Masuk untuk mengelola peminjaman di InventarisHub</p>
                </div>

                <!-- Form Login -->
                <form method="POST" action="{{ route('login.attempt') }}">
                    @csrf

                    <!-- Input Username -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary small" for="username">USERNAME</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted">
                                <i class="bi bi-person"></i>
                            </span>
                            <input type="text" id="username" name="username" value="{{ old('username') }}" 
                                   class="form-control bg-light border-start-0 shadow-none @error('username') is-invalid @enderror" 
                                   placeholder="Masukkan username" autofocus>
                        </div>
                        @error('username') 
                            <div class="invalid-feedback d-block">{{ $message }}</div> 
                        @enderror
                    </div>

                    <!-- Input Password -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-secondary small" for="password">PASSWORD</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input type="password" id="password" name="password" 
                                   class="form-control bg-light border-start-0 shadow-none @error('password') is-invalid @enderror" 
                                   placeholder="Masukkan password">
                        </div>
                        @error('password') 
                            <div class="invalid-feedback d-block">{{ $message }}</div> 
                        @enderror
                    </div>

                    <!-- Tombol Login -->
                    <button class="btn btn-primary w-100 py-2 rounded-3 fw-semibold shadow-sm mb-3" type="submit">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Masuk Sekarang 
                    </button>
                </form>

                <!-- Cek Registrasi -->
                @php
                    $canRegister = false;
                    try {
                        $canRegister = \App\Models\Role::where('can_register', 1)->exists();
                    } catch (\Throwable $e) {
                        $canRegister = false;
                    }
                @endphp

                @if ($canRegister)
                    <hr class="text-muted opacity-25 my-4">
                    <p class="text-secondary small text-center mb-0">
                       <p> Belum punya akun? </p><a href="{{ route('register') }}" class="text-primary fw-semibold text-decoration-none">Daftar di sini</a>
                    </p>
                @endif

            </div>
        </div>

        <!-- Footer Kecil di Bawah Card -->
        <div class="text-center mt-4 text-muted small">
            &copy; {{ date('Y') }} InventarisHub. All rights reserved.
        </div>

    </div>
</div>
@endsection