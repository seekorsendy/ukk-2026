@extends('layouts.app')

@section('title', config('app.name', 'SHEIN') . ' -- Tambah Pengembalian')

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
    .lab-form-card {
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

    .form-control-dynamic, .form-select-dynamic {
        background-color: var(--theme-input-bg) !important;
        border: 1px solid var(--theme-input-border) !important;
        color: var(--theme-input-text) !important;
        transition: all 0.25s ease;
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
    
    <!-- Top Header Banner -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1 small">
                    <li class="breadcrumb-item"><a href="{{ route('pengembalian.index') }}" class="text-decoration-none link-neon-cyan">Data Pengembalian</a></li>
                    <li class="breadcrumb-item active fw-semibold" aria-current="page" style="color: var(--theme-text-main);">Tambah Pengembalian</li>
                </ol>
            </nav>
            <h2 class="fw-bold mb-0" style="color: var(--theme-text-main);">Tambah Data Pengembalian</h2>
            <p class="small mb-0" style="color: var(--theme-text-muted);">Catat transaksi pengembalian alat lab SHEIN baru.</p>
        </div>
        <a href="{{ route('pengembalian.index') }}" class="btn btn-dark-secondary px-4 py-2.5 rounded-3 shadow-sm d-inline-flex align-items-center gap-2 fw-semibold">
            <i class="bi bi-arrow-left fs-5"></i> Kembali
        </a>
    </div>

    <!-- Main Card Container -->
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card lab-form-card border-0 overflow-hidden">
                
                <!-- Card Header -->
                <div class="card-header py-3 px-4 border-bottom d-flex align-items-center gap-3" style="border-color: var(--theme-card-border) !important; background: var(--theme-cyan-subtle);">
                    <div class="rounded-3 p-2" style="background: var(--theme-cyan-subtle); color: var(--theme-cyan); border: 1px solid var(--theme-card-border);">
                        <i class="bi bi-arrow-counterclockwise fs-5"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0" style="color: var(--theme-text-main);">Formulir Pencatatan Pengembalian</h6>
                        <span class="small" style="color: var(--theme-text-muted);">Masukkan detail data pengembalian perangkat laboratorium</span>
                    </div>
                </div>

                <!-- Form Body -->
                <div class="card-body p-4">
                    <form action="{{ route('pengembalian.store') }}" method="POST">
                        @csrf

                        <div class="row g-3">
                            <!-- Pilih Peminjaman -->
                            <div class="col-md-6">
                                <label for="id_peminjaman" class="form-label form-dark-label text-uppercase">Pilih Peminjaman</label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-dynamic border-end-0 rounded-start-3"><i class="bi bi-journal-check"></i></span>
                                    <select name="id_peminjaman" id="id_peminjaman" class="form-select form-select-dynamic border-start-0 ps-0 rounded-end-3 shadow-none" required>
                                        <option value="" disabled selected>-- Pilih Data Peminjaman --</option>
                                        @foreach($peminjaman as $p)
                                            @php
                                                $pid = $p->id_peminjaman ?? $p->id;
                                                $uname = $userList[$p->id_user] ?? 'User #'.$p->id_user;
                                                $alatName = $alatList[$p->id_alat] ?? 'Alat #'.$p->id_alat;
                                            @endphp
                                            <option value="{{ $pid }}" {{ old('id_peminjaman') == $pid ? 'selected' : '' }}>
                                                ID #{{ $pid }} - {{ $uname }} ({{ $alatName }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Tanggal Pengembalian -->
                            <div class="col-md-6">
                                <label for="tanggal_pengembalian" class="form-label form-dark-label text-uppercase">Tanggal Pengembalian</label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-dynamic border-end-0 rounded-start-3"><i class="bi bi-calendar-event"></i></span>
                                    <input type="datetime-local" name="tanggal_pengembalian" id="tanggal_pengembalian" class="form-control form-control-dynamic border-start-0 ps-0 rounded-end-3 shadow-none" value="{{ old('tanggal_pengembalian', date('Y-m-d\TH:i')) }}" required>
                                </div>
                            </div>

                            <!-- Terlambat (Hari) -->
                            <div class="col-md-4">
                                <label for="terlambat_hari" class="form-label form-dark-label text-uppercase">Terlambat (Hari)</label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-dynamic border-end-0 rounded-start-3"><i class="bi bi-clock-history"></i></span>
                                    <input type="number" min="0" name="terlambat_hari" id="terlambat_hari" class="form-control form-control-dynamic border-start-0 ps-0 rounded-end-3 shadow-none" value="{{ old('terlambat_hari', 0) }}">
                                </div>
                            </div>

                            <!-- Denda (Rp) -->
                            <div class="col-md-4">
                                <label for="denda" class="form-label form-dark-label text-uppercase">Denda (Rp)</label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-dynamic border-end-0 rounded-start-3"><i class="bi bi-cash-stack"></i></span>
                                    <input type="number" min="0" name="denda" id="denda" class="form-control form-control-dynamic border-start-0 ps-0 rounded-end-3 shadow-none" value="{{ old('denda', 0) }}">
                                </div>
                            </div>

                            <!-- Kondisi Barang -->
                            <div class="col-md-4">
                                <label for="kondisi_barang" class="form-label form-dark-label text-uppercase">Kondisi Barang</label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-dynamic border-end-0 rounded-start-3"><i class="bi bi-shield-check"></i></span>
                                    <select name="kondisi_barang" id="kondisi_barang" class="form-select form-select-dynamic border-start-0 ps-0 rounded-end-3 shadow-none">
                                        <option value="Baik" {{ old('kondisi_barang') == 'Baik' ? 'selected' : '' }}>Baik</option>
                                        <option value="Rusak Ringan" {{ old('kondisi_barang') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                        <option value="Rusak Berat" {{ old('kondisi_barang') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                                        <option value="Hilang" {{ old('kondisi_barang') == 'Hilang' ? 'selected' : '' }}>Hilang</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Catatan -->
                            <div class="col-12">
                                <label for="catatan" class="form-label form-dark-label text-uppercase">Catatan</label>
                                <div class="input-group">
                                    <span class="input-group-text input-group-text-dynamic border-end-0 rounded-start-3 align-items-start pt-2.5"><i class="bi bi-card-text"></i></span>
                                    <textarea name="catatan" id="catatan" rows="3" class="form-control form-control-dynamic border-start-0 ps-0 rounded-end-3 shadow-none" placeholder="Tambahkan catatan jika ada...">{{ old('catatan') }}</textarea>
                                </div>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="col-12 d-flex justify-content-end gap-2 mt-4 pt-3 border-top" style="border-color: var(--theme-card-border) !important;">
                                <a href="{{ route('pengembalian.index') }}" class="btn btn-dark-secondary px-4 py-2.5 rounded-3 fw-semibold">Batal</a>
                                <button type="submit" class="btn btn-neon-primary px-4 py-2.5 rounded-3 d-inline-flex align-items-center gap-2">
                                    <i class="bi bi-save-fill"></i> Simpan Data
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>

<!-- Script untuk Kalkulasi Denda Otomatis (Berdasarkan Keterlambatan & Kondisi Barang) -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputTerlambat = document.getElementById('terlambat_hari');
        const selectKondisi = document.getElementById('kondisi_barang');
        const inputDenda = document.getElementById('denda');
        
        // Pengaturan Tarif Denda (Bisa diubah sesuai aturan lab kamu)
        const tarifDendaPerHari = 5000; // Rp 5.000 per hari terlambat
        
        const dendaKerusakan = {
            'Baik': 0,
            'Rusak Ringan': 25000,   // Denda tambahan jika rusak ringan
            'Rusak Berat': 100000,   // Denda tambahan jika rusak berat
            'Hilang': 250000         // Denda tambahan jika barang hilang
        };

        function hitungTotalDenda() {
            let hari = parseInt(inputTerlambat.value) || 0;
            if (hari < 0) hari = 0;

            let kondisi = selectKondisi.value;
            let tambahanDendaRusak = dendaKerusakan[kondisi] || 0;

            // Total denda = (hari keterlambatan * tarif) + denda kondisi barang
            let totalDenda = (hari * tarifDendaPerHari) + tambahanDendaRusak;
            
            inputDenda.value = totalDenda;
        }

        if (inputTerlambat && selectKondisi && inputDenda) {
            inputTerlambat.addEventListener('input', hitungTotalDenda);
            selectKondisi.addEventListener('change', hitungTotalDenda);
        }
    });
</script>
@endsection