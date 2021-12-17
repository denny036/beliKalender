@extends('layouts.app')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('pembeli.index') }}" class="btn btn-sm btn-primary float-right"><i
                    class="fa fa-arrow-left"></i>Kembali</a>
                    <a href="{{ route('pembeli.carts') }}" class="btn btn-sm btn-danger float-left"><i
                        class="fa fa-shopping-cart"></i> Lihat Keranjang</a>
        </div>
        <div class="col-md-12 mt-2">
            <nav aria-label="breadcrumb">
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('pembeli.index') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $barang->nama}}</li>
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
                        <div class="col-md-6 mx-auto">
                            <img src="{{ asset('images/produk/' . $barang->gambar) }}"
                                class="rounded mx-auto d-block" width="100%" alt="">
                        </div>
                        <div class="col-md-6 mt-5">
                            <h2>{{ $barang->nama}}</h2>
                            <table class="table">
                                <tbody>
                                    {{-- <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}"> --}}
                                    <tr>
                                        <td>Harga</td>
                                        <td>:</td>
                                        <td>Rp. {{ (number_format($barang->harga))}}</td>
                                    </tr>
                                    <tr>
                                        <td>Stok</td>
                                        <td>:</td>
                                        <td>{{ number_format($barang->jumlah) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td>:</td>
                                        <td>{{ $barang->deskripsi }}</td>
                                    </tr>

                                        @csrf
                                        <tr>
                                            <td>Jumlah Pesan</td>
                                            <td>:</td>
                                            <td>
                                                <form action="{{ route('create.add-to-carts', $barang->id) }}" method="POST">
                                                @csrf
                                                <input class="form-control" type="text" name="jumlah_pesan"
                                                    required="">
                                                    <button type="submit" class="btn btn-primary mt-3"><i
                                                        class="fa fa-shopping-cart"></i> Masukkan Keranjang</button>
                                                </form>
                                            </td>
                                        </tr>
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
