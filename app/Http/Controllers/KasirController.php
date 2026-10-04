<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class KasirController extends Controller
{
    public function index()
    {
        // Mengambil semua data produk agar muncul di Kasir / POS
        $products = Product::all();
        return view('kasir', compact('products'));
    }

    public function store(Request $request)
    {
        // Validasi input dari Fetch API JavaScript
        $request->validate([
            'cart' => 'required|array',
            'paid_amount' => 'required|numeric',
            'payment_method' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            // 1. Generate Nomor Transaksi Otomatis (misal: TRX-20260930-001)
            $transactionNumber = 'TRX-' . date('Ymd') . '-' . str_pad(Transaction::whereDate('created_at', today())->count() + 1, 3, '0', STR_PAD_LEFT);

            // 2. Simpan Header Transaksi
            $transaction = Transaction::create([
                'transaction_number' => $transactionNumber,
                'user_id'            => auth()->id() ?? 1, // Default ID 1 jika belum login/guest
                'customer_id'        => $request->customer_id ?? null,
                'subtotal'           => $request->subtotal ?? 0,
                'discount'           => $request->discount ?? 0,
                'tax'                => $request->tax ?? 0,
                'other_fee'          => $request->other_fee ?? 0,
                'grand_total'        => $request->grand_total ?? 0,
                'paid_amount'        => $request->paid_amount,
                'change_amount'      => $request->change_amount ?? 0,
                'payment_method'     => $request->payment_method,
                'status'             => 'completed',
            ]);

            // 3. Simpan Detail Transaksi & Kurangi Stok Produk
            foreach ($request->cart as $item) {
                // Ambil kode produk dari item, jika kosong cari dari database
                $productCode = !empty($item['code']) ? $item['code'] : null;
                if (!$productCode && isset($item['id'])) {
                    $product = Product::find($item['id']);
                    $productCode = $product->code ?? $product->product_code ?? '-';
                }

                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id'     => $item['id'],
                    'product_code'   => $productCode ?? '-',
                    'product_name'   => $item['name'] ?? 'Produk',
                    'price'          => $item['price'] ?? 0,
                    'qty'            => $item['qty'] ?? 1,
                    'discount'       => $item['discount'] ?? 0,
                    'subtotal'       => ($item['price'] ?? 0) * ($item['qty'] ?? 1),
                ]);

                // Kurangi stok jika produk ditemukan
                if (class_exists(Product::class) && isset($item['id'])) {
                    Product::where('id', $item['id'])->decrement('stock', $item['qty'] ?? 1);
                }
            }

            DB::commit();

            return response()->json([
                'success'        => true,
                'message'        => 'Transaksi berhasil disimpan!',
                'transaction_id' => $transaction->id
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan transaksi: ' . $e->getMessage()
            ], 500);
        }
    }
}