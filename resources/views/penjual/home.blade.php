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
                    Daftar Produk

                    <a href="{{ route('product.create') }}" class="btn btn-sm btn-success float-right">Tambah Produk</a>

                </div>

                <div class="card-body">

                    <table class="table table-bordered">
                        <tr>
                            <th class="text-center">ID Produk</th>
                            <th class="text-center">Nama Produk</th>
                            <th class="text-center">Deskripsi Produk</th>
                            <th class="text-center">Gambar Produk</th>
                            <th class="text-center">Jumlah Produk</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Action</th>
                        </tr>
                        @foreach ($products as $item)
                        <tr>
                            <td class="text-center">{{ $item->id }}</td>
                            <td class="text-center">{{ $item->nama }}</td>
                            <td class="text-center">{{ $item->deskripsi }}</td>
                            <td class="text-center"><img src="{{ asset('images/produk/' . $item->gambar) }}"
                                    alt="Gambar Produk" height="80" width="80"></td>
                            <td class="text-center">{{ $item->jumlah }}</td>
                            <td class="text-center">{{ $item->harga }}</td>
                            <td class="text-center">

                                <a href="{{ route('product.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>


                                    <form action="{{ route('product.delete',$item->id) }}" class="d-inline"
                                         method="POST">
                                        @csrf
                                        @method('delete')
                                        <a href="{{ route('product.delete',$item->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data?')">Hapus</a>
                                    </form>

                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="https://demo.getstisla.com/assets/modules/sweetalert/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.slim.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>

<script>
    $(".swal-confirm").click(function(e) {
        id = e.target.dataset.id;
        swal({
            title: 'Anda yakin hapus data ini?',
            text: 'Anda tidak dapat mengembalikan data ini jika sudah dihapus.',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal('Produk donasi berhasil dihapus!', {
                        icon: 'success',
                    });
                    $(`#delete${id}`).submit();
                } else {
                    swal('Donasi Anda tidak jadi dihapus!');
                }
            });
        });
</script>
