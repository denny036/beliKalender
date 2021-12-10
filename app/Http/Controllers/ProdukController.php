<?php

namespace App\Http\Controllers;

use App\User;
use App\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    public function index()
    {
        $data = Produk::where('user_id', Auth::user()->id)->paginate(7);

        return view('penjual.home',compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 7);

        // $products = Produk::all(); // mengambil semua data product
        // return view('penjual.home', compact('products'));
    }

    public function create()
    {
        return view ('penjual.produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $nama= htmlspecialchars($request->nama);
        $deskripsi = htmlspecialchars($request->deskripsi);
        $jumlah = $request->jumlah;
        $harga = $request->harga;
        $file = $request->file('gambar');


        $destinationPath = 'images/produk/';
        $file->move($destinationPath, $file->getClientOriginalName());

        DB::table('products')->insert([
            'nama' => $nama,
            'deskripsi' => $deskripsi,
            'jumlah' => $jumlah,
            'harga' => $harga,
            'gambar' => $file->getClientOriginalName(),
            'user_id' => auth()->id(),
        ]);
        return redirect()->route('penjual.home')->with('success', 'Produk berhasil ditambahkan');

    }

    public function edit($id)
    {
        $data_products = Produk::findOrFail($id) ;
        return view('penjual.produk.edit', compact('data_products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'gambar' => 'image|mimes:jpeg,png,jpg'
        ]);

        $data = Produk::findOrFail($id);

        $data->nama = htmlspecialchars($request->input('nama'));
        $data->deskripsi = htmlspecialchars($request->input('deskripsi'));
        $data->jumlah  = $request->input('jumlah');
        $data->harga = $request->input('harga');

        if ($request->hasfile('gambar')){
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = md5(time()).'.'.$extension;
            $file->move('images/produk/', $filename);
            $data->gambar=$filename;
        } else {
            return $request;
            $data->gambar='';
        }

        // if ($request->hasFile('gambar')) {
        //     $file = $request->file('gambar');
        //     $extension = $file->getClientOriginalExtension();
        //     $filename = rand(99, 999) . '.' . bcrypt($file) . $extension;
        //     $file->move('images/produk/', $filename);
        //     $data->gambar = $filename;
        // }

        if($data->save()){
            return redirect()->route('penjual.home')->with('success', 'Produk berhasil diupdate');
        }else{
            return redirect()->route('penjual.produk.edit')->with('danger', 'Produk gagal diupdate. Periksa ekstensi file Anda!');
        }

            // return redirect()->route('penjual.home')->with('success', 'Produk berhasil diupdate');

    }

    public function delete($id)
    {
        DB::table('products')->where('id', $id)->delete();
        return redirect()->route('penjual.home')->with('success', 'Produk berhasil dihapus');
    }
}
