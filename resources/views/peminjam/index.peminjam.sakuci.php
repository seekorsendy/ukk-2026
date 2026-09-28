@extends('layouts.app')

@section('title', config('app.name') . ' -- Riwayat Pengajuan Peminjaman')

@section('content')
<div class="container-fluid py-4">
    
    <!-- Header Halaman & Tombol Ajukan Baru -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Riwayat Peminjaman Alat</h2>
            <p class="text-muted small mb-0">Daftar pengajuan peminjaman alat yang telah Anda kirimkan.</p>
        </div>
        <a href="{{ route('peminjam.createPeminjam') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Ajukan Peminjaman Baru
        </a>
    </div>

    <!-- Card Pembungkus Tabel -->
    <div class="card border shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-secondary text-uppercase fs-7">
                        <tr>
                            <th class="py-3 px-4" style="width: 5%;">No</th>
                            <th class="py-3">Nama Alat</th>
                            <th class="py-3">Jumlah</th>
                            <th class="py-3">Tgl Pinjam</th>
                            <th class="py-3">Tgl Kembali</th>
                            <th class="py-3">Status</th>
                            <th class="py-3">Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @forelse ($datap as $peminjaman)
                        <tr>
                            <td class="px-4 text-muted fw-semibold">{{ $no++ }}</td>
                            <td>
                                <span class="fw-semibold">{{ $peminjaman->alat->nama_alat ?? $peminjaman->alat->nama ?? 'Alat ID: ' . $peminjaman->id_alat }}</span>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border px-2 py-1">{{ $peminjaman->jumlah }} Unit</span>
                            </td>
                            <td>
                                <span class="text-muted">{{ $peminjaman->tanggal_pinjam }}</span>
                            </td>
                            <td>
                                <span class="text-muted">{{ $peminjaman->tanggal_kembali ?? '-' }}</span>
                            </td>
                            <td>
                                @if($peminjaman->status == 'Pending')
                                    <span class="badge bg-warning text-dark px-2 py-1">Pending (Menunggu)</span>
                                @elseif($peminjaman->status == 'Disetujui')
                                    <span class="badge bg-info text-dark px-2 py-1">Disetujui</span>
                                @elseif($peminjaman->status == 'Ditolak')
                                    <span class="badge bg-danger px-2 py-1">Ditolak</span>
                                @elseif($peminjaman->status == 'Dipinjam')
                                    <span class="badge bg-primary px-2 py-1">Sedang Dipinjam</span>
                                @else
                                    <span class="badge bg-success px-2 py-1">Dikembalikan</span>
                                @endif
                            </td>
                            <td>
                                <span class="text-danger fw-semibold">Rp {{ number_format($peminjaman->denda ?? 0, 0, ',', '.') }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Belum ada riwayat pengajuan peminjaman alat.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Bagian Pagination -->
        @if(method_exists($datap, 'hasPages') && $datap->hasPages())
        <div class="card-footer py-3 border-top d-flex justify-content-end">
            {!! $datap->links() !!}
        </div>
        @endif
    </div>

</div>
@endsection