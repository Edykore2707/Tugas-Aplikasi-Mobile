<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductController extends Controller
{
    /**
     * Menampilkan semua product.
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);

        return view('products.index', compact('products'));
    }

    /**
     * Menampilkan form tambah product.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Menyimpan product baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // Diubah menjadi validasi file gambar
            'is_active'   => 'nullable|boolean',
        ]);

        // Proses unggah & resize gambar
        $file = $request->file('image');
        if ($file) {
            $original = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $ext      = strtolower($file->getClientOriginalExtension());
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\_-]/', '_', $original) . '.' . $ext;
            $path     = 'products/' . $filename;

            // Manipulasi gambar dengan Intervention Image v3
            $manager = new ImageManager(new Driver());
            $image   = $manager->read($file->getRealPath())->cover(800, 800);

            if ($ext === 'png') {
                $encoded = $image->toPng();
            } else {
                $encoded = $image->toJpeg(85);
            }

            // Simpan ke storage public
            Storage::disk('public')->put($path, $encoded->toString());

            $validated['image'] = $path;
        }

        $validated['is_active'] = $request->has('is_active');

        Product::create($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail product.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Menampilkan form edit.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Mengupdate product.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active'   => 'nullable|boolean',
        ]);

        // Jika ada file gambar baru yang diunggah
        $file = $request->file('image');
        if ($file) {
            // Hapus gambar lama dari storage jika ada
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $original = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $ext      = strtolower($file->getClientOriginalExtension());
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\_-]/', '_', $original) . '.' . $ext;
            $path     = 'products/' . $filename;

            $manager = new ImageManager(new Driver());
            $image   = $manager->read($file->getRealPath())->cover(800, 800);

            if ($ext === 'png') {
                $encoded = $image->toPng();
            } else {
                $encoded = $image->toJpeg(85);
            }

            Storage::disk('public')->put($path, $encoded->toString());

            $validated['image'] = $path;
        }

        $validated['is_active'] = $request->has('is_active');

        $product->update($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product berhasil diperbarui.');
    }

    /**
     * Menghapus product.
     */
    public function destroy(Product $product)
    {
        // Hapus file gambar dari storage jika ada
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Product berhasil dihapus.');
    }
}