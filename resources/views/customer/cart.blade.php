@extends('layouts.app')

@section('status-cart') active
@endsection

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            @include('layouts.alert')
            <div class="card">
                <div class="card-header">Keranjang anda</div>
                @if($carts->isEmpty())
                <div class="text-center">
                    <img src="{{ asset('img/bank.svg') }}" class="img-fluid mb-2" width="150">
                    <p>Keranjang anda kosong</p>
                </div>
                @else
                <div class="card-body">
                    <table class="mb-2">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>:</th>
                                <th><strong>{{ $carts[0]->name }}</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>No. Telepon</td>
                                <th>:</th>
                                <td><strong>{{ $carts[0]->telepon }}</strong></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <th>:</th>
                                <td><strong>{{ $carts[0]->alamat }}</strong></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <th>:</th>
                                <td><strong>{{ Str::limit($carts[0]->created_at, 10, '') }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" width="10">#</th>
                                <th scope="col" width="50">Aksi</th>
                                <th scope="col">Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col" width="30">Jumlah</th>
                                <th scope="col">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($no = 1)
                            @php($total = 0)
                            @foreach ($carts as $cart)
                            <tr>
                                <th scope="row">{{ $no++ }}</th>
                                <td>
                                    <form action="{{ url('customer/cart/delete', [$cart->id]) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Hapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                                <td>{{ $cart->title}}</td>
                                <td>Rp. {{ number_format($cart->price) }}</td>
                                <td>
                                    {{ $cart->jumlah }}
                                </td>
                                <td>
                                    Rp. {{ number_format($cart->price*$cart->jumlah) }}
                                </td>
                            </tr>

                            @php($total += ($cart->price*$cart->jumlah))
                            @endforeach

                            <tr>
                                <td colspan="5">Total</td>
                                <td>Rp. {{ number_format($total) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <form action="{{ url('customer/cart/checkout', [$carts[0]->ticket]) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="card-footer text-right">
                        <a href="{{ url('katalog') }}" class="btn btn-success">Belanja lagi</a>
                        <button type="submit" class="btn btn-primary">Checkout</button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
