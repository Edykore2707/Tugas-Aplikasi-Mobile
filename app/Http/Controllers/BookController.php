<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class BookController extends Controller
{
    /**
     * Menampilkan semua book.
     */
    public function index(): JsonResponse
    {
        $books = Book::all();

        return response()->json($books, 200);
    }

    /**
     * Menyimpan book baru.
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status'      => ['required', 'string', 'max:50'],
        ]);

        $book = Book::create($data);

        return response()->json([
            'message' => 'Book created successfully',
            'data'    => $book,
        ], 201);
    }

    /**
     * Menampilkan detail book.
     */
    public function show(string $id): JsonResponse
    {
        $book = Book::findOrFail($id);

        return response()->json($book, 200);
    }

    /**
     * Mengupdate book (Mendukung PUT & PATCH).
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $book = Book::findOrFail($id);

        // 'sometimes' membuat validasi fleksibel saat request PATCH
        $data = $request->validate([
            'title'       => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status'      => ['sometimes', 'required', 'string', 'max:50'],
        ]);

        $book->update($data);

        return response()->json([
            'message' => 'Book updated successfully',
            'data'    => $book,
        ], 200);
    }

    /**
     * Menghapus book.
     */
    public function destroy(string $id): JsonResponse
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json([
            'message' => 'Book deleted successfully',
        ], 200);
    }

    /**
     * Cetak detail buku ke Printer Thermal (ESC/POS).
     */
    public function print(string $id): JsonResponse
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book Not Found'], 404);
        }

        try {
            // Sesuaikan nama "POS-58" dengan nama printer thermal yang terpasang/shared
            $connector = new WindowsPrintConnector("POS-58");
            $printer = new Printer($connector);

            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            $printer->text("TOKO BOLA\n");
            $printer->selectPrintMode();
            $printer->text("================================\n");

            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text("ID Buku   : " . $book->id . "\n");
            $printer->text("Judul     : " . $book->title . "\n");
            $printer->text("Status    : " . ($book->status == '1' ? 'Tersedia' : 'Kosong') . "\n");
            $printer->text("================================\n");
            $printer->text("Tanggal   : " . date('Y-m-d H:i:s') . "\n\n");

            $printer->cut();
            $printer->close();

            return response()->json(['message' => 'Berhasil mencetak ke printer thermal'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal mencetak: ' . $e->getMessage()], 500);
        }
    }
}