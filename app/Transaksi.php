<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    public $table = 'transactions';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'tanggal',
        'status',
        'jumlah_harga',
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function transaksi()
    {
        return $this->belongsTo('App\Transaksi','transactions_id');
    }

    public function transaksi_detail()
    {
        return $this->hasMany('App\TransaksiDetail','transactions_id', 'id');
    }

    public function produk()
    {
        return $this->belongsTo('App\Produk', 'product_id');
    }
}
