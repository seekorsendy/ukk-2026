@extends('layouts.app')

@section('title', config('app.name', 'SHEIN') . ' -- Daftar Kategori')

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

    .lab-glass-card {
        background: var(--theme-card-bg) !important;
        border: 1px solid var(--theme-card-border) !important;
        border-radius: 1.25rem !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .table {
        color: var(--theme-text-main) !important;
    }

    .table th {
        color: var(--theme-text-muted) !important;
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background-color: transparent !important;
        border-bottom: 2px solid var(--theme-card-border) !important;
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
    
    <!-- Header Halaman & Tombol Tambah -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1 small">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none link-neon-cyan">Dashboard</a></li>
                    <li class="breadcrumb-item active fw-semibold" aria-current="page" style="color: var(--theme-text-main);">Daftar Kategori</li>
                </ol>
            </nav>
            <h2 class="fw-bold mb-0" style="color: var(--theme-text-main);">Daftar Kategori</h2>
            <p class="small mb-0" style="color: var(--theme-text-muted);">Kelola data kategori alat inventaris lab SHEIN.</p>
        </div>
        <a href="{{ route('kategori.create') }}" class="btn px-4 py-2.5 rounded-3 shadow-sm d-inline-flex align-items-center gap-2 fw-semibold" style="background: linear-gradient(135deg, #06b6d4 0%, #3b82f6 50%, #8b5cf6 100%) !important; border: none !important; color: #ffffff !important;">
            <i class="bi bi-plus-circle-fill"></i>
            <span>Tambah Kategori Baru</span>
        </a>
    </div>

    <!-- Card Pembungkus Tabel yang Seragam -->
    <div class="card lab-glass-card border-0 overflow-hidden">
        <div class="card-header py-3 px-4 border-bottom d-flex align-items-center justify-content-between" style="border-color: var(--theme-card-border) !important; background: var(--theme-cyan-subtle);">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-3 p-2" style="background: var(--theme-cyan-subtle); color: var(--theme-cyan); border: 1px solid var(--theme-card-border);">
                    <i class="bi bi-tags fs-5"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-0" style="color: var(--theme-text-main);">Seluruh Kategori Terdaftar</h6>
                    <span class="small" style="color: var(--theme-text-muted);">Klasifikasi kelompok perangkat laboratorium</span>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="py-3 px-4 text-center" style="width: 5%;">No</th>
                            <th class="py-3 px-3">Nama Kategori</th>
                            <th class="py-3 px-3">Kode Kategori</th>
                            <th class="py-3 px-3">Keterangan</th>
                            <th class="py-3 px-4 text-center" style="width: 200px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @forelse ($data as $kategoris)
                        <tr>
                            <td class="px-4 text-center fw-medium" style="color: var(--theme-text-muted);">{{ $no++ }}</td>
                            
                            <td class="px-3">
                                <div class="fw-semibold" style="color: var(--theme-text-main);">{{ $kategoris->nama_kategori }}</div>
                            </td>

                            <td class="px-3">
                                <span class="badge font-monospace fw-semibold px-2.5 py-1.5 rounded-2" style="background: var(--theme-cyan-subtle); color: var(--theme-cyan); border: 1px solid var(--theme-card-border);">
                                    {{ $kategoris->kode_kategori }}
                                </span>
                            </td>

                            <td class="px-3">
                                <span style="color: var(--theme-text-muted);">{{ $kategoris->keterangan ?? '-' }}</span>
                            </td>

                            <td class="px-4 text-center">
                                <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                    <!-- Tombol Edit (Cyan-Teal senada dengan badge) -->
                                    <a href="{{ route('kategori.edit', ['kategori' => $kategoris->id_kategori]) }}" 
                                       class="btn btn-sm px-3 py-1.5 rounded-3 d-inline-flex align-items-center gap-1.5 shadow-sm" 
                                       style="background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%) !important; border: none !important; color: #ffffff !important; font-weight: 600 !important;" 
                                       title="Edit">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    <!-- Tombol Hapus (Merah Crimson) -->
                                    <form action="{{ route('kategori.delete', ['id' => $kategoris->id_kategori]) }}" method="POST" class="d-inline m-0" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm px-3 py-1.5 rounded-3 d-inline-flex align-items-center gap-1.5 shadow-sm" 
                                                style="background: linear-gradient(135deg, #f43f5e 0%, #be123c 100%) !important; border: none !important; color: #ffffff !important; font-weight: 600 !important;" 
                                                title="Hapus">
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
                                    <span>Belum ada data kategori yang ditambahkan.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Bagian Pagination -->
        @if(method_exists($data, 'hasPages') && $data->hasPages())
        <div class="card-footer bg-transparent py-3 px-4 border-top d-flex justify-content-end" style="border-color: var(--theme-card-border) !important;">
            {!! $data->links() !!}
        </div>
        @endif
    </div>

</div>
@endsection

```