<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>

    <script>
        (function () {
            var saved = localStorage.getItem('sakuci-theme');
            var theme = saved || (matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            document.documentElement.setAttribute('data-bs-theme', theme);
        })();
    </script>

    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- CSS Khusus untuk Efek Geser (Push Effect) Sidebar -->
    <style>
        .app-sidebar {
            width: 240px;
            min-width: 240px;
            position: sticky;
            top: 0;
            height: 100vh;
            z-index: 1040;
            transition: margin-left 0.3s ease-in-out;
        }
        .main-wrapper {
            flex-grow: 1;
            transition: margin-left 0.3s ease-in-out;
            min-width: 0;
        }
        /* Saat body memiliki kelas sidebar-collapsed, geser sidebar ke kiri hingga tersembunyi */
        body.sidebar-collapsed .app-sidebar {
            margin-left: -240px;
        }
    </style>
</head>
<body class="bg-body-tertiary">

    <div class="d-flex min-vh-100">

        {{-- Sidebar --}}
        @include('partials.sidebar')

        {{-- Konten Utama --}}
        <div class="main-wrapper d-flex flex-column">
            
            <!-- Navbar Atas Kecil untuk Tombol Trigger Sidebar -->
            <header class="navbar bg-body border-bottom px-4 py-2 sticky-top">
                <button id="sidebarToggle" class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-2" type="button">
                    <i class="bi bi-list fs-5"></i>
                    <span class="d-none d-sm-inline">Menu</span>
                </button>
            </header>

            <main class="container-fluid flex-grow-1 p-4 p-lg-5">
                @include('partials.flash')
                @yield('content')
            </main>

            @include('partials.footer')
            
        </div>

    </div>

<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/theme.js') }}"></script>

<!-- Skrip Pengontrol Toggle Sidebar & Memori Penyimpanan -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('sidebarToggle');
        const closeBtn = document.getElementById('sidebarToggleClose');
        const body = document.body;

        // Cek status memori terakhir dari browser
        if (localStorage.getItem('sidebarState') === 'collapsed') {
            body.classList.add('sidebar-collapsed');
        }

        function toggleSidebar() {
            body.classList.toggle('sidebar-collapsed');
            // Simpan preferensi ke local storage supaya tidak berubah saat pindah halaman
            if (body.classList.contains('sidebar-collapsed')) {
                localStorage.setItem('sidebarState', 'collapsed');
            } else {
                localStorage.setItem('sidebarState', 'expanded');
            }
        }

        if (toggleBtn) toggleBtn.addEventListener('click', toggleSidebar);
        if (closeBtn) closeBtn.addEventListener('click', toggleSidebar);
    });
</script>

@yield('scripts')

</body>
</html>