@extends('layouts.app')

@section('title', config('app.name') . ' -- Peminjaman Alat')

@section('content')

    {{-- Hero --}}
    <section class="text-center py-4 py-lg-5">
        <span class="badge rounded-pill badge-brand px-3 py-2 mb-3">IVENTORY LAB</span>

        <h1 class="display-5 fw-bold mb-3">
            INVENTORY LAB,<br class="d-none d-md-inline">
            <span class="text-brand">SMK KUR KUR SANGKUR</span>
        </h1>

        <p class="lead text-secondary mx-auto mb-4" style="max-width: 620px;">
            menyediakan peminjaman untuk lab sekolah
        </p>
        <div class="card">
  <h5 class="card-header">Kategori</h5>
  <div class="card-body">
    <h5 class="card-title">Untuk Melihat Kategori</h5>
    <p class="card-text">hh</p>
    <a href="{{ route('kategori.index') }}" class="btn btn-primary">Klik</a>
  </div>
  <div class="row">
  <div class="col-sm-6 mb-3 mb-sm-0">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>
</div>
<h>
</div>
    </section>
@endsection
    