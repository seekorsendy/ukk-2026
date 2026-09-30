@extends('layouts.app')

@section('title', config('app.name') . ' — Dashboard Admin')

@section('content')
<div class="container-fluid px-0">

    <!-- Banner Utama Elegan -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 text-white" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);">
        <div class="card-body p-4 p-md-5 position-relative">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <span class="badge bg-warning text-dark rounded-pill px-3 py-2 mb-3 fw-bold shadow-sm">
                        <i class="bi bi-shield-check me-1"></i> Panel Utama Administrator
                    </span>
                    <h2 class="fw-bold mb-2 display-6">Selamat Datang, {{ $user->username ?? 'Admin' }}! 👋</h2>
                    <p class="mb-0 text-white-50 fs-6" style="max-width: 650px;">
                        Pusat kendali sistem inventaris. Anda dapat mengelola hak akses role, akun pengguna, kategori barang, transaksi peminjaman/pengembalian, hingga backup database.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Ringkasan Statistik Cepat -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-body">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-primary-subtle text-primary p-3 rounded-4 fs-4">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div>
                        <small class="text-uppercase fw-semibold text-muted d-block fs-7">Total User</small>
                        <h4 class="fw-bold mb-0">{{ $totalUser ?? 0 }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-body">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-info-subtle text-info p-3 rounded-4 fs-4">
                        <i class="bi bi-box-seam-fill"></i>
                    </div>
                    <div>
                        <small class="text-uppercase fw-semibold text-muted d-block fs-7">Total Alat</small>
                        <h4 class="fw-bold mb-0">{{ $totalAlat ?? 0 }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-body">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-warning-subtle text-warning-emphasis p-3 rounded-4 fs-4">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>
                    <div>
                        <small class="text-uppercase fw-semibold text-muted d-block fs-7">Peminjaman</small>
                        <h4 class="fw-bold mb-0">{{ $totalPeminjaman ?? 0 }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-body">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-success-subtle text-success p-3 rounded-4 fs-4">
                        <i class="bi bi-database-check"></i>
                    </div>
                    <div>
                        <small class="text-uppercase fw-semibold text-muted d-block fs-7">Pengembalian</small>
                        <h4 class="fw-bold mb-0">{{ $totalPengembalian ?? 0 }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Akses Kelola Sistem -->
    <h5 class="fw-bold mb-3 text-body"><i class="bi bi-grid-fill me-2"></i>Menu Manajemen Sistem</h5>

    <div class="row g-3 mb-4">

        <!-- 1. Manage User -->
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('admin.users.index') }}" class="card custom-menu-card h-100 text-decoration-none border shadow-sm rounded-4 p-3">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="menu-icon-wrapper rounded-3 p-2.5 d-flex align-items-center justify-content-center">
                        <i class="bi bi-person-gear fs-4"></i>
                    </div>
                    <i class="bi bi-arrow-up-right menu-arrow text-body-tertiary fs-6"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-body mb-1 fs-5">Manage User</h6>
                    <small class="text-body-secondary d-block mb-2">Kelola akun pengguna</small>
                    <p class="text-body-secondary small mb-0 fs-7">Pengaturan pendaftaran akun baru, reset password, dan daftar pengguna terdaftar.</p>
                </div>
            </a>
        </div>

        <!-- 2. Manage Role -->
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('admin.roles.index') }}" class="card custom-menu-card h-100 text-decoration-none border shadow-sm rounded-4 p-3">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="menu-icon-wrapper rounded-3 p-2.5 d-flex align-items-center justify-content-center">
                        <i class="bi bi-shield-lock fs-4"></i>
                    </div>
                    <i class="bi bi-arrow-up-right menu-arrow text-body-tertiary fs-6"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-body mb-1 fs-5">Manage Role</h6>
                    <small class="text-body-secondary d-block mb-2">Hak akses & kewenangan</small>
                    <p class="text-body-secondary small mb-0 fs-7">Tambah, ubah, atau atur peran hak akses pengguna (Admin, Petugas, Siswa).</p>
                </div>
            </a>
        </div>

        <!-- 3. Kategori Alat -->
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('kategori.index') }}" class="card custom-menu-card h-100 text-decoration-none border shadow-sm rounded-4 p-3">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="menu-icon-wrapper rounded-3 p-2.5 d-flex align-items-center justify-content-center">
                        <i class="bi bi-tags fs-4"></i>
                    </div>
                    <i class="bi bi-arrow-up-right menu-arrow text-body-tertiary fs-6"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-body mb-1 fs-5">Kategori Alat</h6>
                    <small class="text-body-secondary d-block mb-2">Pengelompokan barang</small>
                    <p class="text-body-secondary small mb-0 fs-7">Kelola grup dan kategori untuk mempermudah pemilahan barang inventaris.</p>
                </div>
            </a>
        </div>

        <!-- 4. Data Alat -->
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('alat.index') }}" class="card custom-menu-card h-100 text-decoration-none border shadow-sm rounded-4 p-3">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="menu-icon-wrapper rounded-3 p-2.5 d-flex align-items-center justify-content-center">
                        <i class="bi bi-box-seam fs-4"></i>
                    </div>
                    <i class="bi bi-arrow-up-right menu-arrow text-body-tertiary fs-6"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-body mb-1 fs-5">Data Alat</h6>
                    <small class="text-body-secondary d-block mb-2">Stok & spesifikasi alat</small>
                    <p class="text-body-secondary small mb-0 fs-7">Tambah item barang/alat baru, update jumlah stok, dan informasi kondisi alat.</p>
                </div>
            </a>
        </div>

        <!-- 5. Persetujuan Peminjaman -->
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('peminjaman.index') }}" class="card custom-menu-card h-100 text-decoration-none border shadow-sm rounded-4 p-3">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="menu-icon-wrapper rounded-3 p-2.5 d-flex align-items-center justify-content-center">
                        <i class="bi bi-card-checklist fs-4"></i>
                    </div>
                    <i class="bi bi-arrow-up-right menu-arrow text-body-tertiary fs-6"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-body mb-1 fs-5">Persetujuan Peminjaman</h6>
                    <small class="text-body-secondary d-block mb-2">Verifikasi pengajuan</small>
                    <p class="text-body-secondary small mb-0 fs-7">Proses persetujuan (Approve/Reject) pengajuan peminjaman alat dari siswa.</p>
                </div>
            </a>
        </div>

        <!-- 6. Data Pengembalian -->
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('pengembalian.index') }}" class="card custom-menu-card h-100 text-decoration-none border shadow-sm rounded-4 p-3">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="menu-icon-wrapper rounded-3 p-2.5 d-flex align-items-center justify-content-center">
                        <i class="bi bi-box-arrow-in-down-left fs-4"></i>
                    </div>
                    <i class="bi bi-arrow-up-right menu-arrow text-body-tertiary fs-6"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-body mb-1 fs-5">Data Pengembalian</h6>
                    <small class="text-body-secondary d-block mb-2">Pencatatan & denda</small>
                    <p class="text-body-secondary small mb-0 fs-7">Konfirmasi pengembalian barang, cek keterlambatan, dan pencatatan denda.</p>
                </div>
            </a>
        </div>

        <!-- 7. Database Backup -->
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 p-2 bg-body">
                <div class="card-body d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-danger-subtle text-danger p-3 rounded-3 fs-4">
                            <i class="bi bi-database-down"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0 fs-5 text-body">Database Backup</h6>
                            <small class="text-body-secondary">Ekspor cadangan data SQL sistem</small>
                        </div>
                    </div>
                    <a href="{{ route('admin.database.export') }}" class="btn btn-danger rounded-3 px-4 fw-semibold">
                        <i class="bi bi-download me-1"></i> Unduh Backup SQL
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    /* Styling Kartu Menu Bersih, Jelas di Dark/Light Mode, Bebas Warna Pelangi */
    .custom-menu-card {
        background-color: var(--bs-card-bg);
        border-color: var(--bs-border-color) !important;
        transition: all 0.2s ease-in-out;
    }

    .menu-icon-wrapper {
        background-color: var(--bs-tertiary-bg);
        color: var(--bs-body-color);
        width: 46px;
        height: 46px;
        transition: all 0.2s ease-in-out;
    }

    /* Efek Hover Lembut saat Disentuh Kursor */
    .custom-menu-card:hover {
        border-color: var(--bs-primary) !important;
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08) !important;
    }

    .custom-menu-card:hover .menu-icon-wrapper {
        background-color: var(--bs-primary);
        color: #ffffff;
    }

    .custom-menu-card:hover .menu-arrow {
        color: var(--bs-primary) !important;
        transform: translate(2px, -2px);
        transition: transform 0.2s ease;
    }

    .fs-7 {
        font-size: 0.8125rem;
        line-height: 1.4;
    }
</style>
@endsection