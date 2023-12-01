<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pelanggan extends Model
{
    use SoftDeletes;

    protected $table = 'pelanggan';
    protected $primaryKey = 'ID_Pelanggan';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'Nama',
        'username',
        'password',
        'no_telp',
        'alamat',
        'created_at',
        'deleted_at',
    ];

    // Disable the automatic management of the updated_at timestamp
    public $timestamps = false;
}