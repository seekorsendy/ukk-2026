@extends('layouts.app')

@section('title', config('app.name') . ' — Admin Control Center')

@section('content')

    <!-- Custom Modern Dashboard Styling -->
    <style>
        :root {
            --card-radius: 1.25rem;
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .dashboard-wrapper {
            background-color: var(--bs-body-bg);
            color: var(--bs-body-color);
            min-height: 85vh;
            padding: 2.5rem 1.5rem;
        }

        /* Modern Glass Card */
        .dash-card {
            background-color: var(--bs-body-bg);
            border: 1px solid rgba(var(--bs-border-color-rgb), 0.8);
            border-radius: var(--card-radius);
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.05);
            transition: var(--transition-smooth);
            overflow: hidden;
        }

        .dash-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.08);
            border-color: rgba(var(--bs-primary-rgb), 0.3);
        }

        /* Hero Header Gradient */
        .hero-banner {
            background: linear-gradient(135deg, rgba(var(--bs-primary-rgb), 0.12) 0%, rgba(var(--bs-primary-rgb), 0.02) 100%);
            border-left: 5px solid var(--bs-primary);
        }

        /* Action Card Icons Frame */
        .icon-shape {
            width: 52px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 1rem;
        }
    </style>

    <div class="container dashboard-wrapper">
        
        <!-- Welcome Banner Header -->
        <div class="dash-card hero-banner p-4 p-lg-5 mb-4 position-relative">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="d-inline-flex align-items-center gap-2 badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3 fw-semibold">
                        <i class="bi bi-patch-check-fill"></i> Administrator Utama
                    </div>
                    <h1 class="h2 fw-extrabold mb-2">Selamat Datang, {{ $user->username }}! 👋</h1>
                    <p class="text-secondary mb-0 lead fs-6">
                        Kelola seluruh hak akses pengguna, inventaris alat, serta aktivitas peminjaman secara terpusat dan efisien dari panel ini.
                    </p>
                </div>
                <div class="col-lg-4 text-end d-none d-lg-block">
                    <div class="p-4 d-inline-block rounded-circle bg-primary bg-opacity-10 text-primary shadow-sm">
                        <i class="bi bi-person-workspace display-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Title -->
        <div class="d-flex align-items-center justify-content-between mb-3 px-1">
            <h5 class="fw-bold mb-0 text-secondary">
                <i class="bi bi-grid-fill text-primary me-2"></i>Panel & Fitur Kontrol
            </h5>
        </div>

        <!-- Grid Kartu Fitur Utama Admin -->
        <div class="row g-4">
            
            <!-- Card 1: Manage Role -->
            <div class="col-xl-4 col-md-6">
                <div class="dash-card p-4 h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="icon-shape bg-primary bg-opacity-10 text-primary">
                                <i class="bi bi-shield-check fs-4"></i>
                            </div>
                            <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill">Akses</span>
                        </div>
                        <h3 class="h5 fw-bold mb-2">Manage Role</h3>
                        <p class="text-muted small mb-4">
                            Konfigurasi dan atur hak akses tingkat keamanan untuk tiap grup pengguna aplikasi.
                        </p>
                    </div>
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-primary rounded-pill w-100 fw-semibold py-2 d-flex align-items-center justify-content-center gap-2 shadow-sm">
                        <span>Kelola Role</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Card 2: Manage User -->
            <div class="col-xl-4 col-md-6">
                <div class="dash-card p-4 h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="icon-shape bg-info bg-opacity-10 text-info">
                                <i class="bi bi-people-fill fs-4"></i>
                            </div>
                            <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill">Pengguna</span>
                        </div>
                        <h3 class="h5 fw-bold mb-2">Manage User</h3>
                        <p class="text-muted small mb-4">
                            Tambah pengguna baru, ubah data akun, dan tetapkan role hak akses secara real-time.
                        </p>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-info text-white rounded-pill w-100 fw-semibold py-2 d-flex align-items-center justify-content-center gap-2 shadow-sm">
                        <span>Kelola User</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Card 3: Backup Database -->
            <div class="col-xl-4 col-md-6">
                <div class="dash-card p-4 h-100 d-flex flex-column justify-content-between border-top border-3 border-warning">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="icon-shape bg-warning bg-opacity-10 text-warning">
                                <i class="bi bi-database-fill-down fs-4"></i>
                            </div>
                            <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill">Keamanan</span>
                        </div>
                        <h3 class="h5 fw-bold mb-2">Database Backup</h3>
                        <p class="text-muted small mb-4">
                            Cegah kehilangan data penting dengan mengunduh salinan cadangan file database <code class="text-warning-emphasis">.sql</code>.
                        </p>
                    </div>
                    <a href="{{ route('admin.database.export') }}" class="btn btn-warning text-dark rounded-pill w-100 fw-semibold py-2 d-flex align-items-center justify-content-center gap-2 shadow-sm">
                        <span>Download .SQL</span>
                        <i class="bi bi-download"></i>
                    </a>
                </div>
            </div>

            <!-- Card 4: Kategori Alat -->
            <div class="col-xl-4 col-md-6">
                <div class="dash-card p-4 h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="icon-shape bg-success bg-opacity-10 text-success">
                                <i class="bi bi-tags-fill fs-4"></i>
                            </div>
                            <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill">Inventaris</span>
                        </div>
                        <h3 class="h5 fw-bold mb-2">Kelola Kategori</h3>
                        <p class="text-muted small mb-4">
                            Atur pengelompokan jenis dan kategori alat inventaris sekolah/kantor.
                        </p>
                    </div>
                    <a href="{{ route('kategori.index') }}" class="btn btn-outline-success rounded-pill w-100 fw-semibold py-2 d-flex align-items-center justify-content-center gap-2 shadow-sm">
                        <span>Buka Kategori</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Card 5: Kelola Alat -->
            <div class="col-xl-4 col-md-6">
                <div class="dash-card p-4 h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="icon-shape bg-primary bg-opacity-10 text-primary">
                                <i class="bi bi-box-seam-fill fs-4"></i>
                            </div>
                            <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill">Inventaris</span>
                        </div>
                        <h3 class="h5 fw-bold mb-2">Kelola Alat</h3>
                        <p class="text-muted small mb-4">
                            Tambah, perbarui, dan pantau stok seluruh peralatan yang tersedia.
                        </p>
                    </div>
                    <a href="{{ route('alat.index') }}" class="btn btn-outline-primary rounded-pill w-100 fw-semibold py-2 d-flex align-items-center justify-content-center gap-2 shadow-sm">
                        <span>Lihat Data Alat</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Card 6: Transaksi Peminjaman -->
            <div class="col-xl-4 col-md-6">
                <div class="dash-card p-4 h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="icon-shape bg-purple bg-danger bg-opacity-10 text-danger">
                                <i class="bi bi-arrow-left-right fs-4"></i>
                            </div>
                            <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill">Sirkulasi</span>
                        </div>
                        <h3 class="h5 fw-bold mb-2">Peminjaman</h3>
                        <p class="text-muted small mb-4">
                            Pantau proses peminjaman, persetujuan, dan pengembalian barang.
                        </p>
                    </div>
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-danger rounded-pill w-100 fw-semibold py-2 d-flex align-items-center justify-content-center gap-2 shadow-sm">
                        <span>Daftar Peminjaman</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

        </div> <!-- End Row Grid -->

    </div>

@endsection