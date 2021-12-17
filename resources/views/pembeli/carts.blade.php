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
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('pembeli.index') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
                {{-- @if ($message = Session::get('info-jumlah'))
                <div class="alert alert-warning">
                    <p>{{ $message }}</p>
                </div>
                @endif --}}
            </nav>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3><i class="fa fa-shopping-cart"></i>Checkout Sekarang!</h3>
                    @if(!empty($transaction))
                    <p>Tanggal Pemesanan: {{ date('d-m-Y', strtotime($transaction->tanggal)) }}</p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($detail_transaction as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->produk->nama }}</td>
                                <td>{{ $item->jumlah }} buah</td>
                                <td>Rp. {{ number_format($item->produk->harga) }}</td>
                                <td>Rp. {{ number_format($item->jumlah_harga) }}</td>
                                <td>
                                    <form action="{{ route('pembeli.delete-from-carts', $item->id) }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-sm btn-danger"><i
                                                class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" align="right"><strong>Total Harga: </strong></td>
                                <td><strong>Rp. {{ number_format($transaction->jumlah_harga) }}</strong></td>
                                <td>
                                    <form action="{{ route('pembeli.checkout') }}" method="POST">
                                    @csrf
                                    <button type="sumbit" class="btn btn-sm btn-success"><i class="fa fa-shopping-cart"></i> Checkout</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
