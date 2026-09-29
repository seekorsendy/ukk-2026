@extends('layouts.app')

@section('title', config('app.name') . ' -- Data Pengembalian')

@section('content')
<div class="container-fluid py-4 px-4">

    <!-- Flash Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center" role="alert">
            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Header Halaman & Tombol Tambah -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold mb-1 tracking-tight">Data Pengembalian</h3>
            <p class="text-body-secondary small mb-0">Kelola riwayat pengembalian barang dan denda keterlambatan.</p>
        </div>
        <a href="{{ route('pengembalian.create') }}" class="btn btn-primary btn-sm px-3 py-2 rounded-3 shadow-sm d-inline-flex align-items-center gap-2 fw-medium">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Pengembalian</span>
        </a>
    </div>

    <!-- Tabel Data Pengembalian -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center" style="width: 50px;">NO</th>
                        <th>PEMINJAM & ALAT</th>
                        <th>TGL PENGEMBALIAN</th>
                        <th>TERLAMBAT</th>
                        <th>DENDA</th>
                        <th>KONDISI BARANG</th>
                        <th>CATATAN</th>
                        <th class="text-center" style="width: 150px;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($datap as $index => $d)
                        @php
                            $p = $peminjamanList[$d->id_peminjaman] ?? null;
                            $uname = $p ? ($userList[$p->id_user] ?? '-') : '-';
                            $alatName = $p ? ($alatList[$p->id_alat] ?? '-') : '-';

                            $kondisi = $d->kondisi_barang ?? 'Baik';
                            $badgeKondisi = match($kondisi) {
                                'Baik' => 'bg-success-subtle text-success border border-success-subtle',
                                'Rusak Ringan' => 'bg-warning-subtle text-warning border border-warning-subtle',
                                'Rusak Berat', 'Hilang' => 'bg-danger-subtle text-danger border border-danger-subtle',
                                default => 'bg-secondary-subtle text-light border border-secondary'
                            };
                        @endphp
                        <tr>
                            <td class="text-center fw-medium text-body-secondary">{{ $index + 1 }}</td>
                            
                            <td>
                                <div class="fw-semibold text-body">{{ $uname }}</div>
                                <div class="small text-body-secondary">{{ $alatName }} <span class="badge bg-secondary-subtle text-secondary rounded-pill">#{{ $d->id_peminjaman }}</span></div>
                            </td>

                            <td>{{ $d->tanggal_pengembalian }}</td>

                            <td>
                                @if($d->terlambat_hari > 0)
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2 py-1">
                                        {{ $d->terlambat_hari }} Hari
                                    </span>
                                @else
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1">
                                        Tepat Waktu
                                    </span>
                                @endif
                            </td>

                            <td class="fw-semibold text-danger">
                                Rp {{ number_format($d->denda, 0, ',', '.') }}
                            </td>

                            <td>
                                <span class="badge {{ $badgeKondisi }} px-2 py-1 rounded-pill fw-medium">
                                    {{ $kondisi }}
                                </span>
                            </td>

                            <td class="text-body-secondary small">{{ $d->catatan ?? '-' }}</td>

                            <td class="text-center">
                                <div class="d-inline-flex gap-1">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('pengembalian.edit', [$d->id_pengembalian]) }}" class="btn btn-sm btn-outline-warning rounded-2 px-2 py-1" title="Edit">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    <!-- Tombol Hapus (Tanpa @method('DELETE') agar tidak error 405) -->
                                    <form action="{{ route('pengembalian.delete', [$d->id_pengembalian]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-2 px-2 py-1" title="Hapus">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-body-secondary">
                                <i class="bi bi-inbox fs-1 d-block mb-2 text-muted"></i>
                                Belum ada data pengembalian.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection