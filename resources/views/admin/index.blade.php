@extends('layouts.admin')

@section('content')
<div class="pb-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h2 class="fw-bold text-white mb-1">Admin Panel</h2>
            <p class="text-secondary mb-0">Kelola operasional toko, produk, dan transaksi secara terpusat.</p>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-success btn-modern px-4 py-2">
            <i class="bi bi-plus-lg me-1"></i> Tambah Produk
        </a>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card card-dark h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-secondary small text-uppercase">Produk</span>
                        <i class="bi bi-bag-check-fill text-success fs-4"></i>
                    </div>
                    <h3 class="fw-bold text-white mb-0">{{ App\Models\Product::count() }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-dark h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-secondary small text-uppercase">Stok aktif</span>
                        <i class="bi bi-box-seam text-primary fs-4"></i>
                    </div>
                    <h3 class="fw-bold text-white mb-0">{{ App\Models\Product::where('is_active', true)->count() }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-dark h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-secondary small text-uppercase">Stok habis</span>
                        <i class="bi bi-exclamation-triangle text-warning fs-4"></i>
                    </div>
                    <h3 class="fw-bold text-white mb-0">{{ App\Models\Product::where('stock', 0)->count() }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-dark h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-secondary small text-uppercase">Kasir</span>
                        <i class="bi bi-cart-fill text-info fs-4"></i>
                    </div>
                    <h3 class="fw-bold text-white mb-0">{{ App\Models\User::where('role', 'kasir')->count() }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card card-dark h-100">
                <div class="card-header border-bottom border-secondary bg-transparent px-4 py-3">
                    <h6 class="fw-bold text-white mb-0"><i class="bi bi-lightning-charge text-warning me-2"></i>Shortcut</h6>
                </div>
                <div class="card-body p-4">
                    <div class="d-grid gap-3">
                        <a href="{{ route('products.index') }}" class="btn btn-outline-light text-start btn-modern">
                            <i class="bi bi-bag-check-fill me-2"></i> Kelola Produk
                        </a>
                        <a href="{{ route('kasir.index') }}" class="btn btn-outline-light text-start btn-modern">
                            <i class="bi bi-cart-fill me-2"></i> Halaman Kasir
                        </a>
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-light text-start btn-modern">
                            <i class="bi bi-speedometer2 me-2"></i> Dashboard Utama
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card card-dark h-100">
                <div class="card-header border-bottom border-secondary bg-transparent px-4 py-3">
                    <h6 class="fw-bold text-white mb-0"><i class="bi bi-info-circle text-info me-2"></i>Catatan Admin</h6>
                </div>
                <div class="card-body p-4 text-secondary">
                    <p class="mb-3">Selamat bekerja di panel admin. Fitur utama yang sering dipakai:</p>
                    <ul class="mb-0 ps-3">
                        <li>Kelola daftar produk dan stok</li>
                        <li>Monitor status barang aktif dan habis</li>
                        <li>Buka halaman kasir untuk transaksi penjualan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
