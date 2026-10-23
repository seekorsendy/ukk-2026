@extends('layouts.app')

@section('title', config('app.name', 'SHEIN') . ' -- Pantau Pengembalian')

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
        --theme-table-hover: rgba(56, 189, 248, 0.06);
        --theme-btn-sec-bg: rgba(255, 255, 255, 0.05);
        --theme-btn-sec-border: rgba(255, 255, 255, 0.15);
        --theme-btn-sec-text: #e2e8f0;
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
    .lab-table-card {
        background: var(--theme-card-bg) !important;
        border: 1px solid var(--theme-card-border) !important;
        border-radius: 1.25rem !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    /* Custom Table Styling */
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

    .table > tbody > tr > td {
        border-bottom: 1px solid var(--theme-card-border) !important;
        color: var(--theme-text-main) !important;
    }

    .table-hover > tbody > tr:hover > * {
        background-color: var(--theme-table-hover) !important;
        color: var(--theme-text-main) !important;
    }

    /* Buttons & Badges */
    .btn-dark-secondary {
        background: var(--theme-btn-sec-bg);
        border: 1px solid var(--theme-btn-sec-border);
        color: var(--theme-btn-sec-text);
        transition: all 0.2s ease;
    }

    .btn-dark-secondary:hover {
        background: var(--theme-cyan-subtle);
        color: var(--theme-cyan);
        border-color: var(--theme-cyan);
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
    
    <!-- Top Header Banner -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1 small">
                    <li class="breadcrumb-item"><a href="{{ route('petugas.dashboard') }}" class="text-decoration-none link-neon-cyan">Dashboard Petugas</a></li>
                    <li class="breadcrumb-item active fw-semibold" aria-current="page" style="color: var(--theme-text-main);">Pantau Pengembalian</li>
                </ol>
            </nav>
            <h2 class="fw-bold mb-0" style="color: var(--theme-text-main);">Pantau Pengembalian</h2>
            <p class="small mb-0" style="color: var(--theme-text-muted);">Memantau riwayat perangkat laboratorium yang telah dikembalikan.</p>
        </div>
        <div class="d-flex gap-2 align-items-center flex-wrap">
            <a href="{{ route('petugas.pengembalian.cetak') }}" target="_blank" class="btn btn-dark-secondary px-4 py-2.5 rounded-3 shadow-sm d-inline-flex align-items-center gap-2 fw-semibold">
                <i class="bi bi-printer fs-5"></i> Cetak Laporan
            </a>
            <span class="badge px-3 py-2.5 rounded-3 fw-semibold shadow-sm" style="background: var(--theme-cyan-subtle); color: var(--theme-cyan); border: 1px solid var(--theme-card-border);">
                <i class="bi bi-person-check me-1"></i> Akses Petugas
            </span>
        </div>
    </div>

    <!-- Tabel Data Pengembalian -->
    <div class="card lab-table-card border-0 overflow-hidden">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="py-3 px-3" width="5%">#</th>
                            <th class="py-3 px-3" width="15%">Tgl Kembali</th>
                            <th class="py-3 px-3" width="20%">Nama Peminjam</th>
                            <th class="py-3 px-3" width="25%">Nama Alat</th>
                            <th class="py-3 px-3" width="15%">Kondisi</th>
                            <th class="py-3 px-3 text-end" width="20%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($datap as $index => $item)
                            @php
                                $peminjaman = $peminjamanList[$item->id_peminjaman] ?? null;
                                $namaUser = $peminjaman ? ($userList[$peminjaman->id_user] ?? 'Tidak diketahui') : 'Tidak diketahui';
                                $namaAlat = $peminjaman ? ($alatList[$peminjaman->id_alat] ?? 'Alat dihapus') : 'Alat dihapus';
                            @endphp
                            <tr>
                                <td class="py-3 px-3 text-secondary">{{ $datap->firstItem() + $index }}</td>
                                <td class="py-3 px-3">{{ date('d M Y', strtotime($item->tanggal_pengembalian)) }}</td>
                                <td class="py-3 px-3 fw-medium" style="color: var(--theme-cyan);">{{ $namaUser }}</td>
                                <td class="py-3 px-3 fw-medium">
                                    <i class="bi bi-box-seam me-2" style="color: var(--theme-cyan);"></i>{{ $namaAlat }}
                                </td>
                                <td class="py-3 px-3">
                                    @if(strtolower($item->kondisi_barang) == 'baik')
                                        <span class="badge bg-success bg-opacity-10 text-success px-2.5 py-1.5 rounded-3 fw-semibold">Baik</span>
                                    @elseif(strtolower($item->kondisi_barang) == 'ringan rusak' || strtolower($item->kondisi_barang) == 'rusak ringan')
                                        <span class="badge bg-warning bg-opacity-10 text-warning px-2.5 py-1.5 rounded-3 fw-semibold">Rusak Ringan</span>
                                    @else
                                        <span class="badge bg-danger bg-opacity-10 text-danger px-2.5 py-1.5 rounded-3 fw-semibold">{{ $item->kondisi_barang ?? 'Rusak' }}</span>
                                    @endif
                                </td>
                                <td class="py-3 px-3 text-end">
                                    <span class="badge bg-success text-white rounded-pill px-3 py-2 fw-semibold">
                                        <i class="bi bi-check2-all me-1"></i> Selesai
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-2 d-block mb-3 opacity-25"></i>
                                    Belum ada data pengembalian alat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($datap->hasPages())
                <div class="d-flex justify-content-end mt-4 pt-3 border-top" style="border-color: var(--theme-card-border) !important;">
                    {{ $datap->links() }}
                </div>
            @endif
        </div>
    </div>

</div>
@endsection