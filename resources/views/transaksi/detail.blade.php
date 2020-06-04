@extends('layouts.app')

@section('status-transaksi') active @endsection

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Transaksi</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $transaction[0]->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            @include('layouts.alert')
            <div class="card">
                <div class="card-header">Transaksi Customer</div>
                @if($transaction->isEmpty())
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
                                <th><strong>{{ $transaction[0]->name }}</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>No. Telepon</td>
                                <th>:</th>
                                <td><strong>{{ $transaction[0]->telepon }}</strong></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <th>:</th>
                                <td><strong>{{ $transaction[0]->alamat }}</strong></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <th>:</th>
                                <td><strong>{{ Str::limit($transaction[0]->created_at, 10, '') }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" width="10">#</th>
                                <th scope="col">Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col" width="30">Jumlah</th>
                                <th scope="col">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($no = 1)
                            @php($total = 0)
                            @foreach ($transaction as $cart)
                            <tr>
                                <th scope="row">{{ $no++ }}</th>
                                <td>{{ $cart->title}}</td>
                                <td>Rp. {{ number_format($cart->price) }}</td>
                                <td>
                                    {{ $cart->jumlah }}
                                </td>
                                <td>
                                    Rp. {{  number_format($cart->price*$cart->jumlah) }}
                                </td>
                            </tr>

                            @php($total += ($cart->price*$cart->jumlah))
                            @endforeach

                            <tr>
                                <td colspan="4">Total</td>
                                <td>Rp. {{ number_format($total) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
