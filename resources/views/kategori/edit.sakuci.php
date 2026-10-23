@extends('layouts.app')

@section('title', config('app.name', 'SHEIN') . ' -- Edit Kategori')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    /* Variables untuk Tema Dynamic */
    :root {
        --theme-cyan: #0891b2;
        --theme-cyan-bright: #06b6d4;
        --theme-cyan-subtle: rgba(6, 182, 212, 0.12);
        --theme-bg-body: #f8fafc;
        --theme-card-bg: #ffffff;
        --theme-card-border: rgba(0, 0, 0, 0.08);
        --theme-text-main: #0f172a;
        --theme-text-muted: #64748b;
        --theme-input-bg: #f8fafc;
        --theme-input-border: #cbd5e1;
        --theme-input-text: #0f172a;
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
        --theme-input-bg: rgba(30, 41, 59, 0.6);
        --theme-input-border: rgba(56, 189, 248, 0.2);
        --theme-input-text: #ffffff;
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
    .lab-glass-card {
        background: var(--theme-card-bg) !important;
        border: 1px solid var(--theme-card-border) !important;
        border-radius: 1.25rem !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    /* Form Labels & Inputs Dynamic */
    .form-dark-label {
        color: var(--theme-text-muted);
        font-size: 0.78rem;
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    .input-group-text-dynamic {
        background-color: var(--theme-input-bg) !important;
        border: 1px solid var(--theme-input-border) !important;
        color: var(--theme-cyan) !important;
    }

    .form-control-dynamic {
        background-color: var(--theme-input-bg) !important;
        border: 1px solid var(--theme-input-border) !important;
        color: var(--theme-input-text) !important;
        transition: all 0.25s ease;
    }

    .form-control-dynamic:focus {
        background-color: var(--theme-input-bg) !important;
        border-color: var(--theme-cyan-bright) !important;
        box-shadow: 0 0 12px var(--theme-cyan-subtle) !important;
        color: var(--theme-input-text) !important;
    }

    /* Tombol-tombol */
    .btn-neon-primary {
        background: linear-gradient(135deg, #06b6d4 0%, #3b82f6 50%, #8b5cf6 100%) !important;
        border: none !important;
        color: #ffffff !important;
        font-weight: 600;
        box-shadow: 0 6px 20px rgba(6, 182, 212, 0.3);
        transition: all 0.3s ease;
    }

    .btn-neon-primary:hover {
        opacity: 0.95;
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(6, 182, 212, 0.45);
    }

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
    
    <!-- Header Halaman & Breadcrumb -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1 small">
                    <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}" class="text-decoration-none link-neon-cyan">Daftar Kategori</a></li>
                    <li class="breadcrumb-item active fw-semibold" aria-current="page" style="color: var(--theme-text-main);">Edit Kategori</li>
                </ol>
            </nav>
            <h2 class="fw-bold mb-0" style="color: var(--theme-text-main);">Edit Kategori</h2>
            <p class="small mb-0" style="color: var(--theme-text-muted);">Perbarui informasi data kategori inventaris.</p>
        </div>
        <a href="{{ route('kategori.index') }}" class="btn btn-dark-secondary px-4 py-2.5 rounded-3 shadow-sm d-inline-flex align-items-center gap-2 fw-semibold">
            <i class="bi bi-arrow-left fs-5"></i> Kembali
        </a>
    </div>

    <!-- Card Pembungkus Form -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card lab-glass-card border-0 overflow-hidden">
                <div class="card-header py-3 px-4 border-bottom d-flex align-items-center gap-3" style="border-color: var(--theme-card-border) !important; background: var(--theme-cyan-subtle);">
                    <div class="rounded-3 p-2" style="background: var(--theme-cyan-subtle); color: var(--theme-cyan); border: 1px solid var(--theme-card-border);">
                        <i class="bi bi-pencil-square fs-5"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0" style="color: var(--theme-text-main);">Formulir Perubahan Data Kategori</h6>
                        <span class="small" style="color: var(--theme-text-muted);">Sesuaikan data kategori inventaris lab SHEIN</span>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('kategori.update', ['id_kategori' => $data->id_kategori]) }}" method="POST" class="d-flex flex-column gap-3">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="nama_kategori" class="form-label form-dark-label text-uppercase">Nama Kategori</label>
                            <div class="input-group">
                                <span class="input-group-text input-group-text-dynamic border-end-0 rounded-start-3"><i class="bi bi-tag-fill"></i></span>
                                <input type="text" name="nama_kategori" id="nama_kategori" class="form-control form-control-dynamic border-start-0 ps-0 rounded-end-3 shadow-none" value="{{ old('nama_kategori', $data->nama_kategori) }}" required>
                            </div>
                        </div>
                        
                        <div>
                            <label for="kode_kategori" class="form-label form-dark-label text-uppercase">Kode Kategori</label>
                            <div class="input-group">
                                <span class="input-group-text input-group-text-dynamic border-end-0 rounded-start-3"><i class="bi bi-qr-code"></i></span>
                                <input type="text" name="kode_kategori" id="kode_kategori" class="form-control form-control-dynamic border-start-0 ps-0 rounded-end-3 shadow-none" value="{{ old('kode_kategori', $data->kode_kategori) }}" required>
                            </div>
                        </div>

                        <div>
                            <label for="keterangan" class="form-label form-dark-label text-uppercase">Keterangan</label>
                            <div class="input-group">
                                <span class="input-group-text input-group-text-dynamic border-end-0 rounded-start-3"><i class="bi bi-card-text"></i></span>
                                <input type="text" name="keterangan" id="keterangan" class="form-control form-control-dynamic border-start-0 ps-0 rounded-end-3 shadow-none" value="{{ old('keterangan', $data->keterangan) }}" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top" style="border-color: var(--theme-card-border) !important;">
                            <a href="{{ route('kategori.index') }}" class="btn btn-dark-secondary px-4 py-2.5 rounded-3 fw-semibold">Kembali</a>
                            <button type="submit" class="btn btn-neon-primary px-4 py-2.5 rounded-3 d-inline-flex align-items-center gap-2">
                                <i class="bi bi-save-fill"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

```