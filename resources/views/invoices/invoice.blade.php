<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $invoice->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 32px;
            color: #1f2937;
        }
        .invoice-box {
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
            padding: 32px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid #dbeafe;
            padding-bottom: 16px;
            margin-bottom: 24px;
        }
        .brand h1 {
            margin: 0;
            font-size: 28px;
            letter-spacing: 1px;
            color: #1d4ed8;
        }
        .brand small {
            display: block;
            color: #6b7280;
            margin-top: 6px;
        }
        .meta {
            text-align: right;
            line-height: 1.7;
            font-size: 14px;
        }
        .meta strong {
            display: inline-block;
            width: 110px;
        }
        .customer {
            margin-bottom: 20px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 14px 16px;
        }
        .customer h3 {
            margin: 0 0 8px;
            font-size: 18px;
        }
        .customer p {
            margin: 4px 0;
            color: #475569;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border-bottom: 1px solid #e5e7eb;
            padding: 12px 10px;
            text-align: left;
        }
        th {
            background: #eff6ff;
            color: #1e3a8a;
            font-size: 13px;
            text-transform: uppercase;
        }
        .num {
            text-align: right;
        }
        .totals {
            margin-top: 18px;
            width: 100%;
            max-width: 320px;
            margin-left: auto;
        }
        .totals-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .totals-row.grand {
            font-size: 18px;
            font-weight: bold;
            color: #111827;
            border-bottom: none;
            padding-top: 12px;
        }
        .actions {
            margin-top: 28px;
            text-align: center;
        }
        .btn {
            display: inline-block;
            background: #2563eb;
            color: white;
            text-decoration: none;
            padding: 11px 22px;
            border-radius: 8px;
            font-weight: bold;
        }
        @media print {
            body { background: white; padding: 0; }
            .btn { display: none; }
            .invoice-box { box-shadow: none; border: none; }
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="header">
            <div class="brand">
                <h1>Toko Bola</h1>
                <small>Invoice Penjualan</small>
            </div>
            <div class="meta">
                <div><strong>Invoice</strong>#{{ $invoice->id }}</div>
                <div><strong>Tanggal</strong>{{ $invoice->created_at ? $invoice->created_at->format('d M Y') : now()->format('d M Y') }}</div>
                <div><strong>Kasir</strong>{{ $invoice->customer?->name ?? 'Admin' }}</div>
            </div>
        </div>

        <div class="customer">
            <h3>Pelanggan</h3>
            <p>{{ $invoice->customer?->name ?? 'Umum' }}</p>
            <p>{{ $invoice->customer?->email ?? 'Pembeli Umum' }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th class="num">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($invoice->items as $item)
                    <tr>
                        <td>{{ $item->product?->name ?? $item->product_name ?? 'Produk' }}</td>
                        <td>Rp {{ number_format((float) ($item->price ?? 0), 0, ',', '.') }}</td>
                        <td>{{ $item->quantity ?? $item->qty ?? 1 }}</td>
                        <td class="num">Rp {{ number_format((float) ($item->total ?? $item->subtotal ?? 0), 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Belum ada item pada transaksi ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="totals">
            <div class="totals-row">
                <span>Subtotal</span>
                <span>Rp {{ number_format((float) ($invoice->total ?? 0), 0, ',', '.') }}</span>
            </div>
            <div class="totals-row">
                <span>Pajak</span>
                <span>Rp 0</span>
            </div>
            <div class="totals-row grand">
                <span>Grand Total</span>
                <span>Rp {{ number_format((float) ($invoice->total ?? 0), 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="actions">
            <a class="btn" href="{{ route('orders.invoice', ['order' => $invoice->id]) }}">Download PDF</a>
        </div>
    </div>
</body>
</html>