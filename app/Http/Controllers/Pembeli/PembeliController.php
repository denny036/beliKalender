<?php

namespace App\Http\Controllers\Pembeli;

use App\Produk;
use App\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PembeliController extends Controller
{
    public function index()
    {
        $products = Produk::all(); // mengambil semua data product
        return view('pembeli.index', compact('products'));
    }

    public function checkout($id)
    {
        $find_products = Produk::findOrFail($id);
        return view('pembeli.checkout', compact('find_products'));
    }

    public function createCheckout(Request $request, $id)
    {

        return redirect()->route('pembeli.index')->with('success', 'Berhasil melakukan pemesanan');
    }
}
