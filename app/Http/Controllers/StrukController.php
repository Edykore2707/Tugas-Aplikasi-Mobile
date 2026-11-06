<?php

namespace App\Http\Controllers;

use App\Services\PrinterConnectionResolver;
use Illuminate\Http\Request;
use Mike42\Escpos\Printer;

class StrukController extends Controller
{
    public function struk()
    {
        try {
            $printerResolver = new PrinterConnectionResolver();
            $connector = $printerResolver->resolveConnector();

            $printer = new Printer($connector);

            // 2. Header Struk
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->setEmphasis(true);
            $printer->text("TOKO SAYA\n");
            $printer->setEmphasis(false);
            $printer->text("Jl. Utama No. 123, Kota\n");
            $printer->text("--------------------------------\n");

            // 3. Informasi Transaksi
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text("No Nota : TRX-1001\n");
            $printer->text("Kasir   : Admin\n");
            $printer->text("Tanggal : " . date('Y-m-d H:i') . "\n");
            $printer->text("--------------------------------\n");

            // 4. Detail Barang (Perulangan Item)
            $items = $this->getItems();
            foreach ($items as $item) {
                $printer->text($item['name'] . "\n");
                $subtotal = $item['qty'] * $item['price'];
                $printer->text($item['qty'] . " x " . number_format($item['price']) . " = " . number_format($subtotal) . "\n");
            }

            // 5. Total Belanja
            $printer->text("--------------------------------\n");
            $printer->text("Total     : Rp 50.000\n");
            $printer->text("Bayar     : Rp 100.000\n");
            $printer->text("Kembali   : Rp 50.000\n");
            $printer->text("--------------------------------\n");

            // 6. Footer
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("Terima Kasih Atas Kunjungan Anda\n\n");

            // 7. Potong Kertas dan Tutup
            $printer->feed(3);
            $printer->cut();
            $printer->close();

            return "Struk berhasil dicetak!";
        } catch (\Exception $e) {
            return "Gagal mencetak struk: " . $e->getMessage();
        }
    }

    // Fungsi mengambil data item (sementara masih statis/array)
    private function getItems()
    {
        return [
            ['name' => 'Kopi Hitam', 'qty' => 2, 'price' => 15000],
            ['name' => 'Roti Bakar', 'qty' => 1, 'price' => 20000],
        ];
    }
}