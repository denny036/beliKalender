@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
       <div class="col-md-12 mb-4">
          <img src="{{ asset('images/logo.png')}}" class="rounded mx-auto d-block" width="500" alt="">
       </div>
       @foreach($products as $item)
       <div class="col-md-4">
          <div class="card">
             <img src="{{ asset('images/produk/' . $item->gambar) }}" class="card-img-top responsive" width="200px" height="200px" style="object-fit: cover" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{ $item->nama }}</h5>
               <p class="card-text">
               <strong>Harga :</strong> Rp. {{ number_format($item->harga) }}
               <hr>
               <strong>Stok :</strong> {{ $item->jumlah }}
               <br>
               <strong>Keterangan :</strong>
               {{ $item->deskripsi}}
               </p>
               <a href="{{ route('pembeli.checkout', $item->id) }}" class="btn btn-primary"><i class="fas fa-shopping-cart"></i> Pesan</a>
            </div>
          </div>
       </div>
       @endforeach
    </div>
 </div>

@endsection


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.slim.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
