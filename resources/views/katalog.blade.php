@extends('layouts.app')

@section('status-katalog') active @endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @include('layouts.alert')
            <div class="card">
                <div class="card-header">
                    Katalog Produk
                </div>

                <div class="card-body">
                    @if($customer->isEmpty())
                    <div class="jumbotron">
                        <h1 class="display-4">Hai {{ Auth::user()->name }} &#127881; </h1>
                        <p class="lead">
                            Silahkan isi kolom nomor telepon dan alamat, untuk melanjutkan ke katalog produk dan
                            bertransaksi
                        </p>
                        <hr class="my-4">
                        <form action="{{ url('customer/create') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="">Telepon</label>
                                    <input type="text" name="telepon" onkeypress="return numberFilter(event)"
                                        maxlength="13" class="form-control" placeholder="Nomor telepon" required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="">Alamat</label>
                                    <input type="text" name="alamat" class="form-control" placeholder="Alamat lengkap"
                                        required>
                                </div>
                            </div>
                            <button class="btn btn-primary float-right" type="submit">Simpan</button>
                        </form>
                    </div>
                    @else
                    @if($products->isEmpty())
                    <div class="text-center">
                        <img src="{{ asset('img/bank.svg') }}" class="img-fluid mb-2" width="150">
                        <p>Produk kosong</p>
                    </div>
                    @else
                    <div class="row">
                        @foreach ($products as $product)
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <a href="javascript:;" data-fancybox="gallery"
                                    data-options='{"caption" : "{{ $product->title }}", "src" : "{{ url('img/produk', [$product->image]) }}"}'>
                                    <img src="{{ url('img/produk', [$product->image]) }}" class="card-img-top">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->title }}</h5>
                                    <p class="card-text">Rp. {{ number_format($product->price) }}</p>
                                    <form action="{{ url('customer/cart/create', [$product->id]) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary float-right"> Masuk
                                            keranjang
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
