@extends('layouts.admin')

@section('content')
<div class="pb-5">
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <div class="card card-dark h-100 border-0" style="background: linear-gradient(135deg, rgba(16,185,129,0.18), rgba(17,24,39,0.95));">
                    <div class="card-body p-4 d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-uppercase small text-success fw-semibold mb-2">Admin</div>
                            <h5 class="text-white mb-0 fw-bold">Admin Panel</h5>
                        </div>
                        <div class="rounded-3 p-3" style="background: rgba(16,185,129,0.12); color: #34d399;">
                            <i class="bi bi-speedometer2 fs-4"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('kasir.index') }}" class="text-decoration-none">
                <div class="card card-dark h-100 border-0" style="background: linear-gradient(135deg, rgba(59,130,246,0.18), rgba(17,24,39,0.95));">
                    <div class="card-body p-4 d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-uppercase small text-primary fw-semibold mb-2">Kasir</div>
                            <h5 class="text-white mb-0 fw-bold">Transaksi</h5>
                        </div>
                        <div class="rounded-3 p-3" style="background: rgba(59,130,246,0.12); color: #7dd3fc;">
                            <i class="bi bi-cart-fill fs-4"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('products.index') }}" class="text-decoration-none">
                <div class="card card-dark h-100 border-0" style="background: linear-gradient(135deg, rgba(250,204,21,0.16), rgba(17,24,39,0.95));">
                    <div class="card-body p-4 d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-uppercase small text-warning fw-semibold mb-2">Produk</div>
                            <h5 class="text-white mb-0 fw-bold">Kelola Barang</h5>
                        </div>
                        <div class="rounded-3 p-3" style="background: rgba(250,204,21,0.12); color: #fcd34d;">
                            <i class="bi bi-bag-check-fill fs-4"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="card card-dark overflow-hidden mb-4" style="background: linear-gradient(135deg, rgba(16,185,129,0.12), rgba(15,23,42,1)); border: 1px solid rgba(148,163,184,0.2);">
        <div class="card-body p-4 p-lg-5">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-semibold mb-3 border border-success border-opacity-25">
                        <i class="bi bi-stars me-1"></i> System Active
                    </span>
                    <h2 class="fw-bold text-white mb-2 fs-2">Selamat Datang di Dashboard Admin</h2>
                    <p class="mb-4 text-secondary">
                        Kelola katalog produk, pantau ketersediaan stok, dan akses fitur utama toko bola secara ringkas dari satu panel.
                    </p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('products.index') }}" class="btn btn-success btn-modern px-4 py-2">
                            <i class="bi bi-bag-check-fill me-1"></i> Kelola Produk
                        </a>
                        <a href="{{ route('products.create') }}" class="btn btn-outline-light btn-modern px-4 py-2">
                            <i class="bi bi-plus-lg me-1"></i> Tambah Produk Baru
                        </a>
                        <button type="button" id="test-order-alert" class="btn btn-warning btn-modern px-4 py-2 text-dark">
                            <i class="bi bi-bell-fill me-1"></i> Coba Notifikasi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card card-dark h-100">
                <div class="card-body d-flex align-items-center justify-content-between p-4">
                    <div>
                        <p class="text-uppercase mb-1 small text-secondary">Total Produk</p>
                        <h2 class="fw-bold text-white mb-0 display-6">{{ $totalProducts }}</h2>
                    </div>
                    <div class="rounded-4 p-3" style="background: rgba(56,189,248,0.14); color: #7dd3fc; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-box-seam fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-dark h-100">
                <div class="card-body d-flex align-items-center justify-content-between p-4">
                    <div>
                        <p class="text-uppercase mb-1 small text-secondary">Produk Aktif</p>
                        <h2 class="fw-bold text-white mb-0 display-6">{{ $activeProducts }}</h2>
                    </div>
                    <div class="rounded-4 p-3" style="background: rgba(16,185,129,0.12); color: #34d399; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-check-circle fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-dark h-100">
                <div class="card-body d-flex align-items-center justify-content-between p-4">
                    <div>
                        <p class="text-uppercase mb-1 small text-secondary">Stok Habis</p>
                        <h2 class="fw-bold text-white mb-0 display-6">{{ $outOfStock }}</h2>
                    </div>
                    <div class="rounded-4 p-3" style="background: rgba(239,68,68,0.12); color: #fca5a5; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-exclamation-triangle fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card card-dark h-100">
                <div class="card-header border-bottom border-secondary bg-transparent px-4 py-3">
                    <h6 class="fw-bold text-white mb-0"><i class="bi bi-lightning-charge text-warning me-2"></i>Akses Cepat</h6>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <a href="{{ route('products.index') }}" class="text-decoration-none">
                                <div class="p-3 rounded-3" style="background: rgba(148,163,184,0.04); border: 1px solid rgba(148,163,184,0.15);">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-3 p-2 text-primary" style="background: rgba(59,130,246,0.12);">
                                            <i class="bi bi-table fs-4"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-white">Lihat Data Produk</div>
                                            <small class="text-secondary">Kelola & edit daftar stok</small>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{ route('products.create') }}" class="text-decoration-none">
                                <div class="p-3 rounded-3" style="background: rgba(148,163,184,0.04); border: 1px solid rgba(148,163,184,0.15);">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-3 p-2 text-success" style="background: rgba(16,185,129,0.12);">
                                            <i class="bi bi-plus-square fs-4"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-white">Tambah Produk</div>
                                            <small class="text-secondary">Input barang baru ke sistem</small>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-dark h-100">
                <div class="card-header border-bottom border-secondary bg-transparent px-4 py-3">
                    <h6 class="fw-bold text-white mb-0"><i class="bi bi-info-circle text-info me-2"></i>Ringkasan Sistem</h6>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom border-secondary">
                        <span class="text-secondary">Framework</span>
                        <span class="badge bg-secondary-subtle text-white border border-secondary">Laravel {{ app()->version() }}</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom border-secondary">
                        <span class="text-secondary">Database Status</span>
                        <span class="text-success fw-semibold"><i class="bi bi-check-circle-fill me-1"></i> Terhubung</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="text-secondary">Tema Visual</span>
                        <span class="badge bg-success-subtle text-success border border-success border-opacity-25">Dark Slate</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection