@extends('layouts.app')

@section('status-produk') active @endsection

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Produk</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            @include('layouts.alert')
            @if ($errors->any())
            <div class="alert alert-danger">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    Data produk
                    <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal"
                        data-target="#produk">
                        <i class="fa fa-plus mr-1"></i>
                        Tambah Produk
                    </button>
                </div>
                <div class="card-body">
                    @if($products->isEmpty())
                    <div class="text-center">
                        <img src="{{ asset('img/bank.svg') }}" class="img-fluid mb-2" width="150">
                        <p>Produk kosong</p>
                    </div>
                    @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" width="10">#</th>
                                <th scope="col">Nama produk</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($no = 1)
                            @foreach ($products as $product)
                            <tr>
                                <th scope="row">{{ $no++ }}</th>
                                <td>
                                    {{ $product->title }}
                                    <a href="javascript:;" class="ml-2" data-fancybox="gallery"
                                        data-options='{"caption" : "{{ $product->title }}", "src" : "{{ url('img/produk', [$product->image]) }}"}'>
                                        &#128444;</a>
                                </td>
                                <td><kbd>{{ $product->kategori }}</kbd></td>
                                <td>Rp. {{ number_format($product->price) }}</td>
                                <td>
                                    <form action="{{ url('produk/destroy', [$product->id]) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <a href="{{ url('produk/edit', [$product->id]) }}"
                                            class="btn btn-sm btn-light">Edit</a>
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Hapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <nav aria-label="Page navigation">
                        {{ $products->links() }}
                    </nav>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Modal produk --}}
<div class="modal fade" id="produk" tabindex="-1" role="dialog" aria-labelledby="produkLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="produkLabel">Form produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('produk/store') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama produk</label>
                        <input type="text" name="title" class="form-control" placeholder="Nama produk" required>
                    </div>
                    <div class="form-group">
                        <label for="">Kategori</label>
                        <select class="form-control" name="idCategory" required>
                            <option>Pilih kategori</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Harga</label>
                        <input type="text" name="price" class="form-control" placeholder="Harga produk"
                            onkeypress="return numberFilter(event)" required>
                    </div>
                    <div class="form-group">
                        <label for="">Gambar produk</label>
                        <input type="file" name="image" class="form-control-file" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
