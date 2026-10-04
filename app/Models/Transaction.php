<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Menentukan kolom mana saja yang boleh diisi secara langsung (Mass Assignment)
    protected $guarded = ['id'];

    /**
     * Relasi One-to-Many ke TransactionDetail
     * Satu transaksi memiliki banyak detail barang
     */
    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_id');
    }
}