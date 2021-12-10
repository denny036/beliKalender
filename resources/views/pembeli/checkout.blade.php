@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('pembeli.index') }}" class="btn btn-sm btn-primary float-right"><i
                    class="fa fa-arrow-left"></i>Kembali</a>
        </div>
        <div class="col-md-12 mt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('pembeli.index') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $find_products->nama}}</li>
                </ol>
                @if ($message = Session::get('info-jumlah'))
                <div class="alert alert-warning">
                    <p>{{ $message }}</p>
                </div>
                @endif
            </nav>
        </div>
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <img src="{{ asset('images/produk/' . $find_products->gambar) }}"
                                class="rounded mx-auto d-block" width="100%" alt="">
                        </div>
                        <div class="col-md-12 mt-5">
                            <h2>{{ $find_products->nama}}</h2>
                            <table class="table">
                                <tbody>
                                    <form action="{{ route('create.checkout', $find_products->id) }}" method="POST">
                                    <tr>
                                        <td>Harga</td>
                                        <td>:</td>
                                        <td>Rp. {{ (number_format($find_products->harga))}}</td>
                                    </tr>
                                    <tr>
                                        <td>Stok</td>
                                        <td>:</td>
                                        <td>{{ number_format($find_products->jumlah) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td>:</td>
                                        <td>{{ $find_products->deskripsi }}</td>
                                    </tr>

                                        @csrf
                                        <tr>
                                            <td>Jumlah Pesan</td>
                                            <td>:</td>
                                            <td>
                                                <input class="form-control" type="number" name="jumlah_pesanan"
                                                    required="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nomor Telepon</td>
                                            <td>:</td>
                                            <td>
                                                <input class="form-control" type="text" name="nomor_telepon"
                                                    required="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>:</td>
                                            <td>
                                                <input class="form-control" type="text" name="alamat" required="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Provinsi</td>
                                            <td>:</td>
                                            <td>
                                                <input class="form-control" type="text" name="provinsi" required="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kota</td>
                                            <td>:</td>
                                            <td>
                                                <input class="form-control" type="text" name="kota" required="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kecamatan</td>
                                            <td>:</td>
                                            <td>
                                                <input class="form-control" type="text" name="kecamatan" required="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kode Pos</td>
                                            <td>:</td>
                                            <td>
                                                <input class="form-control" type="text" name="kode_pos" required="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <button type="submit" class="btn btn-primary"><i
                                                        class="fa fa-shopping-cart"></i> Masukkan Keranjang</button>
                                            </td>
                                        </tr>
                                    </form>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif

            <div class="card">
                <div class="card-header">
                    Beli Produk

                    <a href="{{ route('pembeli.index') }}" class="btn btn-sm btn-primary float-right">Kembali</a>

                </div>

                <div class="card-body">


                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            @if (auth()->user())
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ auth()->user()->email }}" readonly>
                            @else
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                                required>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ old('address') }}" required>
                        </div>

                        <div class="half-form">
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="province">Province</label>
                                <input type="text" class="form-control" id="province" name="province"
                                    value="{{ old('province') }}" required>
                            </div>
                        </div> <!-- end half-form -->

                        <div class="half-form">
                            <div class="form-group">
                                <label for="postalcode">Postal Code</label>
                                <input type="text" class="form-control" id="postalcode" name="postalcode"
                                    value="{{ old('postalcode') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{ old('phone') }}" required>
                            </div>
                        </div> <!-- end half-form -->

                        <div class="spacer"></div>

                        <h2>Payment Details</h2>

                        <div class="form-group">
                            <label for="name_on_card">Name on Card</label>
                            <input type="text" class="form-control" id="name_on_card" name="name_on_card" value="">
                        </div>

                        <div class="form-group">
                            <label for="card-element">
                                Credit or debit card
                            </label>
                            <div id="card-element">
                                <!-- a Stripe Element will be inserted here. -->
                            </div>

                            <!-- Used to display form errors -->
                            <div id="card-errors" role="alert"></div>
                        </div>
                        <div class="spacer"></div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
