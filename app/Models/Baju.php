<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Baju extends Model
{
    use SoftDeletes;

    protected $table = 'baju';
    protected $primaryKey = 'ID_Baju';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nama_baju',
        'harga',
        'stok',
        'created_at',
        'deleted_at',
    ];

    // Disable the automatic management of the updated_at timestamp
    public $timestamps = false;
}