@extends('layouts.app')

@section('title', 'Masuk ke SHEIN - Peminjaman Lab Sekolah')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    /* Paksa background body & layout mengikuti Dark Slate Cyan Theme */
    body, #app, main {
        background-color: #090d16 !important;
        color: #f1f5f9 !important;
    }

    /* Container Wrapper */
    .login-page-wrapper {
        background-color: #090d16 !important;
        color: #f1f5f9 !important;
        min-height: 100vh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
        position: relative;
        overflow-x: hidden;
    }

    /* Ambient Glowing Backgrounds */
    .ambient-glow-1 {
        position: absolute;
        top: -10%;
        left: -5%;
        width: 450px;
        height: 450px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(6, 182, 212, 0.18) 0%, rgba(9, 13, 22, 0) 70%);
        pointer-events: none;
        z-index: 0;
    }

    .ambient-glow-2 {
        position: absolute;
        bottom: -10%;
        right: -5%;
        width: 500px;
        height: 500px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(139, 92, 246, 0.15) 0%, rgba(9, 13, 22, 0) 70%);
        pointer-events: none;
        z-index: 0;
    }

    /* Modern Dark Glassmorphism Card */
    .login-glass-card {
        background: rgba(15, 23, 42, 0.9) !important;
        border: 1px solid rgba(56, 189, 248, 0.18) !important;
        border-radius: 1.5rem !important;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5) !important;
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        transition: all 0.3s ease;
    }

    .login-glass-card:hover {
        border-color: rgba(56, 189, 248, 0.35) !important;
        box-shadow: 0 25px 50px rgba(6, 182, 212, 0.15) !important;
    }

    /* Icon Header */
    .icon-box-logo {
        width: 60px;
        height: 60px;
        border-radius: 18px;
        background: #0c2233 !important;
        color: #38bdf8 !important;
        border: 1px solid rgba(56, 189, 248, 0.25);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        box-shadow: 0 8px 20px rgba(6, 182, 212, 0.2);
    }

    /* Form Controls Dark Theme */
    .form-dark-label {
        color: #94a3b8;
        font-size: 0.78rem;
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    .input-group-text-dark {
        background-color: rgba(30, 41, 59, 0.8) !important;
        border: 1px solid rgba(56, 189, 248, 0.2) !important;
        color: #38bdf8 !important;
    }

    .form-control-dark {
        background-color: rgba(30, 41, 59, 0.6) !important;
        border: 1px solid rgba(56, 189, 248, 0.2) !important;
        color: #ffffff !important;
        transition: all 0.25s ease;
    }

    .form-control-dark:focus {
        background-color: rgba(30, 41, 59, 0.9) !important;
        border-color: #06b6d4 !important;
        box-shadow: 0 0 12px rgba(6, 182, 212, 0.25) !important;
        color: #ffffff !important;
    }

    .form-control-dark::placeholder {
        color: #64748b;
    }

    /* Tombol Neon Gradient */
    .btn-neon-primary {
        background: linear-gradient(135deg, #06b6d4 0%, #3b82f6 50%, #8b5cf6 100%) !important;
        border: none !important;
        color: #ffffff !important;
        font-weight: 600;
        padding: 12px;
        border-radius: 12px !important;
        box-shadow: 0 6px 20px rgba(6, 182, 212, 0.3);
        transition: all 0.3s ease;
    }

    .btn-neon-primary:hover {
        opacity: 0.95;
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(6, 182, 212, 0.45);
    }

    .link-neon-cyan {
        color: #38bdf8;
        transition: color 0.2s ease;
    }

    .link-neon-cyan:hover {
        color: #06b6d4;
        text-decoration: underline !important;
    }
</style>

<div class="login-page-wrapper">
    <!-- Ambient Glows Background -->
    <div class="ambient-glow-1"></div>
    <div class="ambient-glow-2"></div>

    <div class="container position-relative" style="z-index: 2;">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6 col-lg-4">
                
                <!-- Card Login SHEIN -->
                <div class="card login-glass-card p-2">
                    <div class="card-body p-4 p-sm-4">
                        
                        <!-- Header / Logo -->
                        <div class="text-center mb-4">
                            <div class="icon-box-logo mb-3">
                                <i class="bi bi-laptop"></i>
                            </div>
                            <h2 class="fw-bold text-white fs-4 mb-1">Selamat Datang</h2>
                            <p class="small mb-0" style="color: #94a3b8;">Masuk ke portal peminjaman lab <strong>SHEIN</strong></p>
                        </div>

                        <!-- Form Login -->
                        <form method="POST" action="{{ route('login.attempt') }}">
                            @csrf

                            <!-- Input Username -->
                            <div class="mb-3">
                                <label class="form-label form-dark-label text-uppercase mb-1" for="username">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-dark rounded-start-3">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input type="text" id="username" name="username" value="{{ old('username') }}" 
                                           class="form-control form-control-dark rounded-end-3 shadow-none @error('username') is-invalid @enderror" 
                                           placeholder="Masukkan username" autofocus>
                                </div>
                                @error('username') 
                                    <div class="invalid-feedback d-block small mt-1" style="color: #f87171;">{{ $message }}</div> 
                                @enderror
                            </div>

                            <!-- Input Password -->
                            <div class="mb-4">
                                <label class="form-label form-dark-label text-uppercase mb-1" for="password">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-dark rounded-start-3">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input type="password" id="password" name="password" 
                                           class="form-control form-control-dark rounded-end-3 shadow-none @error('password') is-invalid @enderror" 
                                           placeholder="Masukkan password">
                                </div>
                                @error('password') 
                                    <div class="invalid-feedback d-block small mt-1" style="color: #f87171;">{{ $message }}</div> 
                                @enderror
                            </div>

                            <!-- Tombol Login -->
                            <button class="btn btn-neon-primary w-100 mb-3 d-flex align-items-center justify-content-center gap-2" type="submit">
                                <i class="bi bi-box-arrow-in-right fs-5"></i>
                                <span>Masuk Sekarang</span>
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
                            <hr class="border-secondary border-opacity-25 my-4">
                            <p class="small text-center mb-0" style="color: #94a3b8;">
                                Belum punya akun? <a href="{{ route('register') }}" class="link-neon-cyan fw-semibold text-decoration-none ms-1">Daftar di sini</a>
                            </p>
                        @endif

                    </div>
                </div>

                <!-- Footer Kecil -->
                <div class="text-center mt-4 small" style="color: #64748b;">
                    &copy; {{ date('Y') }} <strong>SHEIN</strong> &bull; Sistem Peminjaman Lab Sekolah
                </div>

            </div>
        </div>
    </div>
</div>
@endsection