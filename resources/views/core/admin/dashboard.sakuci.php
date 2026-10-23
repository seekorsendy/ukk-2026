@extends('layouts.app')

@section('title', 'Admin Dashboard - InventarisHub')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    /* Dynamic Theme Variables (Light & Dark Mode) */
    :root {
        --theme-cyan: #0891b2;
        --theme-cyan-bright: #06b6d4;
        --theme-cyan-subtle: rgba(6, 182, 212, 0.12);
        --theme-bg-body: #f8fafc;
        --theme-card-bg: #ffffff;
        --theme-card-border: rgba(0, 0, 0, 0.08);
        --theme-text-main: #0f172a;
        --theme-text-muted: #64748b;
        --theme-icon-bg: #f1f5f9;
        --theme-arrow-bg: #e2e8f0;
    }

    /* Override Variabel saat Dark Mode Aktif (Mendukung data-bs-theme="dark" atau class .dark) */
    [data-bs-theme="dark"], .dark {
        --theme-cyan: #38bdf8;
        --theme-cyan-bright: #06b6d4;
        --theme-cyan-subtle: rgba(6, 182, 212, 0.18);
        --theme-bg-body: #090d16;
        --theme-card-bg: rgba(15, 23, 42, 0.95);
        --theme-card-border: rgba(56, 189, 248, 0.18);
        --theme-text-main: #ffffff;
        --theme-text-muted: #94a3b8;
        --theme-icon-bg: #0c2233;
        --theme-arrow-bg: #1a2436;
    }

    body, #app, main {
        background-color: var(--theme-bg-body) !important;
        color: var(--theme-text-main) !important;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    /* Pembungkus Full Lebar */
    .admin-dashboard-fullwrapper {
        background-color: var(--theme-bg-body) !important;
        color: var(--theme-text-main) !important;
        min-height: 100vh;
        width: 100%;
        padding: 2rem 3rem;
        box-sizing: border-box;
        transition: background-color 0.3s ease;
    }

    /* Kartu Menu Utama (Dynamic Glassmorphism) */
    .lab-menu-card {
        background: var(--theme-card-bg) !important;
        border: 1px solid var(--theme-card-border) !important;
        border-radius: 1.25rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        text-decoration: none !important;
    }

    .lab-menu-card:hover {
        transform: translateY(-5px);
        border-color: rgba(56, 189, 248, 0.35) !important;
        box-shadow: 0 16px 35px rgba(6, 182, 212, 0.18) !important;
    }

    /* Kotak Ikon Kiri Atas */
    .icon-box-feature {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        background: var(--theme-icon-bg) !important;
        color: var(--theme-cyan) !important;
        border: 1px solid var(--theme-card-border);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
    }

    /* Lingkaran Panah Kanan Atas */
    .card-arrow-icon {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: var(--theme-arrow-bg);
        color: var(--theme-text-muted);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        transition: all 0.25s ease;
    }

    .lab-menu-card:hover .card-arrow-icon {
        background: var(--theme-cyan-bright);
        color: #ffffff;
        transform: translate(2px, -2px);
    }

    /* Teks Judul, Sub-judul & Deskripsi */
    .dashboard-title {
        color: var(--theme-text-main) !important;
        font-weight: 700;
        font-size: 1.35rem;
    }

    .dashboard-subtitle {
        color: var(--theme-cyan) !important;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .dashboard-text-muted {
        color: var(--theme-text-muted) !important;
        font-size: 0.9rem;
        line-height: 1.5;
    }

    /* Indikator Pulse Status */
    .pulse-dot {
        width: 8px;
        height: 8px;
        background-color: #10b981;
        border-radius: 50%;
        box-shadow: 0 0 10px #10b981;
        display: inline-block;
        animation: pulseGlow 1.8s infinite;
    }

    @keyframes pulseGlow {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.4); opacity: 0.5; }
    }
</style>

<div class="admin-dashboard-fullwrapper">
    
    <!-- Banner Selamat Datang Admin -->
    <div class="lab-menu-card p-4 mb-4" style="border-left: 4px solid var(--theme-cyan-bright) !important;">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <div class="d-inline-flex align-items-center px-3 py-1 rounded-pill small mb-2" style="background: var(--theme-cyan-subtle); color: var(--theme-cyan); border: 1px solid var(--theme-card-border);">
                    <i class="bi bi-shield-lock-fill me-1"></i> Area Administrator
                </div>
                <h1 class="h4 fw-bold mb-1 dashboard-title">Halo, {{ $user->username ?? 'Admin' }}! 👋</h1>
                <p class="mb-0 small dashboard-text-muted" style="max-width: 700px;">
                    Anda masuk dengan hak akses penuh (<code style="color: var(--theme-cyan);">admin</code>). Gunakan menu di bawah untuk mengelola sistem, user, inventaris alat, dan basis data laboratorium.
                </p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="d-flex align-items-center gap-2 px-3 py-2 rounded-pill" style="background: rgba(16, 185, 129, 0.12); border: 1px solid rgba(16, 185, 129, 0.25);">
                    <span class="pulse-dot"></span>
                    <span class="small fw-medium" style="color: #34d399;">Sistem Lab Aktif</span>
                </div>
            </div>
        </div>
    </div>

    <!-- STATISTIK RINGKAS REAL-TIME -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="lab-menu-card p-3 flex-row align-items-center gap-3">
                <div class="icon-box-feature">
                    <i class="bi bi-boxes"></i>
                </div>
                <div>
                    <span class="small d-block dashboard-text-muted" style="font-size: 0.78rem;">Total Alat Lab</span>
                    <h5 class="fw-bold dashboard-title mb-0">{{ $totalAlat ?? 0 }}</h5>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="lab-menu-card p-3 flex-row align-items-center gap-3">
                <div class="icon-box-feature">
                    <i class="bi bi-journal-check"></i>
                </div>
                <div>
                    <span class="small d-block dashboard-text-muted" style="font-size: 0.78rem;">Peminjaman Aktif</span>
                    <h5 class="fw-bold dashboard-title mb-0">{{ $peminjamanAktif ?? 0 }}</h5>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="lab-menu-card p-3 flex-row align-items-center gap-3">
                <div class="icon-box-feature">
                    <i class="bi bi-people"></i>
                </div>
                <div>
                    <span class="small d-block dashboard-text-muted" style="font-size: 0.78rem;">Total Pengguna</span>
                    <h5 class="fw-bold dashboard-title mb-0">{{ $totalUser ?? 0 }}</h5>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="lab-menu-card p-3 flex-row align-items-center gap-3">
                <div class="icon-box-feature">
                    <i class="bi bi-tags"></i>
                </div>
                <div>
                    <span class="small d-block dashboard-text-muted" style="font-size: 0.78rem;">Total Kategori</span>
                    <h5 class="fw-bold dashboard-title mb-0">{{ $totalKategori ?? 0 }}</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- 6 KARTU UTAMA -->
    <div class="row g-4 mb-4">
        
        <!-- 1. Manage User -->
        <div class="col-md-4">
            <a href="{{ route('admin.users.index') }}" class="lab-menu-card p-4">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="icon-box-feature">
                            <i class="bi bi-person-gear"></i>
                        </div>
                        <div class="card-arrow-icon">
                            <i class="bi bi-arrow-up-right"></i>
                        </div>
                    </div>
                    <h2 class="dashboard-title mb-1">Manage User</h2>
                    <div class="dashboard-subtitle mb-2">Kelola Akun Pengguna</div>
                    <p class="mb-0 dashboard-text-muted">Pengaturan pendaftaran akun baru, reset password, dan daftar pengguna terdaftar.</p>
                </div>
            </a>
        </div>

        <!-- 2. Manage Role -->
        <div class="col-md-4">
            <a href="{{ route('admin.roles.index') }}" class="lab-menu-card p-4">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="icon-box-feature">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <div class="card-arrow-icon">
                            <i class="bi bi-arrow-up-right"></i>
                        </div>
                    </div>
                    <h2 class="dashboard-title mb-1">Manage Role</h2>
                    <div class="dashboard-subtitle mb-2">Hak Akses & Kewenangan</div>
                    <p class="mb-0 dashboard-text-muted">Tambah, ubah, atau atur peran hak akses pengguna (Admin, Petugas, Siswa).</p>
                </div>
            </a>
        </div>

        <!-- 3. Kategori Alat -->
        <div class="col-md-4">
            <a href="{{ route('kategori.index') }}" class="lab-menu-card p-4">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="icon-box-feature">
                            <i class="bi bi-tags"></i>
                        </div>
                        <div class="card-arrow-icon">
                            <i class="bi bi-arrow-up-right"></i>
                        </div>
                    </div>
                    <h2 class="dashboard-title mb-1">Kategori Alat</h2>
                    <div class="dashboard-subtitle mb-2">Pengelompokan Barang</div>
                    <p class="mb-0 dashboard-text-muted">Kelola grup dan kategori untuk mempermudah pemilahan barang inventaris.</p>
                </div>
            </a>
        </div>

        <!-- 4. Data Alat -->
        <div class="col-md-4">
            <a href="{{ route('alat.index') }}" class="lab-menu-card p-4">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="icon-box-feature">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <div class="card-arrow-icon">
                            <i class="bi bi-arrow-up-right"></i>
                        </div>
                    </div>
                    <h2 class="dashboard-title mb-1">Data Alat</h2>
                    <div class="dashboard-subtitle mb-2">Stok & Spesifikasi Alat</div>
                    <p class="mb-0 dashboard-text-muted">Tambah item barang/alat baru, update jumlah stok, dan informasi kondisi alat.</p>
                </div>
            </a>
        </div>

        <!-- 5. Persetujuan Peminjaman -->
        <div class="col-md-4">
            <a href="{{ route('peminjaman.index') }}" class="lab-menu-card p-4">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="icon-box-feature">
                            <i class="bi bi-card-checklist"></i>
                        </div>
                        <div class="card-arrow-icon">
                            <i class="bi bi-arrow-up-right"></i>
                        </div>
                    </div>
                    <h2 class="dashboard-title mb-1">Persetujuan Peminjaman</h2>
                    <div class="dashboard-subtitle mb-2">Verifikasi Pengajuan</div>
                    <p class="mb-0 dashboard-text-muted">Proses persetujuan (Approve/Reject) pengajuan peminjaman alat dari siswa.</p>
                </div>
            </a>
        </div>

        <!-- 6. Data Pengembalian -->
        <div class="col-md-4">
            <a href="{{ route('pengembalian.index') }}" class="lab-menu-card p-4">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="icon-box-feature">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </div>
                        <div class="card-arrow-icon">
                            <i class="bi bi-arrow-up-right"></i>
                        </div>
                    </div>
                    <h2 class="dashboard-title mb-1">Data Pengembalian</h2>
                    <div class="dashboard-subtitle mb-2">Pencatatan & Denda</div>
                    <p class="mb-0 dashboard-text-muted">Konfirmasi pengembalian barang, cek keterlambatan, dan pencatatan denda.</p>
                </div>
            </a>
        </div>

    </div>

    <!-- BANNER BACKUP DATABASE -->
    <div class="lab-menu-card p-4 border-top border-3" style="border-top-color: var(--theme-cyan-bright) !important;">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-box-feature flex-shrink-0">
                    <i class="bi bi-database-down"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-1 dashboard-title" style="font-size: 1.15rem;">Pemeliharaan & Backup Database</h5>
                    <p class="small mb-0 dashboard-text-muted">Unduh file cadangan basis data (.sql) secara berkala untuk menjaga keamanan data inventaris.</p>
                </div>
            </div>
            <a href="{{ route('admin.database.export') }}" class="btn fw-semibold px-4 py-2.5 rounded-pill d-flex align-items-center gap-2 text-white shadow-sm" style="background: linear-gradient(135deg, #06b6d4 0%, #3b82f6 50%, #8b5cf6 100%); border: none;">
                <i class="bi bi-download"></i> Unduh File .SQL
            </a>
        </div>
    </div>

</div>
@endsection