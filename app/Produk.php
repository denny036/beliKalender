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
        'user_id',
    ];

    public function user_r()
    {
        return $this->belongsTo('App\User', 'products_id');
    }

    public function transaksi()
    {
        return $this->hasMany('App\Transaksi', 'products_id');
    }
}
