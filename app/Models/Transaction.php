<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaksi'; // Make sure this matches your actual table name in the database

    protected $fillable = [
        'ID_Transaksi',
        'ID_Pelanggan',
        'ID_Baju',
        'tanggal',
        'jumlah',
        'total_harga',
        'alamat',
        'metode_pembayaran',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}