@extends('layouts.admin')

@section('content')
<div class="pb-5">
    <!-- Hero / Welcome Banner -->
    <div class="card card-dark border-0 mb-4 overflow-hidden shadow-sm" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); border: 1px solid #334155 !important;">
        <div class="card-body p-4 p-lg-5 position-relative">
            <div class="row align-items-center position-relative z-1">
                <div class="col-lg-8">
                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-semibold mb-3 border border-success border-opacity-25">
                        <i class="bi bi-stars me-1"></i> System Active
                    </span>
                    <h2 class="fw-bold text-white mb-2 fs-2">Selamat Datang di Dashboard Admin</h2>
                    <p class="mb-4" style="color: #94a3b8;">
                        Kelola katalog produk, pantau ketersediaan stok, dan akses fitur utama toko bola kamu secara ringkas dari satu tempat.
                    </p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('products.index') }}" class="btn btn-primary btn-modern px-4 py-2">
                            <i class="bi bi-bag-check-fill me-1"></i> Kelola Produk
                        </a>
                        <a href="{{ route('products.create') }}" class="btn btn-outline-light btn-modern px-4 py-2">
                            <i class="bi bi-plus-lg me-1"></i> Tambah Produk Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat Cards Section -->
    <div class="row g-4 mb-4">
        <!-- Total Produk -->
        <div class="col-md-4">
            <div class="card card-dark p-3 h-100 shadow-sm" style="background: #1e293b; border: 1px solid #334155; border-radius: 16px;">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-uppercase fs-7 fw-semibold mb-1" style="color: #94a3b8; letter-spacing: 0.5px;">Total Produk</p>
                        <h2 class="fw-bold text-white mb-0 display-6">{{ $totalProducts }}</h2>
                    </div>
                    <div class="rounded-4 p-3 d-flex align-items-center justify-content-center" style="background: rgba(14, 165, 233, 0.15); color: #38bdf8; width: 60px; height: 60px;">
                        <i class="bi bi-box-seam fs-2"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Produk Aktif -->
        <div class="col-md-4">
            <div class="card card-dark p-3 h-100 shadow-sm" style="background: #1e293b; border: 1px solid #334155; border-radius: 16px;">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-uppercase fs-7 fw-semibold mb-1" style="color: #94a3b8; letter-spacing: 0.5px;">Produk Aktif</p>
                        <h2 class="fw-bold text-white mb-0 display-6">{{ $activeProducts }}</h2>
                    </div>
                    <div class="rounded-4 p-3 d-flex align-items-center justify-content-center" style="background: rgba(16, 185, 129, 0.15); color: #34d399; width: 60px; height: 60px;">
                        <i class="bi bi-check-circle fs-2"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stok Habis -->
        <div class="col-md-4">
            <div class="card card-dark p-3 h-100 shadow-sm" style="background: #1e293b; border: 1px solid #334155; border-radius: 16px;">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-uppercase fs-7 fw-semibold mb-1" style="color: #94a3b8; letter-spacing: 0.5px;">Stok Habis</p>
                        <h2 class="fw-bold text-white mb-0 display-6">{{ $outOfStock }}</h2>
                    </div>
                    <div class="rounded-4 p-3 d-flex align-items-center justify-content-center" style="background: rgba(239, 68, 68, 0.15); color: #f87171; width: 60px; height: 60px;">
                        <i class="bi bi-exclamation-triangle fs-2"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions & System Info -->
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card card-dark h-100 shadow-sm" style="background: #1e293b; border: 1px solid #334155; border-radius: 16px;">
                <div class="card-header bg-transparent py-3 px-4 border-bottom d-flex align-items-center justify-content-between" style="border-color: #334155 !important;">
                    <h6 class="fw-bold text-white mb-0 d-flex align-items-center gap-2">
                        <i class="bi bi-lightning-charge text-warning"></i> Akses Cepat
                    </h6>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <a href="{{ route('products.index') }}" class="text-decoration-none">
                                <div class="p-3 rounded-3 d-flex align-items-center gap-3" style="background: #0f172a; border: 1px solid #334155; transition: transform 0.2s ease;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                                    <div class="rounded-3 p-2 text-primary" style="background: rgba(59, 130, 246, 0.1);">
                                        <i class="bi bi-table fs-4"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-white">Lihat Data Produk</div>
                                        <small style="color: #94a3b8;">Kelola & edit daftar stok</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{ route('products.create') }}" class="text-decoration-none">
                                <div class="p-3 rounded-3 d-flex align-items-center gap-3" style="background: #0f172a; border: 1px solid #334155; transition: transform 0.2s ease;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                                    <div class="rounded-3 p-2 text-success" style="background: rgba(16, 185, 129, 0.1);">
                                        <i class="bi bi-plus-square fs-4"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-white">Tambah Produk</div>
                                        <small style="color: #94a3b8;">Input barang baru ke sistem</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-dark h-100 shadow-sm" style="background: #1e293b; border: 1px solid #334155; border-radius: 16px;">
                <div class="card-header bg-transparent py-3 px-4 border-bottom" style="border-color: #334155 !important;">
                    <h6 class="fw-bold text-white mb-0 d-flex align-items-center gap-2">
                        <i class="bi bi-info-circle text-info"></i> Ringkasan Sistem
                    </h6>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom" style="border-color: #334155 !important;">
                        <span style="color: #94a3b8;">Framework</span>
                        <span class="badge bg-secondary-subtle text-white border border-secondary">Laravel {{ app()->version() }}</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom" style="border-color: #334155 !important;">
                        <span style="color: #94a3b8;">Database Status</span>
                        <span class="text-success fw-semibold"><i class="bi bi-check-circle-fill me-1"></i> Terhubung</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <span style="color: #94a3b8;">Tema Visual</span>
                        <span class="badge bg-success-subtle text-success border border-success border-opacity-25">Dark Slate</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection