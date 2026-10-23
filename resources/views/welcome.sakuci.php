@extends('layouts.app')

@section('title', config('app.name', 'SHEIN') . ' -- Peminjaman Lab Sekolah')

@section('content')
<style>
    /* Dynamic Theme Variables (Light & Dark Mode) */
    :root {
        --lab-cyan: #0891b2;
        --lab-cyan-bright: #06b6d4;
        --lab-cyan-subtle: rgba(6, 182, 212, 0.12);
        --lab-bg-body: #f8fafc;
        --lab-card-bg: #ffffff;
        --lab-card-border: rgba(0, 0, 0, 0.08);
        --lab-text-main: #0f172a;
        --lab-text-muted: #64748b;
        --lab-gradient: linear-gradient(135deg, #0891b2 0%, #2563eb 50%, #7c3aed 100%);
        --lab-glow-cyan: rgba(6, 182, 212, 0.18);
        --lab-pill-bg: rgba(0, 0, 0, 0.05);
        --lab-pill-border: rgba(0, 0, 0, 0.1);
    }

    /* Override Variabel saat Dark Mode Aktif */
    [data-bs-theme="dark"], .dark {
        --lab-cyan: #38bdf8;
        --lab-cyan-bright: #06b6d4;
        --lab-cyan-subtle: rgba(6, 182, 212, 0.18);
        --lab-bg-body: #090d16;
        --lab-card-bg: rgba(15, 23, 42, 0.85);
        --lab-card-border: rgba(56, 189, 248, 0.18);
        --lab-text-main: #ffffff;
        --lab-text-muted: #94a3b8;
        --lab-gradient: linear-gradient(135deg, #06b6d4 0%, #3b82f6 50%, #8b5cf6 100%);
        --lab-glow-cyan: rgba(6, 182, 212, 0.25);
        --lab-pill-bg: rgba(255, 255, 255, 0.06);
        --lab-pill-border: rgba(255, 255, 255, 0.1);
    }

    body, #app, main {
        background-color: var(--lab-bg-body) !important;
        color: var(--lab-text-main) !important;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .admin-dashboard-fullwrapper {
        background-color: var(--lab-bg-body) !important;
        min-height: 100vh;
        width: 100%;
        padding: 2rem 3rem;
        box-sizing: border-box;
        color: var(--lab-text-main) !important;
        position: relative;
        overflow-x: hidden;
        transition: background-color 0.3s ease;
    }

    /* Text Gradient Highlight */
    .text-gradient-lab {
        background: var(--lab-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Ambient Glowing Elements */
    .ambient-glow-1 {
        position: absolute;
        top: 20px;
        left: 20px;
        width: 400px;
        height: 400px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(6, 182, 212, 0.12) 0%, rgba(9, 13, 22, 0) 70%);
        pointer-events: none;
        z-index: 0;
    }

    .ambient-glow-2 {
        position: absolute;
        bottom: 20px;
        right: 20px;
        width: 500px;
        height: 500px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(139, 92, 246, 0.1) 0%, rgba(9, 13, 22, 0) 70%);
        pointer-events: none;
        z-index: 0;
    }

    /* Glassmorphism Cards */
    .lab-glass-card {
        background: var(--lab-card-bg) !important;
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid var(--lab-card-border) !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .lab-glass-card:hover {
        transform: translateY(-5px);
        border-color: var(--lab-cyan) !important;
        box-shadow: 0 16px 40px var(--lab-glow-cyan);
    }

    /* Desain Indicator Cards */
    .indicator-card-modern {
        background: var(--lab-card-bg) !important;
        border: 1px solid var(--lab-card-border) !important;
        border-radius: 16px;
        padding: 16px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .indicator-card-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background: var(--lab-gradient);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .indicator-card-modern:hover {
        transform: translateY(-4px);
        border-color: var(--lab-cyan) !important;
        box-shadow: 0 12px 28px var(--lab-glow-cyan);
    }

    .indicator-card-modern:hover::before {
        opacity: 1;
    }

    /* Desain Tombol CTA */
    .btn-cta-primary {
        background: var(--lab-gradient);
        border: none;
        color: #ffffff !important;
        font-weight: 600;
        padding: 14px 32px;
        border-radius: 50px;
        box-shadow: 0 8px 24px rgba(6, 182, 212, 0.3);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-cta-primary:hover {
        opacity: 0.95;
        transform: translateY(-2px);
        box-shadow: 0 12px 32px rgba(6, 182, 212, 0.45);
    }

    .btn-cta-secondary {
        background: var(--lab-pill-bg);
        border: 1px solid var(--lab-pill-border);
        color: var(--lab-text-main) !important;
        font-weight: 600;
        padding: 14px 28px;
        border-radius: 50px;
        backdrop-filter: blur(8px);
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-cta-secondary:hover {
        border-color: var(--lab-cyan);
        color: var(--lab-cyan) !important;
        transform: translateY(-2px);
    }

    /* Icon Boxes */
    .icon-box-cyan {
        background: var(--lab-cyan-subtle);
        color: var(--lab-cyan);
        border: 1px solid var(--lab-card-border);
    }

    .icon-box-emerald {
        background: rgba(16, 185, 129, 0.12);
        color: #10b981;
        border: 1px solid rgba(16, 185, 129, 0.25);
    }

    .icon-box-amber {
        background: rgba(245, 158, 11, 0.12);
        color: #f59e0b;
        border: 1px solid rgba(245, 158, 11, 0.25);
    }

    .icon-box-rose {
        background: rgba(244, 63, 94, 0.12);
        color: #f43f5e;
        border: 1px solid rgba(244, 63, 94, 0.25);
    }

    /* Pulse dot */
    .pulse-dot {
        width: 8px;
        height: 8px;
        background-color: #10b981;
        border-radius: 50%;
        box-shadow: 0 0 10px #10b981;
        display: inline-block;
        animation: pulseGlow 1.8s infinite;
    }

    @keyframes pulseGlow {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.4); opacity: 0.5; }
    }

    .cartoon-card-box {
        background: var(--lab-card-bg) !important;
        border: 1px solid var(--lab-card-border) !important;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.08);
    }

    @keyframes cartoonFloat {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
    }

    @keyframes floatIcon1 {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-12px) rotate(6deg); }
    }

    @keyframes floatIcon2 {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-10px) rotate(-6deg); }
    }

    @keyframes scanBeamMove {
        0% { transform: translateY(-10px); opacity: 0.2; }
        50% { opacity: 0.85; }
        100% { transform: translateY(190px); opacity: 0.2; }
    }

    @keyframes armWave {
        0%, 100% { transform: rotate(0deg); }
        50% { transform: rotate(-6deg); }
    }

    @keyframes codePulse {
        0%, 100% { opacity: 0.4; }
        50% { opacity: 1; }
    }

    .anim-cartoon-character {
        transform-origin: bottom center;
        animation: cartoonFloat 4s ease-in-out infinite;
    }

    .anim-float-icon-1 {
        animation: floatIcon1 3.5s ease-in-out infinite;
    }

    .anim-float-icon-2 {
        animation: floatIcon2 4.2s ease-in-out infinite 0.5s;
    }

    .anim-scan-beam {
        animation: scanBeamMove 3.5s ease-in-out infinite;
    }

    .anim-arm-borrow {
        transform-origin: 220px 210px;
        animation: armWave 3s ease-in-out infinite;
    }

    .anim-code-blink {
        animation: codePulse 2s ease-in-out infinite;
    }

    .step-number-badge {
        width: 42px;
        height: 42px;
        background: var(--lab-gradient);
        color: #fff;
        font-weight: 700;
        font-size: 1.1rem;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px var(--lab-glow-cyan);
    }

    .lab-tag-pill {
        font-size: 0.72rem;
        padding: 4px 10px;
        border-radius: 20px;
        background: var(--lab-pill-bg);
        border: 1px solid var(--lab-pill-border);
        color: var(--lab-text-muted);
    }
</style>

<div class="admin-dashboard-fullwrapper">
    <!-- Ambient Glow Backgrounds -->
    <div class="ambient-glow-1"></div>
    <div class="ambient-glow-2"></div>

    <!-- Hero Section -->
    <section class="pt-2 pb-5 position-relative" style="z-index: 2;">
        <div class="container-fluid px-0">
            <div class="row align-items-center g-5">
                <!-- Sisi Kiri -->
                <div class="col-lg-6 text-start">
                    <span class="badge rounded-pill fw-semibold mb-3 px-3 py-2" style="background: var(--lab-cyan-subtle); color: var(--lab-cyan); border: 1px solid var(--lab-card-border);">
                        <i class="bi bi-door-open-fill me-1"></i> Sistem Peminjaman & Reservasi Lab Sekolah
                    </span>
                    
                    <h1 class="display-5 fw-extrabold mb-4 lh-sm" style="color: var(--lab-text-main);">
                        Kelola Akses & Peralatan Lab Sekolah Lebih <span class="text-gradient-lab">Efisien, Aman & Terstruktur</span>.
                    </h1>
                    
                    <p class="fs-6 mb-4 lh-base" style="color: var(--lab-text-muted);">
                        Platform terpadu untuk reservasi laboratorium kejuruan (<strong>Akuntansi, RPL, MPLB, Pemasaran</strong>) serta peminjaman alat praktik sekolah secara mandiri dengan verifikasi <em>real-time</em>.
                    </p>

                    <!-- Quick Indicator Cards -->
                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <div class="indicator-card-modern d-flex align-items-center gap-3 h-100">
                                <div class="icon-box-cyan p-2.5 rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 48px; height: 48px;">
                                    <i class="bi bi-calendar2-check-fill fs-4"></i>
                                </div>
                                <div>
                                    <div class="d-flex align-items-center gap-1.5 mb-0.5">
                                        <span class="fw-bold fs-6" style="color: var(--lab-text-main);">Jadwal Bebas Bentrok</span>
                                    </div>
                                    <span class="small d-block" style="color: var(--lab-text-muted); font-size: 0.82rem;">Slot waktu otomatis terkunci & presisi.</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="indicator-card-modern d-flex align-items-center gap-3 h-100">
                                <div class="icon-box-emerald p-2.5 rounded-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 48px; height: 48px;">
                                    <i class="bi bi-boxes fs-4"></i>
                                </div>
                                <div>
                                    <div class="d-flex align-items-center gap-1.5 mb-0.5">
                                        <span class="fw-bold fs-6" style="color: var(--lab-text-main);">Inventaris Alat & Unit</span>
                                    </div>
                                    <span class="small d-block" style="color: var(--lab-text-muted); font-size: 0.82rem;">Pelacakan kondisi barang *real-time*.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Call To Action Buttons -->
                    <div class="d-flex flex-wrap gap-3 align-items-center">
                        @php $currentUser = \App\Models\User::current(); @endphp
                        @if($currentUser)
                            <a href="{{ route('dashboard') }}" class="btn-cta-primary text-decoration-none">
                                <span>Buka Dashboard</span>
                                <i class="bi bi-arrow-right fs-5"></i>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn-cta-primary text-decoration-none">
                                <span>Ajukan Peminjaman</span>
                                <i class="bi bi-arrow-right fs-5"></i>
                            </a>
                            <a href="#panduan" class="btn-cta-secondary text-decoration-none">
                                <i class="bi bi-book me-1"></i>
                                <span>Cara Penggunaan</span>
                            </a>
                        @endif
                    </div>
                </div>
                
                <!-- Sisi Kanan: ILUSTRASI KARTUN SVG -->
                <div class="col-lg-6">
                    <div class="cartoon-card-box p-4 rounded-4 position-relative overflow-hidden">
                        <div class="d-flex align-items-center justify-content-between mb-2 position-relative" style="z-index: 5;">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge rounded-circle p-2 icon-box-cyan d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px;">
                                    <i class="bi bi-pc-display-horizontal fs-6"></i>
                                </span>
                                <div>
                                    <h6 class="fw-bold mb-0 fs-6" style="color: var(--lab-text-main);">Aktivitas Peminjaman Lab Kejuruan</h6>
                                    <span class="small" style="color: var(--lab-text-muted); font-size: 0.75rem;">Lab Akuntansi, RPL, MPLB & Pemasaran</span>
                                </div>
                            </div>
                            <span class="badge rounded-pill px-3 py-1.5 small fw-semibold d-flex align-items-center gap-2" style="background: rgba(16, 185, 129, 0.15); color: #10b981; border: 1px solid rgba(52, 211, 153, 0.3);">
                                <span class="pulse-dot"></span> Sesi Berlangsung
                            </span>
                        </div>

                        <div class="position-relative d-flex justify-content-center py-2" style="z-index: 3;">
                            <svg viewBox="0 0 500 340" class="w-100 h-auto" style="max-height: 310px;" xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <linearGradient id="glowCircle" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop offset="0%" stop-color="#06b6d4" stop-opacity="0.25"/>
                                        <stop offset="100%" stop-color="#3b82f6" stop-opacity="0.05"/>
                                    </linearGradient>
                                    <linearGradient id="deskGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                                        <stop offset="0%" stop-color="#1e293b"/>
                                        <stop offset="100%" stop-color="#0f172a"/>
                                    </linearGradient>
                                    <linearGradient id="scanBeamGrad" x1="0%" y1="0%" x2="0%" y2="100%">
                                        <stop offset="0%" stop-color="#06b6d4" stop-opacity="0.6"/>
                                        <stop offset="100%" stop-color="#06b6d4" stop-opacity="0"/>
                                    </linearGradient>
                                    <linearGradient id="screenGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop offset="0%" stop-color="#0284c7"/>
                                        <stop offset="100%" stop-color="#090d16"/>
                                    </linearGradient>
                                </defs>

                                <circle cx="250" cy="170" r="130" fill="url(#glowCircle)" />
                                <rect x="90" y="40" width="320" height="4" fill="url(#scanBeamGrad)" class="anim-scan-beam" rx="2" />

                                <rect x="50" y="240" width="400" height="18" rx="6" fill="url(#deskGrad)" stroke="#334155" stroke-width="2"/>
                                <rect x="70" y="258" width="20" height="50" fill="#0f172a"/>
                                <rect x="410" y="258" width="20" height="50" fill="#0f172a"/>

                                <!-- LAYAR MONITOR 1 (RPL) -->
                                <g transform="translate(75, 140)">
                                    <rect x="0" y="0" width="100" height="70" rx="6" fill="url(#screenGrad)" stroke="#38bdf8" stroke-width="2"/>
                                    <rect x="40" y="70" width="20" height="25" fill="#334155"/>
                                    <rect x="25" y="93" width="50" height="7" rx="2" fill="#475569"/>
                                    <line x1="12" y1="18" x2="50" y2="18" stroke="#38bdf8" stroke-width="3" stroke-linecap="round" class="anim-code-blink"/>
                                    <line x1="12" y1="28" x2="80" y2="28" stroke="#34d399" stroke-width="3" stroke-linecap="round"/>
                                    <line x1="12" y1="38" x2="65" y2="38" stroke="#f43f5e" stroke-width="3" stroke-linecap="round"/>
                                    <line x1="12" y1="48" x2="40" y2="48" stroke="#fbbf24" stroke-width="3" stroke-linecap="round"/>
                                </g>

                                <!-- LAYAR MONITOR 2 (AKUNTANSI & PEMASARAN) -->
                                <g transform="translate(325, 140)">
                                    <rect x="0" y="0" width="100" height="70" rx="6" fill="url(#screenGrad)" stroke="#10b981" stroke-width="2"/>
                                    <rect x="40" y="70" width="20" height="25" fill="#334155"/>
                                    <rect x="25" y="93" width="50" height="7" rx="2" fill="#475569"/>
                                    <rect x="20" y="42" width="10" height="18" fill="#34d399" rx="1"/>
                                    <rect x="38" y="30" width="10" height="30" fill="#38bdf8" rx="1"/>
                                    <rect x="56" y="22" width="10" height="38" fill="#a7f3d0" rx="1"/>
                                    <rect x="74" y="36" width="10" height="24" fill="#fbbf24" rx="1"/>
                                </g>

                                <!-- KARAKTER KARTUN SISWA SMK -->
                                <g class="anim-cartoon-character">
                                    <path d="M 210 240 L 215 175 C 215 155, 285 155, 285 175 L 290 240 Z" fill="#1e293b"/>
                                    <path d="M 238 158 L 250 180 L 262 158 Z" fill="#ffffff"/>
                                    <path d="M 247 165 L 253 165 L 252 200 L 248 200 Z" fill="#0284c7"/>

                                    <circle cx="250" cy="130" r="27" fill="#fbcfe8"/>
                                    <path d="M 222 128 C 222 95, 278 95, 278 128 C 272 110, 228 110, 222 128 Z" fill="#0f172a"/>
                                    <rect x="220" y="122" width="6" height="16" rx="2" fill="#38bdf8"/>
                                    <rect x="274" y="122" width="6" height="16" rx="2" fill="#38bdf8"/>
                                    <path d="M 223 122 C 223 100, 277 100, 277 122" fill="none" stroke="#38bdf8" stroke-width="3"/>

                                    <circle cx="241" cy="126" r="2.5" fill="#0f172a"/>
                                    <circle cx="259" cy="126" r="2.5" fill="#0f172a"/>
                                    <path d="M 243 138 Q 250 144 257 138" fill="none" stroke="#0f172a" stroke-width="2" stroke-linecap="round"/>

                                    <g class="anim-arm-borrow">
                                        <path d="M 220 170 L 180 200 L 195 215" fill="none" stroke="#1e293b" stroke-width="14" stroke-linecap="round"/>
                                        <rect x="155" y="185" width="42" height="55" rx="5" fill="#0f172a" stroke="#06b6d4" stroke-width="2" transform="rotate(12, 175, 210)"/>
                                        <rect x="160" y="192" width="32" height="30" rx="2" fill="#0284c7" transform="rotate(12, 175, 210)"/>
                                        <path d="M 168 206 L 173 211 L 182 201" fill="none" stroke="#ffffff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>

                                    <path d="M 280 170 L 310 205 L 300 220" fill="none" stroke="#1e293b" stroke-width="14" stroke-linecap="round"/>
                                </g>

                                <g transform="translate(190, 225)">
                                    <rect x="0" y="0" width="22" height="14" rx="2" fill="#334155" stroke="#94a3b8" stroke-width="1"/>
                                    <rect x="3" y="2" width="16" height="4" fill="#a7f3d0"/>
                                </g>
                                <g transform="translate(290, 228)">
                                    <ellipse cx="6" cy="6" rx="5" ry="7" fill="#475569"/>
                                </g>

                                <g transform="translate(60, 80)" class="anim-float-icon-1">
                                    <circle cx="20" cy="20" r="18" fill="rgba(6, 182, 212, 0.2)" stroke="#06b6d4" stroke-width="1.5"/>
                                    <text x="10" y="25" fill="#38bdf8" font-size="14" font-weight="bold" font-family="monospace">&lt;/&gt;</text>
                                </g>

                                <g transform="translate(410, 85)" class="anim-float-icon-2">
                                    <circle cx="20" cy="20" r="18" fill="rgba(16, 185, 129, 0.2)" stroke="#10b981" stroke-width="1.5"/>
                                    <path d="M 12 26 L 17 20 L 22 23 L 28 14" fill="none" stroke="#34d399" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </g>

                                <g transform="translate(170, 50)" class="anim-cartoon-character">
                                    <rect x="0" y="0" width="160" height="36" rx="18" fill="rgba(15, 23, 42, 0.9)" stroke="#38bdf8" stroke-width="1.5"/>
                                    <circle cx="18" cy="18" r="9" fill="#10b981"/>
                                    <path d="M 14 18 L 17 21 L 23 15" fill="none" stroke="#ffffff" stroke-width="2"/>
                                    <text x="34" y="22" fill="#ffffff" font-size="11" font-weight="bold" font-family="sans-serif">Pinjam Unit Lab OK</text>
                                </g>
                            </svg>
                        </div>

                        <!-- Footer Ringkas di Bawah Card -->
                        <div class="row g-2 mt-1 position-relative" style="z-index: 5;">
                            <div class="col-6">
                                <div class="p-2.5 rounded-3 d-flex align-items-center gap-2" style="background: var(--lab-pill-bg); border: 1px solid var(--lab-pill-border);">
                                    <i class="bi bi-person-badge-fill text-cyan fs-5"></i>
                                    <div>
                                        <span class="d-block fw-bold" style="font-size: 0.78rem; color: var(--lab-text-main);">Siswa / Guru</span>
                                        <span class="small" style="color: var(--lab-text-muted); font-size: 0.7rem;">Otorisasi Pengguna</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2.5 rounded-3 d-flex align-items-center gap-2" style="background: var(--lab-pill-bg); border: 1px solid var(--lab-pill-border);">
                                    <i class="bi bi-check-circle-fill text-emerald fs-5"></i>
                                    <div>
                                        <span class="d-block fw-bold" style="font-size: 0.78rem; color: var(--lab-text-main);">Log Digital</span>
                                        <span class="small" style="color: var(--lab-text-muted); font-size: 0.7rem;">Otomatis Terdata</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Showcase Kategori Lab -->
    <section id="kategori-lab" class="py-5 border-top border-secondary border-opacity-15">
        <div class="container-fluid px-0">
            <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-between mb-4 pb-2">
                <div>
                    <span class="badge rounded-pill px-3 py-1.5 fw-semibold mb-2" style="background: var(--lab-cyan-subtle); color: var(--lab-cyan); border: 1px solid var(--lab-card-border);">
                        Fasilitas Kejuruan
                    </span>
                    <h2 class="fw-extrabold mb-0 fs-3" style="color: var(--lab-text-main);">Pilihan Laboratorium Utama</h2>
                </div>
                <div class="mt-2 mt-md-0">
                    <span class="small d-flex align-items-center gap-2" style="color: var(--lab-text-muted);">
                        <i class="bi bi-shield-check text-emerald"></i> Terintegrasi dengan jadwal KBM & Praktikum Mandiri
                    </span>
                </div>
            </div>

            <!-- Daftar Lab Utama Sekolah (4 Kolom) -->
            <div class="row g-4">
                <!-- 1. Lab Akuntansi -->
                <div class="col-md-6 col-lg-3">
                    <div class="lab-glass-card p-4 rounded-4 h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="icon-box-emerald rounded-3 p-3 d-inline-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="bi bi-calculator-fill fs-4"></i>
                                </div>
                                <span class="badge rounded-pill px-2.5 py-1" style="background: rgba(16, 185, 129, 0.15); color: #10b981; font-size: 0.72rem;">Aktif</span>
                            </div>
                            <h5 class="fw-bold fs-5 mb-2" style="color: var(--lab-text-main);">Lab Akuntansi</h5>
                            <p class="small mb-4 lh-base" style="color: var(--lab-text-muted);">
                                Komputer Akuntansi, Software Keuangan (Accurate, MYOB), Kalkulator Finansial, dan fasilitas pencetakan laporan.
                            </p>
                        </div>
                        <div class="d-flex flex-wrap gap-1.5 pt-3 border-top border-secondary border-opacity-15">
                            <span class="lab-tag-pill">Software Accurate</span>
                            <span class="lab-tag-pill">MYOB</span>
                            <span class="lab-tag-pill">PC Akuntansi</span>
                        </div>
                    </div>
                </div>

                <!-- 2. Lab RPL -->
                <div class="col-md-6 col-lg-3">
                    <div class="lab-glass-card p-4 rounded-4 h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="icon-box-cyan rounded-3 p-3 d-inline-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="bi bi-code-slash fs-4"></i>
                                </div>
                                <span class="badge rounded-pill px-2.5 py-1" style="background: var(--lab-cyan-subtle); color: var(--lab-cyan); font-size: 0.72rem;">Aktif</span>
                            </div>
                            <h5 class="fw-bold fs-5 mb-2" style="color: var(--lab-text-main);">Lab RPL</h5>
                            <p class="small mb-4 lh-base" style="color: var(--lab-text-muted);">
                                Unit PC High-Spec, Server Lokal, IDE Pemrograman modern, serta jaringan LAN dedicated untuk praktikum coding.
                            </p>
                        </div>
                        <div class="d-flex flex-wrap gap-1.5 pt-3 border-top border-secondary border-opacity-15">
                            <span class="lab-tag-pill">PC High-Spec</span>
                            <span class="lab-tag-pill">Dev Tools</span>
                            <span class="lab-tag-pill">LAN Cepat</span>
                        </div>
                    </div>
                </div>

                <!-- 3. Lab MPLB -->
                <div class="col-md-6 col-lg-3">
                    <div class="lab-glass-card p-4 rounded-4 h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="icon-box-amber rounded-3 p-3 d-inline-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="bi bi-briefcase-fill fs-4"></i>
                                </div>
                                <span class="badge rounded-pill px-2.5 py-1" style="background: rgba(245, 158, 11, 0.15); color: #f59e0b; font-size: 0.72rem;">Aktif</span>
                            </div>
                            <h5 class="fw-bold fs-5 mb-2" style="color: var(--lab-text-main);">Lab MPLB</h5>
                            <p class="small mb-4 lh-base" style="color: var(--lab-text-muted);">
                                Fasilitas perkantoran modern, PC Perkantoran, Printer/Scanner multifungsi, interkom, dan unit penataan arsip.
                            </p>
                        </div>
                        <div class="d-flex flex-wrap gap-1.5 pt-3 border-top border-secondary border-opacity-15">
                            <span class="lab-tag-pill">Simulasi Kantor</span>
                            <span class="lab-tag-pill">Printer Scan</span>
                            <span class="lab-tag-pill">Arsip Digital</span>
                        </div>
                    </div>
                </div>

                <!-- 4. Lab Pemasaran -->
                <div class="col-md-6 col-lg-3">
                    <div class="lab-glass-card p-4 rounded-4 h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="icon-box-rose rounded-3 p-3 d-inline-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="bi bi-shop fs-4"></i>
                                </div>
                                <span class="badge rounded-pill px-2.5 py-1" style="background: rgba(244, 63, 94, 0.15); color: #f43f5e; font-size: 0.72rem;">Aktif</span>
                            </div>
                            <h5 class="fw-bold fs-5 mb-2" style="color: var(--lab-text-main);">Lab Pemasaran</h5>
                            <p class="small mb-4 lh-base" style="color: var(--lab-text-muted);">
                                Mesin Kasir POS, Barcode Scanner, Studio Live Streaming & Digital Marketing, serta peralatan Display/Visual Merchandising.
                            </p>
                        </div>
                        <div class="d-flex flex-wrap gap-1.5 pt-3 border-top border-secondary border-opacity-15">
                            <span class="lab-tag-pill">Mesin POS</span>
                            <span class="lab-tag-pill">Live Studio</span>
                            <span class="lab-tag-pill">Barcode Scanner</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Panduan Penggunaan Aplikasi -->
    <section id="panduan" class="py-5 border-top border-secondary border-opacity-15">
        <div class="container-fluid px-0">
            <div class="text-center mb-5">
                <span class="badge rounded-pill px-3 py-1.5 fw-semibold mb-2" style="background: rgba(139, 92, 246, 0.12); color: #a78bfa; border: 1px solid rgba(139, 92, 246, 0.25);">
                    Alur & Prosedur
                </span>
                <h2 class="fw-extrabold fs-3" style="color: var(--lab-text-main);">Cara Menggunakan SHEIN</h2>
                <p class="small mx-auto" style="max-width: 500px; color: var(--lab-text-muted);">Langkah mudah bagi siswa dan guru untuk melakukan reservasi laboratorium dan peminjaman alat praktik.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-3">
                    <div class="lab-glass-card p-4 rounded-4 h-100 position-relative">
                        <div class="step-number-badge mb-3">01</div>
                        <h5 class="fw-bold fs-6 mb-2" style="color: var(--lab-text-main);">Login Akun</h5>
                        <p class="small mb-0" style="color: var(--lab-text-muted);">Masuk menggunakan akun siswa, guru, atau petugas yang telah terdaftar di sistem sekolah.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="lab-glass-card p-4 rounded-4 h-100 position-relative">
                        <div class="step-number-badge mb-3">02</div>
                        <h5 class="fw-bold fs-6 mb-2" style="color: var(--lab-text-main);">Pilih Alat / Lab</h5>
                        <p class="small mb-0" style="color: var(--lab-text-muted);">Cari perangkat kejuruan (Akuntansi, RPL, MPLB, Pemasaran) atau slot laboratorium yang tersedia.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="lab-glass-card p-4 rounded-4 h-100 position-relative">
                        <div class="step-number-badge mb-3">03</div>
                        <h5 class="fw-bold fs-6 mb-2" style="color: var(--lab-text-main);">Ajukan Permintaan</h5>
                        <p class="small mb-0" style="color: var(--lab-text-muted);">Isi formulir peminjaman dan tunggu verifikasi secara real-time oleh petugas lab.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="lab-glass-card p-4 rounded-4 h-100 position-relative">
                        <div class="step-number-badge mb-3">04</div>
                        <h5 class="fw-bold fs-6 mb-2" style="color: var(--lab-text-main);">Pengembalian & Selesai</h5>
                        <p class="small mb-0" style="color: var(--lab-text-muted);">Kembalikan alat tepat waktu dengan kondisi baik untuk menutup status transaksi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-4 mt-4 border-top border-secondary border-opacity-15 text-center text-md-start">
        <div class="container-fluid px-0 d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
            <div class="d-flex align-items-center gap-2">
                <div class="icon-box-cyan rounded-3 p-1.5 d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">
                    <i class="bi bi-laptop fs-6"></i>
                </div>
                <span class="fw-bold small" style="color: var(--lab-text-main);">{{ config('app.name', 'SHEIN') }} — Sistem Inventaris Lab Sekolah</span>
            </div>
            <p class="small mb-0" style="color: var(--lab-text-muted);">&copy; {{ date('Y') }} SMK Kejuruan. Hak cipta dilindungi undang-undang.</p>
        </div>
    </footer>
</div>
@endsection