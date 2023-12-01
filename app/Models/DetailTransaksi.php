<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $table = 'detail_transaksi';
    protected $primaryKey = 'ID_Detail';

    protected $fillable = ['ID_Pelanggan', 'ID_Baju', 'ID_Transaksi', 'Status'];
}
