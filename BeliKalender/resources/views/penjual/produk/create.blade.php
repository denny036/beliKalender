@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    Tambah Produk

                    <a href="{{ route('penjual.home') }}" class="btn btn-sm btn-primary float-right">Kembali</a>

                </div>

                <div class="card-body">


                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <table class="table table-bordered">
                            <tr>
                                <td>Nama Produk</td>
                                <td><input type="text" name="nama" class="form-control"
                                        placeholder="Masukkan nama produk" required></td>
                            </tr>
                            <tr>
                                <td>Deskripsi Produk</td>
                                <td><input type="text" name="deskripsi" class="form-control"
                                        placeholder="Masukkan deskripsi produk" required></td>
                            </tr>
                            <tr>
                                <td>Gambar Produk</td>
                                <td><input type="file" name="gambar" class="form-control"
                                        placeholder="Masukkan gambar produk" required></td>
                            </tr>
                            <tr>
                                <td>Jumlah Produk</td>
                                <td><input type="number" name="jumlah" class="form-control"
                                        placeholder="Masukkan jumlah produk" required></td>
                            </tr>
                            <tr>
                                <td>Harga Produk</td>
                                <td><input type="number" name="harga" class="form-control"
                                        placeholder="Masukkan harga produk" required></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button type="submit" name="submit" class="btn btn-primary btn-sm">Simpan</td>
                            </tr>
                        </table>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
