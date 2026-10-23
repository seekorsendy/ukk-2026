@extends('layouts.app')

@section('title', config('app.name', 'SHEIN') . ' -- Persetujuan Peminjaman')

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

    /* Tombol Setujui Neon */
    .btn-neon-approve {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
        border: none !important;
        color: #ffffff !important;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.25);
        transition: all 0.3s ease;
    }

    .btn-neon-approve:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4);
        color: #ffffff !important;
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
                    <li class="breadcrumb-item active fw-semibold" aria-current="page" style="color: var(--theme-text-main);">Persetujuan Peminjaman</li>
                </ol>
            </nav>
            <h2 class="fw-bold mb-0" style="color: var(--theme-text-main);">Persetujuan Peminjaman Alat</h2>
            <p class="small mb-0" style="color: var(--theme-text-muted);">Daftar pengajuan peminjaman dari peminjam yang menunggu verifikasi petugas SHEIN.</p>
        </div>
        <span class="badge px-3 py-2.5 rounded-3 fw-semibold shadow-sm" style="background: var(--theme-cyan-subtle); color: var(--theme-cyan); border: 1px solid var(--theme-card-border);">
            <i class="bi bi-person-badge me-1"></i> Akses Petugas Operasional
        </span>
    </div>

    <!-- Alert Sukses -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-4 border-0 text-white" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Alert Error -->
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm mb-4 border-0 text-white" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Main Table Container -->
    <div class="card lab-table-card border-0 overflow-hidden">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="py-3 px-3" width="5%">No</th>
                            <th class="py-3 px-3" width="15%">ID Peminjaman</th>
                            <th class="py-3 px-3" width="40%">Nama Alat & Peminjam</th>
                            <th class="py-3 px-3" width="20%">Status</th>
                            <th class="py-3 px-3 text-center" width="20%">Aksi Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($datap as $index => $item)
                        <tr>
                            <td class="py-3 px-3 text-secondary fw-medium">{{ $datap->firstItem() + $index }}</td>
                            <td class="py-3 px-3 fw-semibold" style="color: var(--theme-cyan);">#{{ $item->id_peminjaman }}</td>
                            <td class="py-3 px-3">
                                <div class="fw-bold" style="color: var(--theme-text-main);">
                                    <i class="bi bi-box-seam me-1.5" style="color: var(--theme-cyan);"></i>
                                    {{ $item->data_alat->nama_alat ?? ($item->data_alat->nama ?? 'Alat ID: ' . $item->id_alat) }}
                                </div>
                                <div class="small mt-1" style="color: var(--theme-text-muted);">
                                    <i class="bi bi-person me-1"></i>
                                    {{ $item->data_user->username ?? ($item->data_user->name ?? 'User ID: ' . $item->id_user) }}
                                </div>
                            </td>
                            <td class="py-3 px-3">
                                @if(strtolower($item->status) == 'pending' || strtolower($item->status) == 'menunggu')
                                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-semibold">
                                        <i class="bi bi-hourglass-split me-1"></i> Pending
                                    </span>
                                @elseif(strtolower($item->status) == 'disetujui')
                                    <span class="badge bg-success text-white px-3 py-2 rounded-pill fw-semibold">
                                        <i class="bi bi-check-circle me-1"></i> Disetujui
                                    </span>
                                @else
                                    <span class="badge bg-secondary text-white px-3 py-2 rounded-pill fw-semibold">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                @endif
                            </td>
                            <td class="py-3 px-3 text-center">
                                @if(strtolower($item->status) == 'pending' || strtolower($item->status) == 'menunggu')
                                    <form action="{{ route('petugas.peminjaman.setujui', [$item->id_peminjaman]) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-neon-approve btn-sm rounded-pill px-4 py-2 d-inline-flex align-items-center gap-1.5">
                                            <i class="bi bi-check2 fs-6"></i> Setujui
                                        </button>
                                    </form>
                                @else
                                    <span class="text-success small fw-semibold d-inline-flex align-items-center gap-1">
                                        <i class="bi bi-check2-all fs-5"></i> Telah Disetujui
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-3 opacity-25"></i>
                                Belum ada data pengajuan peminjaman yang perlu diverifikasi.
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