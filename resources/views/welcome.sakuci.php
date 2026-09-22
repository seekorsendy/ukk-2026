@extends('layouts.app')

@section('title', config('app.name') . ' -- Dashboard Peminjaman Alat')

@section('content')

    <!-- Styling Tambahan untuk Dashboard Kaya Fitur -->
    <style>
        :root {
            --app-bg: #f8fafc;
            --surface-bg: #ffffff;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --primary: #4f46e5;
        }

        [data-bs-theme="dark"], .dark-mode, body.dark-mode {
            --app-bg: #030712;
            --surface-bg: #0f172a;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --border-color: #1e293b;
            --primary: #6366f1;
        }

        .dashboard-wrapper {
            background-color: var(--app-bg);
            color: var(--text-main);
            min-height: 90vh;
            padding: 2rem 1.5rem;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .dash-card {
            background-color: var(--surface-bg) !important;
            border: 1px solid var(--border-color) !important;
            color: var(--text-main) !important;
            border-radius: 1rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px -1px rgba(0, 0, 0, 0.05);
            transition: all 0.2s ease-in-out;
        }

        .dash-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.08);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
        }

        .table-custom {
            color: var(--text-main) !important;
            background-color: transparent !important;
        }
        .table-custom th, .table-custom td {
            background-color: transparent !important;
            color: var(--text-main) !important;
            border-color: var(--border-color) !important;
            vertical-align: middle;
        }
    </style>

    <div class="container-fluid dashboard-wrapper">
        
        <!-- Top Welcome Bar -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 pb-3 border-bottom border-secondary border-opacity-10 gap-3">
            <div>
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-2" style="background: rgba(79, 70, 229, 0.1); color: var(--primary); font-size: 0.8rem; font-weight: 600;">
                    <span class="rounded-circle bg-success" style="width: 6px; height: 6px;"></span>
                    <span>SMk SANGKURIANG 1 CIMAHI &bull; Lab Management System</span>
                </div>
                <h1 class="h3 fw-bold mb-1 tracking-tight">Dashboard Overview</h1>
                <p class="text-muted small mb-0">Selamat datang kembali! Berikut ringkasan data inventaris dan aktivitas lab.</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('alat.index') }}" class="btn btn-sm btn-primary px-3 py-2 rounded-pill fw-semibold shadow-sm" style="background-color: var(--primary); border: none;">
                    <i class="bi bi-plus-lg me-1"></i> Kelola Alat Baru
                </a>
            </div>
        </div>

        <!-- 4 Kotak Statistik (KPI Metrics) -->
        <div class="row g-3 mb-4">
            
            <!-- Statistik 1: Total Alat -->
            <div class="col-sm-6 col-xl-3">
                <div class="dash-card p-3 p-xl-4 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small text-uppercase fw-semibold tracking-wide" style="font-size: 0.75rem;">Total Alat Lab</span>
                        <h3 class="fw-bold fs-2 mb-0 mt-1">128</h3>
                        <span class="text-success small fw-medium"><i class="bi bi-arrow-up-short"></i> +4 unit bulan ini</span>
                    </div>
                    <div class="stat-icon" style="background-color: rgba(79, 70, 229, 0.1); color: #4f46e5;">
                        <i class="bi bi-box-seam fs-4"></i>
                    </div>
                </div>
            </div>

            <!-- Statistik 2: Alat Dipinjam -->
            <div class="col-sm-6 col-xl-3">
                <div class="dash-card p-3 p-xl-4 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small text-uppercase fw-semibold tracking-wide" style="font-size: 0.75rem;">Sedang Dipinjam</span>
                        <h3 class="fw-bold fs-2 mb-0 mt-1">14</h3>
                        <span class="text-warning small fw-medium"><i class="bi bi-clock-history"></i> Aktif praktikum</span>
                    </div>
                    <div class="stat-icon" style="background-color: rgba(245, 158, 11, 0.1); color: #f59e0b;">
                        <i class="bi bi-journal-arrow-up fs-4"></i>
                    </div>
                </div>
            </div>

            <!-- Statistik 3: Alat Tersedia -->
            <div class="col-sm-6 col-xl-3">
                <div class="dash-card p-3 p-xl-4 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small text-uppercase fw-semibold tracking-wide" style="font-size: 0.75rem;">Stok Tersedia</span>
                        <h3 class="fw-bold fs-2 mb-0 mt-1">114</h3>
                        <span class="text-success small fw-medium"><i class="bi bi-check-circle"></i> Siap dipinjam</span>
                    </div>
                    <div class="stat-icon" style="background-color: rgba(16, 185, 129, 0.1); color: #10b981;">
                        <i class="bi bi-check2-all fs-4"></i>
                    </div>
                </div>
            </div>

            <!-- Statistik 4: Kategori Lab -->
            <div class="col-sm-6 col-xl-3">
                <div class="dash-card p-3 p-xl-4 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small text-uppercase fw-semibold tracking-wide" style="font-size: 0.75rem;">Total Kategori</span>
                        <h3 class="fw-bold fs-2 mb-0 mt-1">8</h3>
                        <span class="text-info small fw-medium"><i class="bi bi-grid-3x3"></i> Bidang keahlian</span>
                    </div>
                    <div class="stat-icon" style="background-color: rgba(2, 132, 199, 0.1); color: #0284c7;">
                        <i class="bi bi-tags fs-4"></i>
                    </div>
                </div>
            </div>

        </div>

        <!-- Grid Menu Pintasan Utama (2 Kartu Besar) -->
        <div class="row g-4 mb-4">
            
            <!-- Card 1 -->
            <div class="col-lg-6">
                <div class="dash-card p-4 h-100 d-flex flex-column justify-content-between position-relative overflow-hidden">
                    <div class="position-absolute top-0 start-0 h-100" style="width: 4px; background-color: #4f46e5;"></div>
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0">Direktori Alat Laboratorium</h5>
                            <span class="badge bg-indigo-subtle text-primary px-2.5 py-1 rounded-pill" style="background: rgba(79, 70, 229, 0.1); color: #4f46e5; font-size: 0.75rem;">Inventaris</span>
                        </div>
                        <p class="text-muted small mb-4">
                            Akses daftar lengkap inventaris alat, cek spesifikasi teknis, ubah status kondisi alat, atau tambahkan inventaris baru ke dalam sistem.
                        </p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('alat.index') }}" class="btn btn-sm btn-primary px-4 py-2 rounded-pill fw-semibold shadow-sm w-100" style="background-color: #4f46e5; border: none;">
                            <i class="bi bi-box-seam me-1"></i> Buka Daftar Alat
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-lg-6">
                <div class="dash-card p-4 h-100 d-flex flex-column justify-content-between position-relative overflow-hidden">
                    <div class="position-absolute top-0 start-0 h-100" style="width: 4px; background-color: #0284c7;"></div>
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0">Klasifikasi Kategori Lab</h5>
                            <span class="badge px-2.5 py-1 rounded-pill" style="background: rgba(2, 132, 199, 0.1); color: #0284c7; font-size: 0.75rem;">Struktur Lab</span>
                        </div>
                        <p class="text-muted small mb-4">
                            Kelola pengelompokan alat berdasarkan kategori bidang praktikum untuk mempermudah siswa dan guru dalam mencari perangkat yang dibutuhkan.
                        </p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('kategori.index') }}" class="btn btn-sm btn-info px-4 py-2 rounded-pill fw-semibold text-white shadow-sm w-100" style="background-color: #0284c7; border: none;">
                            <i class="bi bi-grid-3x3-gap me-1"></i> Kelola Kategori
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Tabel Aktivitas Peminjaman Terbaru (Fitur Tambahan agar Ramai) -->
        <div class="dash-card p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="fw-bold mb-1">Aktivitas Peminjaman Terakhir</h5>
                    <p class="text-muted small mb-0">Daftar pengajuan peminjaman alat terbaru dari siswa/praktikan.</p>
                </div>
                <span class="badge bg-secondary bg-opacity-10 text-muted px-3 py-1.5 rounded-pill small">Real-time Log</span>
            </div>

            <div class="table-responsive">
                <table class="table table-custom align-middle mb-0">
                    <thead>
                        <tr class="text-muted small text-uppercase">
                            <th>No</th>
                            <th>Nama Peminjam</th>
                            <th>Nama Alat</th>
                            <th>Tanggal Pinjam</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="fw-semibold">1</td>
                            <td>Ahmad Fauzan (XII TKJ)</td>
                            <td>Multimeter Digital Fluke</td>
                            <td>21 Sep 2026</td>
                            <td><span class="badge bg-warning bg-opacity-10 text-warning px-3 py-1 rounded-pill">Dipinjam</span></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">2</td>
                            <td>Siti Rahma (XI RPL)</td>
                            <td>Solder Station Adjustable</td>
                            <td>20 Sep 2026</td>
                            <td><span class="badge bg-success bg-opacity-10 text-success px-3 py-1 rounded-pill">Dikembalikan</span></td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">3</td>
                            <td>Budi Santoso (XII TSM)</td>
                            <td>Kunci Momen Set Tekiro</td>
                            <td>19 Sep 2026</td>
                            <td><span class="badge bg-success bg-opacity-10 text-success px-3 py-1 rounded-pill">Dikembalikan</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection