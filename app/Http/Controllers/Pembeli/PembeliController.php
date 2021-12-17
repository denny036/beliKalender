<?php

namespace App\Http\Controllers\Pembeli;

use App\Produk;
use App\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\TransaksiDetail;
use Illuminate\Support\Facades\Auth;


class PembeliController extends Controller
{
    public function index()
    {
        $products = Produk::all(); // mengambil semua data product

        // $carts = Transaksi::where('user_id', Auth::user()->id)->where('status', 0)->first();
        // $totalCarts = TransaksiDetail::where('transactions_id', $carts->id)->count();

        return view('pembeli.index', compact('products'));
    }

    public function addToCarts($id)
    {
        $barang = Produk::where('id', $id)->first();



        return view('pembeli.checkout', compact('barang'));
    }

    public function createAddToCarts(Request $request, $id)
    {
        //get userID
        $userID = auth()->user()->id;

        //find productsID
        $products = Produk::where('id', $id)->first();

        //set Tanggal Pemesanan
        $tanggal = Carbon::now();

        //validate if user request a transactions more than product's stock
        if($request->jumlah_pesan > $products->jumlah) {
            return back()->with('info-jumlah', 'Pastikan jumlah pesanan Anda tidak melebihi stok produk');
        }

        $check_transactions = Transaksi::where('user_id', Auth::user()->id)->where('status',0)->first();

        //save transactions to database
        if(empty($check_transactions)){
            $transactions = new Transaksi();
            $transactions->user_id = $userID;
            $transactions->tanggal = $tanggal;
            $transactions->status = 0;
            $transactions->jumlah_harga = 0;
            $transactions->save();

        }

        //save transactions to detail_transaction database
        $new_transactions = Transaksi::where('user_id', Auth::user()->id)->where('status',0)->first();

        $check_detail_transactions = TransaksiDetail::where('products_id', $products->id)->where('transactions_id', $new_transactions->id)->first();

        if(empty($check_detail_transactions)){
            $detail_transactions = new TransaksiDetail();
            $detail_transactions->products_id = $products->id;
            $detail_transactions->user_id = $userID;
            $detail_transactions->transactions_id = $new_transactions->id;
            $detail_transactions->jumlah = htmlspecialchars($request->jumlah_pesan);
            $detail_transactions->jumlah_harga = $products->harga * $request->jumlah_pesan;
            $detail_transactions->save();
        }else{
            $detail_transactions = TransaksiDetail::where('products_id', $products->id)->where('transactions_id', $new_transactions->id)->first();

            $detail_transactions->jumlah = $detail_transactions->jumlah+$request->jumlah_pesan;

            //price of current products
            $price_of_new_detail_transactions = $products->harga * $request->jumlah_pesan;
            $detail_transactions->jumlah_harga = $detail_transactions->jumlah_harga + $price_of_new_detail_transactions;
            $detail_transactions->update();
        }

        $transactions = Transaksi::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $transactions->jumlah_harga = $transactions->jumlah_harga+$products->harga*$request->jumlah_pesan;
        $transactions->update();

        return redirect()->route('pembeli.add-to-carts', $id)->with('success', 'Berhasil melakukan pemesanan');
    }

    public function viewCarts()
    {
        $transaction = Transaksi::where('user_id', Auth::user()->id)->where('status',0)->first();
        if(!empty($transaction)){
            $detail_transaction = TransaksiDetail::where('transactions_id', $transaction->id)->get();
            return view('pembeli.carts', compact('transaction', 'detail_transaction'));
        }

        // $carts = Transaksi::where('user_id', Auth::user()->id)->where('status', 0)->first();
        // $totalCarts = TransaksiDetail::where('transactions_id', $carts->id)->count();
    }

    public function checkout()
    {
        $transaction = Transaksi::where('user_id', Auth::user()->id)->where('status',0)->first();
        $transaction_id = $transaction->id;
        $transaction->status = 1;
        $transaction->update();

        return redirect()->route('pembeli.index')->with('sukses', 'Anda berhasil checkout!');
    }

    public function deleteFromCarts($id)
    {
        $detail_transactions = TransaksiDetail::where('id', $id)->first();
        $transactions = Transaksi::where('id', $detail_transactions->transactions_id)->first();
        $transactions->jumlah_harga = $transactions->jumlah_harga-$detail_transactions->jumlah_harga;
        $transactions->update();

        $detail_transactions->delete();

        return redirect()->route('pembeli.carts')->with('success', 'Pesanan berhasil dihapus.');
    }
}
