<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'nama',
        'deskripsi',
        'gambar',
        'jumlah',
        'harga',
    ];

}
