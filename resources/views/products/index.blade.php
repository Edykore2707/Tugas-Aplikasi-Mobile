@extends('layouts.admin')

@section('content')
<div class="pb-5">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-white mb-1">Products</h2>
            <p class="small mb-0" style="color: #94a3b8;">Kelola katalog dan informasi stok produk Toko Bola</p>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-primary btn-modern px-4 py-2">
            <i class="bi bi-plus-lg me-1"></i> Tambah Product
        </a>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="alert alert-success bg-success text-white border-0 shadow-sm rounded-3 fade show d-flex align-items-center gap-2 mb-4" role="alert">
            <i class="bi bi-check-circle-fill fs-5"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    <!-- Card Table Container -->
    <div class="card card-dark overflow-hidden shadow-sm">
        <div class="card-header bg-transparent py-3 px-4 border-bottom d-flex align-items-center justify-content-between" style="border-color: #334155 !important;">
            <h6 class="fw-bold text-white mb-0 d-flex align-items-center gap-2">
                <i class="bi bi-list-ul text-primary"></i> Data Product
            </h6>
        </div>
        
        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle mb-0" style="--bs-table-bg: transparent; --bs-table-border-color: #334155;">
                <thead style="background-color: #0f172a;" class="text-uppercase fs-7">
                    <tr>
                        <th class="py-3 px-4 text-center" style="width: 60px; color: #94a3b8;">No</th>
                        <th class="py-3 text-center" style="width: 90px; color: #94a3b8;">Gambar</th>
                        <th class="py-3" style="color: #94a3b8;">Product</th>
                        <th class="py-3" style="color: #94a3b8;">Kategori</th>
                        <th class="py-3" style="color: #94a3b8;">Harga</th>
                        <th class="py-3 text-center" style="color: #94a3b8;">Stock</th>
                        <th class="py-3 text-center" style="color: #94a3b8;">Status</th>
                        <th class="py-3 text-center" style="width: 220px; color: #94a3b8;">Aksi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse ($products as $product)
                        <tr>
                            <td class="text-center fw-semibold" style="color: #94a3b8;">
                                {{ $loop->iteration }}
                            </td>
                            <td class="text-center">
                                @if($product->image && filter_var($product->image, FILTER_VALIDATE_URL))
                                    <img src="{{ $product->image }}" 
                                         alt="{{ $product->name }}" 
                                         class="rounded-3 shadow-sm border border-secondary" 
                                         style="width: 48px; height: 48px; object-fit: cover;"
                                         onerror="this.onerror=null; this.src='https://placehold.co/100x100/334155/f8fafc?text=Bola';">
                                @else
                                    <div class="rounded-3 d-inline-flex align-items-center justify-content-center text-secondary border border-secondary" style="width: 48px; height: 48px; background-color: #0f172a;">
                                        <i class="bi bi-image fs-5" style="color: #94a3b8;"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold text-white mb-0 fs-6">{{ $product->name }}</div>
                                <small class="d-block text-truncate" style="max-width: 280px; color: #94a3b8;">
                                    {{ $product->description ?? 'Tidak ada deskripsi' }}
                                </small>
                            </td>
                            <td>
                                <span class="badge border px-3 py-2 rounded-pill font-monospace fw-normal" style="background-color: #334155; color: #e2e8f0; border-color: #475569 !important;">
                                    {{ $product->category ?? '-' }}
                                </span>
                            </td>
                            <td class="fw-bold text-white">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </td>
                            <td class="text-center fw-bold text-white">
                                {{ $product->stock }}
                            </td>
                            <td class="text-center">
                                @if($product->is_active)
                                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-semibold border border-success border-opacity-25">
                                        <i class="bi bi-circle-fill me-1" style="font-size: 6px;"></i> Aktif
                                    </span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary px-3 py-2 rounded-pill fw-semibold border border-secondary border-opacity-25">
                                        <i class="bi bi-circle-fill me-1" style="font-size: 6px;"></i> Tidak Aktif
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-info text-white btn-modern px-3">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning text-white btn-modern px-3">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-modern px-3">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5" style="color: #94a3b8;">
                                <i class="bi bi-inbox fs-1 d-block mb-2" style="color: #64748b;"></i>
                                Belum ada data produk tersimpan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection