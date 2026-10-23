<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Pengembalian - {{ config('app.name', 'SHEIN') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        body {
            background-color: #ffffff !important;
            color: #0f172a !important;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 0.9rem;
        }

        /* Banner Tombol Aksi di Layar (Tidak ikut ter-print) */
        .print-bar {
            background-color: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            padding: 1rem 2rem;
            margin-bottom: 2rem;
        }

        /* Kop Laporan */
        .header-kop {
            border-bottom: 2px solid #0f172a;
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
        }

        /* Styling Tabel Laporan untuk Cetak High-Contrast */
        .table-report {
            border-color: #cbd5e1 !important;
        }

        .table-report th {
            background-color: #0f172a !important;
            color: #ffffff !important;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            padding: 0.75rem;
        }

        .table-report td {
            padding: 0.65rem;
            vertical-align: middle;
            color: #1e293b !important;
        }

        .badge-cond-baik { background-color: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .badge-cond-rusak { background-color: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }

        /* Media Print Rules */
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                padding: 0 !important;
                background-color: #ffffff !important;
            }
            .container {
                max-width: 100% !important;
                width: 100% !important;
                padding: 0 !important;
            }
            .table-report th {
                background-color: #0f172a !important;
                color: #ffffff !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .badge-cond-baik, .badge-cond-rusak {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body onload="window.print()">

    <!-- Bar Navigasi Tombol Aksi (Otomatis Sembunyi Saat Cetak/PDF) -->
    <div class="print-bar no-print d-flex justify-content-between align-items-center shadow-sm">
        <a href="{{ route('petugas.pengembalian.index') }}" class="btn btn-outline-secondary btn-sm rounded-3 fw-semibold d-inline-flex align-items-center gap-2">
            <i class="bi bi-arrow-left"></i> Kembali ke Data Pengembalian
        </a>
        <button onclick="window.print()" class="btn btn-primary btn-sm rounded-3 fw-semibold px-4 d-inline-flex align-items-center gap-2" style="background: linear-gradient(135deg, #06b6d4 0%, #3b82f6 100%); border: none;">
            <i class="bi bi-printer-fill"></i> Cetak / Simpan PDF
        </button>
    </div>

    <div class="container py-2">

        <!-- Kop Surat & Header Laporan -->
        <div class="text-center header-kop">
            <h3 class="fw-bold text-uppercase m-0 tracking-wide" style="color: #0f172a;">Laporan Pengembalian Perangkat Laboratorium</h3>
            <p class="text-secondary m-0 fw-semibold">Sistem Informasi Inventaris Laboratorium SHEIN</p>
            <div class="mt-2 text-muted small">
                <span><i class="bi bi-calendar3"></i> Dicetak pada: <strong>{{ date('d F Y H:i') }}</strong></span>
                <span class="mx-2">|</span>
                <span><i class="bi bi-person-badge"></i> Petugas: <strong>{{ $user->username ?? 'Petugas SHEIN' }}</strong></span>
            </div>
        </div>

        <!-- Tabel Data Pengembalian -->
        <div class="table-responsive">
            <table class="table table-bordered table-report align-middle mb-0">
                <thead>
                    <tr class="text-center">
                        <th width="5%">No</th>
                        <th width="15%">Tgl Kembali</th>
                        <th width="25%">Nama Peminjam</th>
                        <th width="30%">Nama Perangkat / Alat</th>
                        <th width="15%">Kondisi Barang</th>
                        <th width="10%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($datap as $index => $item)
                        @php
                            $peminjaman = $peminjamanList[$item->id_peminjaman] ?? null;
                            $namaUser = $peminjaman ? ($userList[$peminjaman->id_user] ?? 'Tidak diketahui') : 'Tidak diketahui';
                            $namaAlat = $peminjaman ? ($alatList[$peminjaman->id_alat] ?? 'Alat dihapus') : 'Alat dihapus';
                            $kondisi = strtolower($item->kondisi_barang ?? 'baik');
                        @endphp
                        <tr>
                            <td class="text-center fw-semibold text-secondary">{{ $index + 1 }}</td>
                            <td class="text-center">{{ date('d/m/Y', strtotime($item->tanggal_pengembalian)) }}</td>
                            <td class="fw-medium">{{ $namaUser }}</td>
                            <td class="fw-medium">{{ $namaAlat }}</td>
                            <td class="text-center">
                                @if($kondisi == 'baik')
                                    <span class="badge badge-cond-baik px-2.5 py-1.5 rounded-2 fw-semibold">Baik</span>
                                @else
                                    <span class="badge badge-cond-rusak px-2.5 py-1.5 rounded-2 fw-semibold">{{ ucfirst($item->kondisi_barang) }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <span class="fw-bold text-success" style="font-size: 0.85rem;">Selesai</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Belum ada data transaksi pengembalian alat yang tercatat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Area Tanda Tangan Laporan -->
        <div class="row mt-5 pt-3">
            <div class="col-7"></div>
            <div class="col-5 text-center">
                <p class="mb-1 text-secondary small">Mengetahui,</p>
                <p class="mb-5 fw-semibold">Petugas Pengelola Lab SHEIN</p>
                <br>
                <p class="fw-bold border-bottom border-dark pb-1 mb-0 d-inline-block px-4">{{ $user->username ?? 'Petugas SHEIN' }}</p>
                <div><small class="text-muted">NIP. ........................................</small></div>
            </div>
        </div>

    </div>

</body>
</html>