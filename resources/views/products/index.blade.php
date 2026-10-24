@extends('layouts.admin')

@section('content')
<div class="pb-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h2 class="fw-bold text-white mb-1">Data Produk</h2>
            <p class="text-secondary mb-0">Kelola katalog dan stok produk Toko Bola</p>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-success btn-modern px-4 py-2">
            <i class="bi bi-plus-lg me-1"></i> Tambah Produk
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 rounded-3 mb-4 shadow-sm d-flex align-items-center gap-2" role="alert">
            <i class="bi bi-check-circle-fill"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    <div class="card card-dark overflow-hidden">
        <div class="card-header bg-transparent border-bottom border-secondary px-4 py-3">
            <h6 class="fw-bold text-white mb-0"><i class="bi bi-list-ul me-2 text-primary"></i>Produk Terdaftar</h6>
        </div>
        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle mb-0">
                <thead class="text-uppercase small text-secondary" style="background: rgba(15,23,42,0.8);">
                    <tr>
                        <th class="py-3 px-4 text-center">No</th>
                        <th class="py-3 text-center">Gambar</th>
                        <th class="py-3">Produk</th>
                        <th class="py-3">Kategori</th>
                        <th class="py-3">Harga</th>
                        <th class="py-3 text-center">Stok</th>
                        <th class="py-3 text-center">Status</th>
                        <th class="py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td class="text-center text-secondary fw-semibold">{{ $loop->iteration }}</td>
                            <td class="text-center">
                                @if($product->image && filter_var($product->image, FILTER_VALIDATE_URL))
                                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="rounded-3 border border-secondary" style="width: 52px; height: 52px; object-fit: cover;">
                                @else
                                    <div class="rounded-3 d-inline-flex align-items-center justify-content-center border border-secondary" style="width: 52px; height: 52px; background: rgba(148,163,184,0.08);">
                                        <i class="bi bi-image text-secondary"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold text-white">{{ $product->name }}</div>
                                <small class="text-secondary d-block text-truncate" style="max-width: 260px;">{{ $product->description ?? 'Tidak ada deskripsi' }}</small>
                            </td>
                            <td>
                                <span class="badge rounded-pill px-3 py-2 text-white" style="background: rgba(148,163,184,0.2); border: 1px solid rgba(148,163,184,0.2);">
                                    {{ $product->category ?? '-' }}
                                </span>
                            </td>
                            <td class="fw-bold text-white">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="text-center fw-bold text-white">{{ $product->stock }}</td>
                            <td class="text-center">
                                @if($product->is_active)
                                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill border border-success border-opacity-25">Aktif</span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary px-3 py-2 rounded-pill border border-secondary border-opacity-25">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-info text-white btn-modern px-3"><i class="bi bi-eye"></i> Detail</a>
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning text-white btn-modern px-3"><i class="bi bi-pencil"></i> Edit</a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-modern px-3"><i class="bi bi-trash"></i> Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-secondary">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
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