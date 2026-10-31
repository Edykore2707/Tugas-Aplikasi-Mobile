<?php

namespace App\Http\Controllers;

use App\Events\OrderPlaced;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Simpan pesanan baru dan kirim notifikasi real-time via Reverb.
     */
    public function store(Request $request)
    {
        $request->validate([
            'total_amount' => 'required|numeric',
        ]);

        $user = auth()->user();

        // 1. Simpan data transaksi
        $order = Order::create([
            'user_id'      => $user->id,
            'total_amount' => $request->total_amount,
        ]);

        // 2. Pancarkan event real-time
        event(new OrderPlaced($order, $user));

        return redirect()->back()->with('success', 'Pesanan berhasil dibuat!');
    }

    /**
     * Tampilkan pratinjau invoice di browser.
     */
    public function preview(Order $order)
    {
        $order = Order::with('items.product', 'customer')->findOrFail($order->id);

        $invoice = $order;
        foreach ($invoice->items as $item) {
            if (!isset($item->total)) {
                $item->total = $item->subtotal ?? ($item->price * $item->quantity);
            }
        }
        $invoice->total = $invoice->total_amount ?? 0;

        return view('invoices.invoice', ['invoice' => $invoice]);
    }

    /**
     * Generate dan unduh PDF invoice berdasarkan ID Order.
     */
    public function invoice(Order $order)
    {
        // Memuat data order beserta relasi items.product dan customer
        $order = Order::with('items.product', 'customer')->findOrFail($order->id);

        // Normalisasi struktur data item dan total agar sesuai dengan Blade View
        $invoice = $order;
        foreach ($invoice->items as $item) {
            if (!isset($item->total)) {
                $item->total = $item->subtotal ?? ($item->price * $item->quantity);
            }
        }
        $invoice->total = $invoice->total_amount ?? 0;

        // Render view PDF dari resources/views/invoices/invoice.blade.php
        $pdf = Pdf::loadView('invoices.invoice', ['invoice' => $invoice]);

        // Unduh berkas PDF
        return $pdf->download('invoice_' . $invoice->id . '.pdf');
    }
}