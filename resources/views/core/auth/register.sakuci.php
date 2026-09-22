@extends('layouts.app')

@section('title', 'Daftar Akun')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-9 col-lg-7 col-xl-5">
            
            <div class="card border-0 shadow-lg rounded-5 overflow-hidden bg-body">
                <div class="card-body p-4 p-sm-5">
                    
                    <!-- Header -->
                    <div class="text-center mb-4">
                        <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px;">
                            <i class="bi bi-person-plus-fill fs-3"></i>
                        </div>
                        <h2 class="fw-bold fs-3 mb-1">Buat Akun Baru</h2>
                        <p class="text-secondary small">Sudah punya akun? <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">Masuk di sini</a>.</p>
                    </div>

                    <!-- Form Register -->
                    <form method="POST" action="{{ route('register.attempt') }}">
                        @csrf

                        <div class="form-floating mb-3">
                            <input type="text" id="username" name="username" value="{{ old('username') }}" 
                                   class="form-control rounded-4 {{ errors()->has('username') ? 'is-invalid' : '' }}" 
                                   placeholder="Username" autofocus>
                            <label for="username">Username</label>
                            @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" id="password" name="password" 
                                   class="form-control rounded-4 {{ errors()->has('password') ? 'is-invalid' : '' }}" 
                                   placeholder="Password">
                            <label for="password">Password</label>
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" id="password_confirmation" name="password_confirmation" 
                                   class="form-control rounded-4" 
                                   placeholder="Konfirmasi Password">
                            <label for="password_confirmation">Konfirmasi Password</label>
                        </div>

                        @if (count($roles) > 1)
                            <div class="form-floating mb-4">
                                <select id="role" name="role" class="form-select rounded-4 {{ errors()->has('role') ? 'is-invalid' : '' }}">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}" {{ old('role') === $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <label for="role">Daftar sebagai</label>
                                @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        @else
                            <input type="hidden" name="role" value="{{ $roles[0]->name }}">
                        @endif

                        <button class="btn btn-primary w-100 py-3 rounded-4 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2 mt-4" type="submit">
                            <span>Daftar Sekarang</span>
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection