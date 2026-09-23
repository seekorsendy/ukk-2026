@extends('layouts.app')

@section('title', 'Daftar Akun - InventarisHub')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="row justify-content-center align-items-center min-vh-75 py-5">
    <div class="col-md-6 col-lg-5">
        
        <!-- Card Register Modern -->
        <div class="card border-0 shadow-lg rounded-4 p-2 bg-white">
            <div class="card-body p-4">
                
                <!-- Header / Logo Kecil -->
                <div class="text-center mb-4">
                    <div class="bg-primary-subtle text-primary rounded-circle d-inline-flex p-3 fs-3 mb-3 shadow-sm">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    <h2 class="fw-bold text-dark fs-4 mb-1">Buat Akun Baru</h2>
                    <p class="text-muted small">Sudah punya akun? <a href="{{ route('login') }}" class="text-primary fw-semibold text-decoration-none">Masuk di sini</a></p>
                </div>

                <!-- Form Register -->
                <form method="POST" action="{{ route('register.attempt') }}">
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
                                   placeholder="Pilih username unik" autofocus>
                        </div>
                        @error('username') 
                            <div class="invalid-feedback d-block">{{ $message }}</div> 
                        @enderror
                    </div>

                    <!-- Input Password -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary small" for="password">PASSWORD</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input type="password" id="password" name="password" 
                                   class="form-control bg-light border-start-0 shadow-none @error('password') is-invalid @enderror" 
                                   placeholder="Minimal 6 karakter">
                        </div>
                        @error('password') 
                            <div class="invalid-feedback d-block">{{ $message }}</div> 
                        @enderror
                    </div>

                    <!-- Input Konfirmasi Password -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary small" for="password_confirmation">KONFIRMASI PASSWORD</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted">
                                <i class="bi bi-lock-fill"></i>
                            </span>
                            <input type="password" id="password_confirmation" name="password_confirmation" 
                                   class="form-control bg-light border-start-0 shadow-none" 
                                   placeholder="Ulangi password">
                        </div>
                    </div>

                    <!-- Pilihan Role / Daftar Sebagai -->
                    @if (count($roles) > 1)
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-secondary small" for="role">DAFTAR SEBAGAI</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted">
                                    <i class="bi bi-shield-check"></i>
                                </span>
                                <select id="role" name="role" class="form-select bg-light border-start-0 shadow-none @error('role') is-invalid @enderror">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}" {{ old('role') === $role->name ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('role') 
                                <div class="invalid-feedback d-block">{{ $message }}</div> 
                            @enderror
                        </div>
                    @else
                        <input type="hidden" name="role" value="{{ $roles[0]->name }}">
                    @endif

                    <!-- Tombol Submit -->
                    <button class="btn btn-primary w-100 py-2 rounded-3 fw-semibold shadow-sm mb-3" type="submit">
                        <i class="bi bi-check-circle me-2"></i> Daftar Sekarang
                    </button>
                </form>

            </div>
        </div>

        <!-- Footer Kecil -->
        <div class="text-center mt-4 text-muted small">
            &copy; {{ date('Y') }} InventarisHub. All rights reserved.
        </div>

    </div>
</div>
@endsection