<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    public $table = 'transactions';
    protected $fillable = [
        'nomor_telepon',
        'alamat',
        'provinsi',
        'kota',
        'kecamatan',
        'kode_pos',
        'status',
        'user_id',
        'product_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function transaksi_user()
    {
        return $this->belongsTo('App\Transaksi','transactions_id');
    }
}
