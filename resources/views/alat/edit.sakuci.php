Maaf ya kalau sebelumnya sempat bikin bingung! Oke, paham maksudnya. Halaman edit-nya sudah full lebar (*full-width*), dan kita pastikan tidak ada elemen tabel di dalam form atau struktur yang bikin layout-nya "numpuk" atau menyempit.

Berikut adalah kode lengkap untuk **`edit-alat.blade.php`** dengan layout yang benar-benar **full-width (*full layar*)**, bersih, menggunakan container layout penuh, dan sudah mendukung **Dark & Light Mode** secara otomatis:

```html
@extends('layouts.app')

@section('title', config('app.name', 'SHEIN') . ' -- Edit Alat Lab')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    /* Dynamic Theme Variables (Supports Light & Dark Mode) */
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
        transition: background-color 0.3s ease;
    }

    /* Full Width Wrapper */
    .admin-dashboard-fullwrapper {
        background-color: var(--theme-bg-body) !important;
        color: var(--theme-text-main) !important;
        min-height: 100vh;
        width: 100% !important;
        padding: 2rem;
        box-sizing: border-box;
    }

    .lab-form-card {
        background: var(--theme-card-bg) !important;
        border: 1px solid var(--theme-card-border) !important;
        border-radius: 1.25rem !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    }

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

    .form-control-dynamic, .form-select-dynamic {
        background-color: var(--theme-input-bg) !important;
        border: 1px solid var(--theme-input-border) !important;
        color: var(--theme-input-text) !important;
    }

    .form-control-dynamic:focus, .form-select-dynamic:focus {
        background-color: var(--theme-input-bg) !important;
        border-color: var(--theme-cyan-bright) !important;
        box-shadow: 0 0 12px var(--theme-cyan-subtle) !important;
        color: var(--theme-input-text) !important;
    }

    .form-select-dynamic option {
        background-color: var(--theme-card-bg);
        color: var(--theme-input-text);
    }

    .btn-neon-primary {
        background: linear-gradient(135deg, #06b6d4 0%, #3b82f6 50%, #8b5cf6 100%) !important;
        border: none !important;
        color: #ffffff !important;
        font-weight: 600;
        box-shadow: 0 6px 20px rgba(6, 182, 212, 0.3);
    }

    .btn-dark-secondary {
        background: var(--theme-btn-sec-bg);
        border: 1px solid var(--theme-btn-sec-border);
        color: var(--theme-btn-sec-text);
    }

    .link-neon-cyan {
        color: var(--theme-cyan);
    }
</style>

<div class="admin-dashboard-fullwrapper">
    
    <!-- Top Header Banner -->
    <div class="row align-items-center mb-4">
        <div class="col-md-7">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1 small">
                    <li class="breadcrumb-item"><a href="{{ route('alat.index') }}" class="text-decoration-none link-neon-cyan">Inventaris Alat</a></li>
                    <li class="breadcrumb-item active fw-semibold" aria-current="page" style="color: var(--theme-text-main);">Edit Alat</li>
                </ol>
            </nav>
            <h2 class="fw-bold mb-0" style="color: var(--theme-text-main);">Edit Data Alat Laboratorium</h2>
        </div>
        <div class="col-md-5 text-md-end mt-3 mt-md-0">
            <a href="{{ route('alat.index') }}" class="btn btn-dark-secondary px-4 py-2.5 rounded-3 shadow-sm d-inline-flex align-items-center gap-2 fw-semibold">
                <i class="bi bi-arrow-left fs-5"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Main Card Container (Centered Form with Full Width Layout) -->
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            <div class="card lab-form-card border-0 overflow-hidden">
                
                <!-- Card Header -->
                <div class="card-header py-3 px-4 border-bottom d-flex align-items-center gap-3" style="border-color: var(--theme-card-border) !important; background: var(--theme-cyan-subtle);">
                    <div class="rounded-3 p-2" style="background: rgba(245, 158, 11, 0.15); color: #f59e0b; border: 1px solid rgba(245, 158, 11, 0.3);">
                        <i class="bi bi-pencil-square fs-5"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0" style="color: var(--theme-text-main);">Formulir Perubahan Alat</h6>
                        <span class="small" style="color: var(--theme-text-muted);">Perbarui informasi perangkat lab SHEIN ID: #{{ $datal->id_alat ?? '' }}</span>
                    </div>
                </div>

                <!-- Form Body -->
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('alat.update', ['id_alat' => $datal->id_alat]) }}" method="POST" class="d-flex flex-column gap-3">
                        @csrf

                        <!-- Nama Alat -->
                        <div>
                            <label for="nama_alat" class="form-label form-dark-label text-uppercase">Nama Alat</label>
                            <div class="input-group">
                                <span class="input-group-text input-group-text-dynamic border-end-0 rounded-start-3"><i class="bi bi-cpu"></i></span>
                                <input type="text" name="nama_alat" id="nama_alat" class="form-control form-control-dynamic border-start-0 ps-0 rounded-end-3 shadow-none" value="{{ old('nama_alat', $datal->nama_alat ?? '') }}" placeholder="Contoh: Oscilloscope Digital" required>
                            </div>
                        </div>
                        
                        <!-- Kode Alat -->
                        <div>
                            <label for="kode_alat" class="form-label form-dark-label text-uppercase">Kode Perangkat</label>
                            <div class="input-group">
                                <span class="input-group-text input-group-text-dynamic border-end-0 rounded-start-3"><i class="bi bi-code-slash"></i></span>
                                <input type="text" name="kode_alat" id="kode_alat" class="form-control form-control-dynamic border-start-0 ps-0 rounded-end-3 shadow-none" value="{{ old('kode_alat', $datal->kode_alat ?? '') }}" placeholder="Contoh: LAB-ELC-001" required>
                            </div>
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label for="id_kategori" class="form-label form-dark-label text-uppercase">Kategori Lab</label>
                            <div class="input-group">
                                <span class="input-group-text input-group-text-dynamic border-end-0 rounded-start-3"><i class="bi bi-tag"></i></span>
                                <select name="id_kategori" id="id_kategori" class="form-select form-select-dynamic border-start-0 ps-0 rounded-end-3 shadow-none" required>
                                    <option value="">-- Pilih Kategori Lab --</option>
                                    @if(isset($kategori))
                                        @foreach ($kategori as $k)
                                            <option value="{{ $k->id_kategori }}" {{ (isset($datal) && $datal->id_kategori == $k->id_kategori) ? 'selected' : '' }}>
                                                {{ $k->nama_kategori }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top" style="border-color: var(--theme-card-border) !important;">
                            <a href="{{ route('alat.index') }}" class="btn btn-dark-secondary px-4 py-2.5 rounded-3 fw-semibold">Batal</a>
                            <button type="submit" class="btn btn-neon-primary px-4 py-2.5 rounded-3 d-inline-flex align-items-center gap-2">
                                <i class="bi bi-check-circle-fill"></i> Simpan Perubahan
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