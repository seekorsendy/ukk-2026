@extends('layouts.app')

@section('title', config('app.name', 'SHEIN') . ' -- Dashboard Petugas')

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
    }

    /* Override Variabel saat Dark Mode Aktif */
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
    }

    body, #app, main {
        background-color: var(--theme-bg-body) !important;
        color: var(--theme-text-main) !important;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .admin-dashboard-fullwrapper {
        background-color: var(--theme-bg-body) !important;
        color: var(--theme-text-main) !important;
        min-height: 100vh;
        width: 100%;
        padding: 2rem 3rem;
        box-sizing: border-box;
        transition: background-color 0.3s ease;
    }

    /* Dynamic Glassmorphism Card */
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

    /* Kotak Ikon */
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

    .dashboard-title {
        color: var(--theme-text-main) !important;
        font-weight: 700;
    }

    .dashboard-text-muted {
        color: var(--theme-text-muted) !important;
    }

    .fs-8 {
        font-size: 0.8125rem;
    }
</style>

<div class="admin-dashboard-fullwrapper">

    <!-- 1. BANNER UTAMA -->
    <div class="lab-menu-card p-4 mb-4 text-white overflow-hidden" style="background: linear-gradient(135deg, #090d16 0%, #1e293b 100%) !important; border-left: 4px solid var(--theme-cyan-bright) !important;">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <span class="badge rounded-pill px-3 py-1.5 mb-2 fw-bold shadow-sm" style="background: var(--theme-cyan-subtle); color: var(--theme-cyan); border: 1px solid var(--theme-card-border);">
                    <i class="bi bi-shield-check me-1"></i> Panel Petugas Operasional
                </span>
                <h3 class="fw-bold mb-1 text-white">Selamat Datang, {{ $user->username ?? 'Petugas' }}! 👋</h3>
                <p class="mb-0 text-white-50 small" style="max-width: 600px;">
                    Pusat kendali operasional peminjaman lab SHEIN. Pantau antrean verifikasi, status barang dipinjam, dan cetak laporan rekapitulasi.
                </p>
            </div>
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <a href="{{ route('petugas.pengembalian.cetak') }}" target="_blank" class="btn btn-outline-light rounded-pill px-4 py-2 fw-semibold small d-inline-flex align-items-center gap-2">
                    <i class="bi bi-printer"></i> Cetak Laporan
                </a>
            </div>
        </div>
    </div>

    <!-- 2. RINGKASAN STATISTIK -->
    <div class="row g-3 mb-4">
        <!-- Menunggu Verifikasi -->
        <div class="col-6 col-md-4">
            <div class="lab-menu-card p-3 flex-row align-items-center gap-3 h-100">
                <div class="icon-box-feature">
                    <i class="bi bi-hourglass-split"></i>
                </div>
                <div>
                    <span class="text-uppercase fw-semibold dashboard-text-muted d-block fs-8 mb-1">Menunggu Verifikasi</span>
                    <h4 class="fw-bold mb-0 dashboard-title">{{ $totalPending ?? 0 }}</h4>
                </div>
            </div>
        </div>

        <!-- Barang Dipinjam -->
        <div class="col-6 col-md-4">
            <div class="lab-menu-card p-3 flex-row align-items-center gap-3 h-100">
                <div class="icon-box-feature">
                    <i class="bi bi-box-seam-fill"></i>
                </div>
                <div>
                    <span class="text-uppercase fw-semibold dashboard-text-muted d-block fs-8 mb-1">Barang Dipinjam</span>
                    <h4 class="fw-bold mb-0 dashboard-title">{{ $totalDipinjam ?? 0 }}</h4>
                </div>
            </div>
        </div>

        <!-- Total Selesai -->
        <div class="col-12 col-md-4">
            <div class="lab-menu-card p-3 flex-row align-items-center gap-3 h-100">
                <div class="icon-box-feature">
                    <i class="bi bi-database-check"></i>
                </div>
                <div>
                    <span class="text-uppercase fw-semibold dashboard-text-muted d-block fs-8 mb-1">Total Selesai</span>
                    <h4 class="fw-bold mb-0 dashboard-title">{{ $totalSelesai ?? 0 }}</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. MENU AKSES CEPAT -->
    <h5 class="fw-bold mb-3 dashboard-title"><i class="bi bi-grid-fill me-2" style="color: var(--theme-cyan);"></i>Menu Akses Cepat</h5>

    <div class="row g-3 mb-4">
        <!-- Persetujuan Peminjaman -->
        <div class="col-md-6">
            <a href="{{ route('petugas.peminjaman.index') }}" class="lab-menu-card p-4">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="icon-box-feature">
                        <i class="bi bi-check-circle fs-4"></i>
                    </div>
                    <div class="card-arrow-icon rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: var(--theme-icon-bg); color: var(--theme-text-muted);">
                        <i class="bi bi-arrow-up-right"></i>
                    </div>
                </div>
                <div>
                    <h6 class="fw-bold dashboard-title mb-1 fs-5">Persetujuan Peminjaman</h6>
                    <small class="d-block mb-2 fw-medium" style="color: var(--theme-cyan);">Verifikasi pengajuan siswa</small>
                    <p class="dashboard-text-muted small mb-0 fs-8">Proses persetujuan atau penolakan pengajuan peminjaman alat laboratorium dari siswa.</p>
                </div>
            </a>
        </div>

        <!-- Pantau Pengembalian -->
        <div class="col-md-6">
            <a href="{{ route('petugas.pengembalian.index') }}" class="lab-menu-card p-4">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="icon-box-feature">
                        <i class="bi bi-arrow-return-left fs-4"></i>
                    </div>
                    <div class="card-arrow-icon rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: var(--theme-icon-bg); color: var(--theme-text-muted);">
                        <i class="bi bi-arrow-up-right"></i>
                    </div>
                </div>
                <div>
                    <h6 class="fw-bold dashboard-title mb-1 fs-5">Pantau Pengembalian</h6>
                    <small class="d-block mb-2 fw-medium" style="color: var(--theme-cyan);">Pencatatan barang & denda</small>
                    <p class="dashboard-text-muted small mb-0 fs-8">Konfirmasi pengembalian alat, periksa tenggat waktu, dan kalkulasi denda keterlambatan.</p>
                </div>
            </a>
        </div>
    </div>

</div>
@endsection