<!-- Scoped CSS untuk Sidebar Tema Indigo Slate -->
<style>
    .app-sidebar {
        --sidebar-active-bg: #4f46e5;       /* Indigo Utama */
        --sidebar-active-color: #ffffff;
        --sidebar-hover-bg: #eef2ff;        /* Light Indigo Soft */
        --sidebar-hover-color: #4338ca;
        width: 260px;
    }

    [data-bs-theme="dark"] .app-sidebar {
        --sidebar-hover-bg: rgba(79, 70, 229, 0.18);
        --sidebar-hover-color: #818cf8;
    }

    /* Styling Item Navigasi */
    .app-sidebar .nav-link {
        color: var(--bs-body-color);
        border-radius: 8px;
        transition: all 0.2s ease-in-out;
        font-weight: 500;
        font-size: 0.9rem;
    }

    /* Efek Hover */
    .app-sidebar .nav-link:hover {
        background-color: var(--sidebar-hover-bg);
        color: var(--sidebar-hover-color);
    }

    /* Efek Active (Menu Terpilih) */
    .app-sidebar .nav-link.active {
        background-color: var(--sidebar-active-bg) !important;
        color: var(--sidebar-active-color) !important;
        box-shadow: 0 4px 10px rgba(79, 70, 229, 0.25);
    }

    /* Ukuran & Transisi Ikon */
    .app-sidebar .nav-link i {
        font-size: 1.15rem;
        transition: transform 0.2s ease;
    }

    .app-sidebar .nav-link:hover i {
        transform: translateX(2px);
    }

    /* Custom Scrollbar */
    .sidebar-scroll::-webkit-scrollbar {
        width: 4px;
    }
    .sidebar-scroll::-webkit-scrollbar-thumb {
        background: rgba(0, 0, 0, 0.12);
        border-radius: 10px;
    }
    [data-bs-theme="dark"] .sidebar-scroll::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.15);
    }

    /* Tombol Utama Indigo */
    .btn-brand-indigo {
        background-color: #4f46e5;
        color: #ffffff;
        border: none;
        font-weight: 500;
        transition: background-color 0.2s ease;
    }
    .btn-brand-indigo:hover {
        background-color: #4338ca;
        color: #ffffff;
    }
</style>

<!-- Link Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<!-- Sidebar Container -->
<div id="appSidebar" class="app-sidebar d-flex flex-column flex-shrink-0 p-3 bg-body border-end vh-100 shadow-sm">

    <!-- Bagian Atas: Logo, App Name, Theme Toggle & Close Button -->
    <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom flex-shrink-0 px-1">
        <div class="d-flex align-items-center gap-2 overflow-hidden">
            <!-- Icon/Logo App dengan Aksen Soft Indigo -->
            <div class="d-flex align-items-center justify-content-center rounded-3 flex-shrink-0" style="width: 36px; height: 36px; background-color: #eef2ff; color: #4f46e5;">
                <i class="bi bi-box-seam-fill fs-5"></i>
            </div>
            <a class="fs-6 fw-bold text-decoration-none text-body text-truncate m-0" href="{{ route('home') }}">
                {{ config('app.name') }}
            </a>
        </div>

        <div class="d-flex align-items-center gap-1">
            <!-- Toggle Theme Button -->
            <button id="themeToggle" type="button" class="btn btn-sm btn-icon btn-ghost-secondary rounded-circle p-1"
                    aria-label="Ganti tema terang/gelap" title="Ganti tema terang/gelap">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-body" aria-hidden="true">
                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                </svg>
            </button>
            <!-- Tombol Tutup Sidebar (Mobile) -->
            <button id="sidebarToggleClose" class="btn btn-sm btn-link text-body p-1 d-lg-none" aria-label="Tutup Menu">
                <i class="bi bi-x-lg fs-5"></i>
            </button>
        </div>
    </div>

    @php
        $dbConnected = false;
        try {
            \Sakuci\Database\Connection::pdo();
            $dbConnected = true;
        } catch (\Throwable $e) {
            $dbConnected = false;
        }
        $currentUser = \App\Models\User::current();
    @endphp

    <!-- Bagian Menu Navigasi Utama -->
    <ul class="nav nav-pills flex-column mb-auto gap-1 overflow-y-auto sidebar-scroll pe-1">
        
        <!-- Menu Beranda -->
        <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 {{ is_route('home') ? 'active' : '' }}">
                <i class="bi bi-house-door"></i> 
                <span>Beranda</span>
            </a>
        </li>

        {{-- Menu-menu khusus user yang sudah login --}}
        @if ($currentUser)
            @if ($currentUser->role === 'admin')
                <li class="nav-item">
                    <a href="{{ route('alat.index') }}" class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 {{ is_route('alat.index') ? 'active' : '' }}">
                        <i class="bi bi-journal-text"></i> 
                        <span>Data Alat</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('kategori.index') }}" class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 {{ is_route('kategori.index') ? 'active' : '' }}">
                        <i class="bi bi-tags"></i> 
                        <span>Data Kategori</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('peminjaman.index') }}" class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 {{ is_route('peminjaman.index') ? 'active' : '' }}">
                        <i class="bi bi-clipboard-check"></i> 
                        <span>Data Peminjaman</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('pengembalian.index') }}" class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 {{ is_route('pengembalian.index') ? 'active' : '' }}">
                        <i class="bi bi-arrow-return-left"></i> 
                        <span>Data Pengembalian</span>
                    </a>
                </li>
            @endif

            {{-- Menu Khusus Peminjam --}}
            @if ($currentUser->role === 'peminjam')
                <li class="nav-item">
                    <a href="{{ route('peminjam.indexPeminjam') }}" 
                       class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 {{ is_route('peminjam.indexPeminjam') ? 'active' : '' }}">
                        <i class="bi bi-plus-circle"></i> 
                        <span>Ajukan Peminjaman</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('peminjam.alat') }}" 
                       class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 {{ is_route('peminjam.alat') ? 'active' : '' }}">
                        <i class="bi bi-box-seam"></i> 
                        <span>Daftar Alat</span>
                    </a>
                </li>
            @endif

            <li class="nav-item">
                <a href="{{ $currentUser->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" 
                   class="nav-link d-flex align-items-center gap-3 px-3 py-2.5 {{ is_route('admin.dashboard', 'dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> 
                    <span>Dashboard</span>
                </a>
            </li>
        @endif
    </ul>

    <hr class="flex-shrink-0 my-3 opacity-25">

    <!-- Bagian Bawah: User Profile & Auth Button -->
    <div class="mt-auto flex-shrink-0">
        @if ($currentUser)
            <!-- Card Profil User -->
            <div class="d-flex align-items-center gap-2 p-2 mb-2 rounded-3 bg-body-tertiary border border-subtle">
                <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white flex-shrink-0" 
                     style="width: 36px; height: 36px; background-color: #4f46e5; font-size: 0.85rem;">
                    {{ strtoupper(substr($currentUser->username, 0, 2)) }}
                </div>
                <div class="overflow-hidden flex-grow-1">
                    <div class="fw-semibold text-body text-truncate" style="font-size: 0.875rem;">
                        {{ $currentUser->username }}
                    </div>
                    <div class="text-muted text-capitalize text-truncate" style="font-size: 0.75rem;">
                        {{ $currentUser->role }}
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm w-100 d-flex align-items-center justify-content-center gap-2 py-2">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    <span>Logout</span>
                </button>
            </form>
        @else
            @php
                $canRegister = false;
                if ($dbConnected) {
                    try {
                        $canRegister = \App\Models\Role::where('can_register', 1)->exists();
                    } catch (\Throwable $e) {
                        $canRegister = false;
                    }
                }
            @endphp
            
            <div class="d-flex flex-column gap-2">
                @if ($canRegister)
                    <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-sm w-100 py-2">Daftar</a>
                @endif
                <a href="{{ route('login') }}" class="btn btn-brand-indigo btn-sm w-100 d-inline-flex align-items-center justify-content-center gap-1 py-2">
                    Masuk
                </a>
            </div>
        @endif
    </div>

</div>