<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
// Jika menggunakan printer jaringan (LAN/Wi-Fi), gunakan use di bawah ini:
// use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

class StrukController extends Controller
{
    public function struk()
    {
        try {
            // 1. Pilih konektor printer (sesuaikan dengan nama printer di Windows Anda)
            $connector = new WindowsPrintConnector("POS-58");
            
            // Jika pakai Printer LAN / Wi-Fi:
            // $connector = new NetworkPrintConnector("192.168.1.100", 9100);

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