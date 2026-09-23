@extends('layouts.app')

@section('title', config('app.name') . ' -- Admin Dashboard')

@section('content')

    <!-- Styling Tema Selaras dengan Halaman Welcome -->
    <style>
        .dashboard-wrapper {
            background-color: var(--bs-body-bg);
            color: var(--bs-body-color);
            min-height: 90vh;
            padding: 2.5rem 1.5rem;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .dash-card {
            background-color: var(--bs-body-bg);
            border: 1px solid var(--bs-border-color);
            color: var(--bs-body-color);
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
        }

        .dash-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.06);
        }

        .list-group-custom .list-group-item {
            background-color: transparent !important;
            color: var(--bs-secondary-color);
            border: none;
            transition: all 0.2s ease;
        }

        .list-group-custom .list-group-item.active {
            background-color: var(--bs-primary) !important;
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(var(--bs-primary-rgb), 0.25);
        }

        .list-group-custom .list-group-item:hover:not(.active) {
            background-color: rgba(var(--bs-primary-rgb), 0.08);
            color: var(--bs-primary) !important;
        }
    </style>

    <div class="container-fluid dashboard-wrapper">
        <div class="row g-4 justify-content-center">
            
            <!-- SIDEBAR ADMIN -->
            <div class="col-lg-3 col-md-4">
                <div class="dash-card p-4 sticky-top border-start border-4 border-primary" style="top: 90px;">
                    <div class="d-flex align-items-center mb-4 pb-3 border-bottom border-opacity-10">
                        <div class="p-3 rounded-3 text-white me-3 shadow-sm bg-primary">
                            <i class="bi bi-shield-lock-fill fs-4"></i>
                        </div>
                        <div>
                            <span class="badge bg-primary bg-opacity-10 text-primary text-uppercase fw-semibold mb-1" style="font-size: 10px; letter-spacing: 0.8px;">Sistem Kontrol</span>
                            <h5 class="fw-bold mb-0">Admin Area</h5>
                        </div>
                    </div>

                    <!-- Menu Navigasi Sidebar -->
                    <div class="list-group list-group-flush list-group-custom gap-2">
                        <a href="#" class="list-group-item rounded-3 active py-2.5 px-3 fw-medium">
                            <i class="bi bi-speedometer2 me-2"></i> Dashboard
                        </a>
                        <a href="{{ route('kategori.index') }}" class="list-group-item rounded-3 py-2.5 px-3 fw-medium">
                            <i class="bi bi-shield-check me-2"></i> Kategori
                        </a>
                        <a href="{{ route('alat.index') }}" class="list-group-item rounded-3 py-2.5 px-3 fw-medium">
                            <i class="bi bi-people me-2"></i> Alat
                        </a>
                        <a href="{{ route('peminjaman.index') }}" class="list-group-item rounded-3 py-2.5 px-3 fw-medium">
                            <i class="bi bi-database-down me-2"></i>Peminjaman
                        </a>
                    </div>
                </div>
            </div>

            <!-- KONTEN UTAMA -->
            <div class="col-lg-9 col-md-8">
                
                <!-- Welcome Header Card -->
                <div class="dash-card p-4 p-md-5 mb-4 position-relative overflow-hidden border-start border-5 border-primary bg-gradient shadow-sm" style="background: linear-gradient(135deg, rgba(var(--bs-primary-rgb), 0.08) 0%, rgba(var(--bs-primary-rgb), 0.01) 100%);">
                    <div class="row align-items-center position-relative" style="z-index: 2;">
                        <div class="col-md-8">
                            <span class="badge px-3 py-2 rounded-pill mb-3 fw-semibold shadow-sm bg-primary text-white">
                                <i class="bi bi-patch-check-fill me-1"></i> Administrator Utama
                            </span>
                            <h1 class="h3 fw-bold mb-2">Halo, {{ $user->username }}! ✨</h1>
                            <p class="text-muted mb-0">
                                Senang melihatmu kembali di panel kontrol hari ini. Semua sistem berjalan normal dan siap untuk kamu kelola dengan lancar.
                            </p>
                        </div>
                        <div class="col-md-4 text-end d-none d-md-block">
                            <div class="d-inline-flex p-4 rounded-circle shadow-sm bg-primary bg-opacity-10 text-primary">
                                <i class="bi bi-emoji-smile display-5"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grid Menu Utama Admin (3 Kartu Fitur) -->
                <div class="row g-4">
                    
                    <!-- Card Manage Role -->
                    <div class="col-xl-4 col-md-6">
                        <div class="dash-card p-4 h-100 d-flex flex-column justify-content-between border-top border-3 border-primary">
                            <div>
                                <div class="d-inline-flex p-3 rounded-3 mb-3 shadow-sm bg-primary bg-opacity-10 text-primary">
                                    <i class="bi bi-shield-check fs-4"></i>
                                </div>
                                <h3 class="h5 fw-bold mb-2">Manage Role</h3>
                                <p class="text-muted small mb-4">
                                    Tambah dan atur hak akses role baru untuk menyusun tingkat keamanan pengguna aplikasi.
                                </p>
                            </div>
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-primary rounded-pill w-100 fw-semibold shadow-sm">
                                Kelola Role <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Card Manage User -->
                    <div class="col-xl-4 col-md-6">
                        <div class="dash-card p-4 h-100 d-flex flex-column justify-content-between border-top border-3 border-primary">
                            <div>
                                <div class="d-inline-flex p-3 rounded-3 mb-3 shadow-sm bg-primary bg-opacity-10 text-primary">
                                    <i class="bi bi-people fs-4"></i>
                                </div>
                                <h3 class="h5 fw-bold mb-2">Manage User</h3>
                                <p class="text-muted small mb-4">
                                    Daftarkan pengguna baru, perbarui informasi akun, dan tetapkan perannya secara real-time.
                                </p>
                            </div>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-primary rounded-pill w-100 fw-semibold shadow-sm">
                                Kelola User <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Card Download Database -->
                    <div class="col-xl-4 col-md-6">
                        <div class="dash-card p-4 h-100 d-flex flex-column justify-content-between border-top border-3 border-warning">
                            <div>
                                <div class="d-inline-flex p-3 rounded-3 mb-3 shadow-sm bg-warning bg-opacity-10 text-warning">
                                    <i class="bi bi-database-down fs-4"></i>
                                </div>
                                <h3 class="h5 fw-bold mb-2">Database Backup</h3>
                                <p class="text-muted small mb-4">
                                    Amankan salinan data penting dengan mengunduh file cadangan database .sql secara berkala.
                                </p>
                            </div>
                            <a href="{{ route('admin.database.export') }}" class="btn btn-warning text-dark rounded-pill w-100 fw-semibold shadow-sm">
                                Download .SQL <i class="bi bi-download ms-1"></i>
                            </a>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

@endsection