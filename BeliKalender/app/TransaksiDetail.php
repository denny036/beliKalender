<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    public $table = 'transactions_detail';

    protected $fillable = [
        'user_id',
        'product_id',
        'transaction_id',
        'jumlah',
        'jumlah_harga',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function produk()
    {
        return $this->belongsTo('App\Produk', 'products_id');
    }

    public function transaksi()
    {
        return $this->belongsTo('App\Transaksi', 'transactions_id');
    }

}
