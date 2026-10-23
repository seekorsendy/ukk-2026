@extends('layouts.app')

@section('title', config('app.name', 'SHEIN') . ' -- Daftar Alat')

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
        --theme-table-hover: rgba(6, 182, 212, 0.04);
        --theme-btn-sec-bg: #f1f5f9;
        --theme-btn-sec-border: #cbd5e1;
        --theme-btn-sec-text: #334155;
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
        --theme-table-hover: rgba(6, 182, 212, 0.08);
        --theme-btn-sec-bg: rgba(255, 255, 255, 0.05);
        --theme-btn-sec-border: rgba(255, 255, 255, 0.15);
        --theme-btn-sec-text: #e2e8f0;
    }

    body, #app, main {
        background-color: var(--theme-bg-body) !important;
        color: var(--theme-text-main) !important;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    /* Full-Width Wrapper */
    .admin-dashboard-fullwrapper {
        background-color: var(--theme-bg-body) !important;
        color: var(--theme-text-main) !important;
        min-height: 100vh;
        width: 100% !important;
        padding: 2rem 3rem;
        box-sizing: border-box;
        transition: background-color 0.3s ease;
    }

    /* Brand Box Atas */
    .brand-icon-box {
        width: 48px;
        height: 48px;
        background: var(--theme-cyan-subtle);
        border: 1px solid var(--theme-card-border);
        color: var(--theme-cyan);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    /* Top Stats Cards */
    .stat-card-item {
        background: var(--theme-card-bg);
        border: 1px solid var(--theme-card-border);
        border-radius: 16px;
        padding: 16px 20px;
        transition: all 0.2s ease;
    }

    .stat-card-item:hover {
        border-color: var(--theme-cyan);
        transform: translateY(-2px);
    }

    .stat-icon-box {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        background: var(--theme-cyan-subtle);
        color: var(--theme-cyan);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    /* Form Search Box & Buttons Atas */
    .search-input-group .input-group-text {
        background: var(--theme-btn-sec-bg);
        border-color: var(--theme-btn-sec-border);
        color: var(--theme-text-muted);
    }

    .search-input-group .form-control {
        background: var(--theme-btn-sec-bg);
        border-color: var(--theme-btn-sec-border);
        color: var(--theme-text-main);
    }

    .search-input-group .form-control:focus {
        border-color: var(--theme-cyan);
        box-shadow: none;
    }

    .btn-neon-cyan {
        background: linear-gradient(135deg, #06b6d4 0%, #3b82f6 50%, #8b5cf6 100%) !important;
        border: none !important;
        color: #ffffff !important;
        font-weight: 600 !important;
        box-shadow: 0 4px 15px rgba(6, 182, 212, 0.25);
    }

    .btn-neon-cyan:hover {
        opacity: 0.95;
        transform: translateY(-1px);
    }

    .btn-icon-refresh {
        background: var(--theme-btn-sec-bg);
        border: 1px solid var(--theme-btn-sec-border);
        color: var(--theme-btn-sec-text);
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        transition: all 0.2s ease;
    }

    .btn-icon-refresh:hover {
        background: var(--theme-cyan-subtle);
        color: var(--theme-cyan);
        border-color: var(--theme-cyan);
    }

    /* Glassmorphism Table Card */
    .lab-glass-card {
        background: var(--theme-card-bg) !important;
        border: 1px solid var(--theme-card-border) !important;
        border-radius: 1.25rem !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .table {
        color: var(--theme-text-main) !important;
        border-color: var(--theme-card-border) !important;
    }

    .table > thead > tr > th {
        background-color: var(--theme-cyan-subtle) !important;
        color: var(--theme-text-main) !important;
        border-bottom: 1px solid var(--theme-card-border) !important;
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 700;
    }

    .table td {
        vertical-align: middle;
        border-color: var(--theme-card-border) !important;
        color: var(--theme-text-main) !important;
    }

    .table-hover tbody tr:hover {
        background-color: var(--theme-table-hover) !important;
    }

    .link-neon-cyan {
        color: var(--theme-cyan);
        transition: color 0.2s ease;
    }
    .link-neon-cyan:hover {
        color: var(--theme-cyan-bright);
    }
</style>

<div class="admin-dashboard-fullwrapper">
    
    <!-- 1. HEADER UTAMA + SEARCH FORM + REFRESH ICON + TOMBOL TAMBAH -->
    <div class="d-flex flex-column flex-xl-row align-items-start align-items-xl-center justify-content-between mb-4 gap-3">
        <!-- Judul & Icon -->
        <div class="d-flex align-items-center gap-3">
            <div class="brand-icon-box shadow-sm">
                <i class="bi bi-box-seam-fill"></i>
            </div>
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1 small">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none link-neon-cyan">Dashboard</a></li>
                        <li class="breadcrumb-item active fw-semibold" aria-current="page" style="color: var(--theme-text-main);">Inventaris Alat</li>
                    </ol>
                </nav>
                <h2 class="fw-bold mb-0" style="color: var(--theme-text-main);">Daftar Alat Inventaris</h2>
                <p class="small mb-0" style="color: var(--theme-text-muted);">Kelola data alat, pantau kode inventaris, dan kategorisasi dengan lengkap.</p>
            </div>
        </div>

        <!-- Bagian Kanan: Search Form, Tombol Refresh, & Tombol Tambah -->
        <div class="d-flex align-items-center gap-2 flex-wrap w-100 w-xl-auto justify-content-end">
            <!-- Search Bar Form (Tekan Enter atau klik Icon Kaca Pembesar untuk mencari) -->
            <form action="{{ route('alat.index') }}" method="GET" class="search-input-group input-group m-0" style="max-width: 280px;">
                <button type="submit" class="input-group-text rounded-start-3 border-end-0 btn btn-link p-0 px-3 text-secondary text-decoration-none" title="Cari">
                    <i class="bi bi-search"></i>
                </button>
                <input type="text" name="search" class="form-control rounded-end-3 border-start-0 fs-7" 
                       placeholder="Cari nama atau kode alat..." 
                       value="{{ request('search') }}">
            </form>

            <!-- Tombol Refresh (Ikon Saja) -->
            <a href="{{ route('alat.index') }}" class="btn-icon-refresh shadow-sm" title="Refresh / Muat Ulang">
                <i class="bi bi-arrow-clockwise fs-5"></i>
            </a>

            <!-- Tombol Tambah Alat Baru -->
            <a href="{{ route('alat.create') }}" class="btn btn-neon-cyan px-4 py-2 rounded-3 d-inline-flex align-items-center gap-2 fw-semibold shadow-sm flex-shrink-0">
                <i class="bi bi-plus-circle-fill"></i>
                <span>Tambah Alat Baru</span>
            </a>
        </div>
    </div>

    <!-- 2. KARTU STATISTIK RINGKAS -->
    <div class="row g-3 mb-4">
        <!-- Kartu 1: Total Alat -->
        <div class="col-md-4">
            <div class="stat-card-item d-flex align-items-center gap-3">
                <div class="stat-icon-box">
                    <i class="bi bi-cpu-fill"></i>
                </div>
                <div>
                    <span class="d-block small fw-medium" style="color: var(--theme-text-muted);">Total Seluruh Alat</span>
                    <h4 class="fw-bold mb-0" style="color: var(--theme-text-main);">
                        {{ is_countable($datal) ? count($datal) : (method_exists($datal, 'total') ? $datal->total() : 0) }} 
                        <span class="fs-6 fw-semibold text-secondary">Unit/Data</span>
                    </h4>
                </div>
            </div>
        </div>

        <!-- Kartu 2: Total Kategori -->
        <div class="col-md-4">
            <div class="stat-card-item d-flex align-items-center gap-3">
                <div class="stat-icon-box">
                    <i class="bi bi-tag-fill"></i>
                </div>
                <div>
                    <span class="d-block small fw-medium" style="color: var(--theme-text-muted);">Total Kategori Aktif</span>
                    <h4 class="fw-bold mb-0" style="color: var(--theme-text-main);">
                        {{ is_countable($kategori) ? count($kategori) : 0 }} 
                        <span class="fs-6 fw-semibold text-secondary">Kategori</span>
                    </h4>
                </div>
            </div>
        </div>

        <!-- Kartu 3: Status Layanan -->
        <div class="col-md-4">
            <div class="stat-card-item d-flex align-items-center gap-3">
                <div class="stat-icon-box" style="color: var(--theme-cyan);">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div>
                    <span class="d-block small fw-medium" style="color: var(--theme-text-muted);">Status Layanan</span>
                    <h4 class="fw-bold mb-0" style="color: var(--theme-cyan);">
                        Aktif & Terbuka
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. TABEL DATA INVENTARIS ALAT -->
    <div class="card lab-glass-card border-0 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="py-3 px-4 text-center" style="width: 5%;">No</th>
                            <th class="py-3 px-3">Nama Alat</th>
                            <th class="py-3 px-3">Kode Alat</th>
                            <th class="py-3 px-3">Kategori</th>
                            <th class="py-3 px-4 text-center" style="width: 220px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @forelse ($datal as $alats)
                        <tr>
                            <td class="px-4 text-center fw-medium" style="color: var(--theme-text-muted);">{{ $no++ }}</td>
                            <td class="px-3">
                                <div class="fw-semibold" style="color: var(--theme-text-main);">{{ $alats->nama_alat }}</div>
                            </td>
                            <td class="px-3">
                                <span class="badge font-monospace fw-semibold px-2.5 py-1.5 rounded-2" style="background: var(--theme-cyan-subtle); color: var(--theme-cyan); border: 1px solid var(--theme-card-border);">
                                    {{ $alats->kode_alat }}
                                </span>
                            </td>
                            <td class="px-3">
                                @php
                                    $namaKategori = '-';
                                    foreach ($kategori as $k) {
                                        if ($k->id_kategori == $alats->id_kategori) {
                                            $namaKategori = $k->nama_kategori;
                                            break;
                                        }
                                    }
                                @endphp
                                <span class="badge fw-semibold px-2.5 py-1.5 rounded-2" style="background: var(--theme-cyan-subtle); color: var(--theme-cyan); border: 1px solid var(--theme-card-border);">
                                    {{ $namaKategori }}
                                </span>
                            </td>
                            <td class="px-4 text-center">
                                <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('alat.edit', ['alat' => $alats->id_alat]) }}" 
                                       class="btn btn-sm px-3 py-1.5 rounded-3 d-inline-flex align-items-center gap-1.5 shadow-sm" 
                                       style="background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%) !important; border: none !important; color: #ffffff !important; font-weight: 600 !important;">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('alat.delete', ['id' => $alats->id_alat]) }}" method="POST" class="d-inline m-0">
                                        @csrf
                                        @method('post')
                                        <button type="submit" 
                                                class="btn btn-sm px-3 py-1.5 rounded-3 d-inline-flex align-items-center gap-1.5 shadow-sm" 
                                                style="background: linear-gradient(135deg, #f43f5e 0%, #be123c 100%) !important; border: none !important; color: #ffffff !important; font-weight: 600 !important;" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus alat ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5" style="color: var(--theme-text-muted);">
                                <div class="d-flex flex-column align-items-center gap-2">
                                    <i class="bi bi-inbox fs-1 opacity-50"></i>
                                    <span>Belum ada data alat yang ditambahkan.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination -->
        @if(method_exists($datal, 'hasPages') && $datal->hasPages())
        <div class="card-footer bg-transparent py-3 px-4 border-top d-flex justify-content-end" style="border-color: var(--theme-card-border) !important;">
            {!! $datal->links() !!}
        </div>
        @endif
    </div>

</div>
@endsection