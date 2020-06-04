@extends('layouts.app')

@section('status-produk') active @endsection

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('produk') }}">Produk</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->title }}</li>
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
                    <a href="{{ url('produk') }}" class="btn btn-sm btn-secondary mr-2">
                        <i class="gg-chevron-left"></i>
                    </a>
                    Data produk
                </div>
                <form action="{{ url('produk/update', $product->id) }}" enctype="multipart/form-data" method="post">
                    @csrf
                    @method('patch')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nama produk</label>
                            <input type="text" value="{{ $product->title }}" name="title" class="form-control"
                                placeholder="Nama produk" required>
                        </div>
                        <div class="form-group">
                            <label for="">Kategori</label>
                            <select class="form-control" name="idCategory" required>
                                <option>Pilih kategori</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if($category->id == $product->idCategory) selected
                                    @endif>{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Harga</label>
                            <input type="text" name="price" value="{{ $product->price }}" class="form-control"
                                placeholder="Harga produk" onkeypress="return numberFilter(event)" required>
                        </div>
                        <div class="form-group">
                            <a href="javascript:;" class="ml-2" data-fancybox="gallery"
                                data-options='{"caption" : "{{ $product->title }}", "src" : "{{ url('img/produk', [$product->image]) }}"}'><i
                                    class="fa fa-image"></i> Lihat gambar lama</a>
                        </div>
                        <div class="form-group">
                            <label for="">Gambar produk baru</label>
                            <input type="file" name="image" class="form-control-file">
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
