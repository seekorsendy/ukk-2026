@extends('layouts.app')

@section('title', 'Admin Dashboard - InventarisHub')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<!-- Tombol Trigger Sidebar (Offcanvas) -->
<div class="d-flex align-items-center justify-content-between mb-4">
    <button class="btn btn-outline-secondary border shadow-sm d-flex align-items-center gap-2 px-3 py-2 rounded-pill fw-semibold" 
            type="button" 
            data-bs-toggle="offcanvas" 
            data-bs-target="#adminSidebar" 
            aria-controls="adminSidebar">
        <i class="bi bi-grid-fill text-primary fs-5"></i>
    </button>
</div>

<!-- Sidebar Khusus Dashboard (Offcanvas Adaptif) -->
<div class="offcanvas offcanvas-start border-0 shadow-lg" tabindex="-1" id="adminSidebar" aria-labelledby="adminSidebarLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title fw-bold" id="adminSidebarLabel">
            <i class="bi bi-speedometer2 text-primary me-2"></i> Menu Admin
        </h5>
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-4">
        <p class="text-muted small mb-4">Pintasan cepat pengelolaan sistem InventarisHub:</p>
        <ul class="nav nav-pills flex-column gap-2">
            <li class="nav-item">
                <a href="{{ route('kategori.index') }}" class="nav-link d-flex align-items-center gap-3 py-2 px-3 rounded-3">
                    <i class="bi bi-tags text-primary fs-5"></i> 
                    <span class="fw-medium">Kelola Kategori</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('alat.index') }}" class="nav-link d-flex align-items-center gap-3 py-2 px-3 rounded-3">
                    <i class="bi bi-box-seam text-success fs-5"></i> 
                    <span class="fw-medium">Kelola Alat</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('peminjaman.index') }}" class="nav-link d-flex align-items-center gap-3 py-2 px-3 rounded-3">
                    <i class="bi bi-cloud-arrow-down text-warning fs-5"></i> 
                    <span class="fw-medium">Data peminjaman</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('pengembalian.index') }}" class="nav-link d-flex align-items-center gap-3 py-2 px-3 rounded-3">
                    <i class="bi bi-cloud-arrow-down text-brand fs-5"></i> 
                    <span class="fw-medium">Data Pengembalian</span>
                </a>
            </li>
        </ul>
    </div>
</div>


<!-- Banner Selamat Datang Admin (Otomatis Menyesuaikan Dark/Light) -->
<div class="card border-0 shadow-sm rounded-4 mb-4 border-start border-4 border-primary">
    <div class="card-body p-4 p-lg-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div>
            <div class="d-inline-flex align-items-center px-3 py-1 rounded-pill bg-primary-subtle text-primary fw-semibold small mb-2">
                <i class="bi bi-shield-lock-fill me-1"></i> Area Administrator
            </div>
            <h1 class="h4 fw-bold mb-1">Halo, {{ $user->username }}! 👋</h1>
            <p class="text-muted mb-0 small" style="max-width: 600px;">
                Anda masuk dengan hak akses penuh (`admin`). Silakan gunakan menu di bawah untuk mengelola data pengguna, role, dan sistem.
            </p>
        </div>
        <div class="bg-primary-subtle text-primary rounded-4 p-3 d-none d-md-flex align-items-center justify-content-center" style="width: 60px; height: 60px; font-size: 1.75rem;">
            <i class="bi bi-speedometer2"></i>
        </div>
    </div>
</div>

<!-- Grid Menu Utama Admin -->
<div class="row g-4">
    
    <!-- Manage Role -->
    <div class="col-md-4">
        <a href="{{ route('admin.roles.index') }}" class="card border-0 shadow-sm rounded-4 text-decoration-none h-100 card-hover transition">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
                <div>
                    <div class="bg-primary-subtle text-primary rounded-4 d-inline-flex p-3 fs-4 mb-3 shadow-sm">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h2 class="h5 fw-bold mb-2">Manage Role</h2>
                    <p class="text-muted small mb-0">Tambah dan atur hak akses role baru untuk pengguna sistem.</p>
                </div>
                <div class="mt-4 text-primary fw-semibold small d-flex align-items-center">
                    Kelola Role <i class="bi bi-arrow-right ms-2"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- Manage User -->
    <div class="col-md-4">
        <a href="{{ route('admin.users.index') }}" class="card border-0 shadow-sm rounded-4 text-decoration-none h-100 card-hover transition">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
                <div>
                    <div class="bg-success-subtle text-success rounded-4 d-inline-flex p-3 fs-4 mb-3 shadow-sm">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h2 class="h5 fw-bold mb-2">Manage User</h2>
                    <p class="text-muted small mb-0">Daftar, ubah, atau hapus akun user beserta penetapan rolenya.</p>
                </div>
                <div class="mt-4 text-success fw-semibold small d-flex align-items-center">
                    Kelola User <i class="bi bi-arrow-right ms-2"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- Download Database -->
    <div class="col-md-4">
        <a href="{{ route('admin.database.export') }}" class="card border-0 shadow-sm rounded-4 text-decoration-none h-100 card-hover transition">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
                <div>
                    <div class="bg-warning-subtle text-warning rounded-4 d-inline-flex p-3 fs-4 mb-3 shadow-sm">
                        <i class="bi bi-database-down"></i>
                    </div>
                    <h2 class="h5 fw-bold mb-2">Download Database</h2>
                    <p class="text-muted small mb-0">Cadangkan seluruh isi database menjadi file `.sql` untuk keamanan data.</p>
                </div>
                <div class="mt-4 text-warning fw-semibold small d-flex align-items-center">
                    Unduh File <i class="bi bi-arrow-right ms-2"></i>
                </div>
            </div>
        </a>
    </div>

</div>

<!-- CSS Tambahan untuk Efek Hover Card di Dark/Light Mode -->
<style>
    .card-hover {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card-hover:hover {
        transform: translateY(-4px);
        box-shadow: 0 1rem 2rem rgba(0,0,0,.15)!important;
    }
</style>
@endsection