<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Alat;

class PengembalianController extends Controller
{
    // 1. Tampil Halaman Index (Daftar Pengembalian)
    public function index(Request $request)
    {
        $datap = Pengembalian::orderBy('id_pengembalian', 'desc')->paginate(10);

        $peminjaman = Peminjaman::all();
        $users = User::all();
        $alats = Alat::all();

        $peminjamanList = [];
        foreach ($peminjaman as $p) {
            $pid = $p->id_peminjaman ?? $p->id;
            $peminjamanList[$pid] = $p;
        }

        $userList = [];
        foreach ($users as $u) {
            $id = $u->id ?? $u->id_user;
            $userList[$id] = $u->username ?? $u->nama ?? "User #{$id}";
        }

        $alatList = [];
        foreach ($alats as $a) {
            $id = $a->id_alat ?? $a->id;
            $alatList[$id] = $a->nama_alat ?? "Alat #{$id}";
        }

        return view('pengembalian.index', compact('datap', 'peminjamanList', 'userList', 'alatList'));
    }

    // 2. Tampil Form Tambah Pengembalian
    public function create(Request $request)
    {
        $peminjaman = Peminjaman::where('status', '!=', 'Dikembalikan')->get();
        $users = User::all();
        $alats = Alat::all();

        $userList = [];
        foreach ($users as $u) {
            $id = $u->id ?? $u->id_user;
            $userList[$id] = $u->username ?? $u->nama ?? "User #{$id}";
        }

        $alatList = [];
        foreach ($alats as $a) {
            $id = $a->id_alat ?? $a->id;
            $alatList[$id] = $a->nama_alat ?? "Alat #{$id}";
        }

        return view('pengembalian.create', compact('peminjaman', 'userList', 'alatList'));
    }

    // 3. Simpan Data Pengembalian Baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_peminjaman'        => 'required|integer',
            'tanggal_pengembalian' => 'required|date',
            'terlambat_hari'       => 'nullable|integer|min:0',
            'denda'                => 'nullable|integer|min:0',
            'kondisi_barang'       => 'nullable|string|max:100',
            'catatan'              => 'nullable|string',
        ]);

        $validatedData['terlambat_hari'] = $validatedData['terlambat_hari'] ?? 0;
        $validatedData['denda']          = $validatedData['denda'] ?? 0;
        $validatedData['kondisi_barang'] = $validatedData['kondisi_barang'] ?? 'Baik';

        Pengembalian::create($validatedData);

        // Update status di tabel peminjaman menjadi 'Dikembalikan'
        $peminjaman = Peminjaman::findOrFail($validatedData['id_peminjaman']);
        $peminjaman->update(['status' => 'Dikembalikan']);

        return redirect(route('pengembalian.index'))->with('success', 'Data pengembalian berhasil ditambahkan.');
    }

    // 4. Tampil Form Edit Pengembalian (Perbaikan Query User & Alat)
    public function edit(Request $request, $id_pengembalian)
    {
        $datap = Pengembalian::findOrFail($id_pengembalian);
        $peminjaman = Peminjaman::find($datap->id_peminjaman);

        $peminjamName = '-';
        $alatName = '-';

        if ($peminjaman) {
            // Ambil User berdasarkan Primary Key
            $user = User::find($peminjaman->id_user);

            // Ambil Alat berdasarkan Primary Key atau id_alat
            $alat = Alat::find($peminjaman->id_alat);
            if (!$alat) {
                $alat = Alat::where('id_alat', $peminjaman->id_alat)->first();
            }

            $peminjamName = $user->username ?? $user->nama ?? ("User #" . $peminjaman->id_user);
            $alatName = $alat->nama_alat ?? ("Alat #" . $peminjaman->id_alat);
        }

        return view('pengembalian.edit', compact('datap', 'peminjaman', 'peminjamName', 'alatName'));
    }

    // 5. Update Data Pengembalian
    public function update(Request $request, $id_pengembalian)
    {
        $validatedData = $request->validate([
            'id_peminjaman'        => 'required|integer',
            'tanggal_pengembalian' => 'required|date',
            'terlambat_hari'       => 'nullable|integer|min:0',
            'denda'                => 'nullable|integer|min:0',
            'kondisi_barang'       => 'nullable|string|max:100',
            'catatan'              => 'nullable|string',
        ]);

        $pengembalian = Pengembalian::findOrFail($id_pengembalian);
        $pengembalian->update($validatedData);

        return redirect(route('pengembalian.index'))->with('success', 'Data pengembalian berhasil diubah.');
    }

    // 6. Hapus Data Pengembalian
    public function delete(Request $request, $id_pengembalian)
    {
        $pengembalian = Pengembalian::findOrFail($id_pengembalian);
        $pengembalian->delete();

        return redirect(route('pengembalian.index'))->with('success', 'Data pengembalian berhasil dihapus.');
    }
}