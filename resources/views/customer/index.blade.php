@extends('layouts.app')

@section('status-customer') active @endsection

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Customer</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Data customer</div>
                <div class="card-body">
                    @if($customers->isEmpty())
                    <div class="text-center">
                        <img src="{{ asset('img/bank.svg') }}" class="img-fluid mb-2" width="150">
                        <p>Customer kosong</p>
                    </div>
                    @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" width="10">#</th>
                                <th scope="col">Nama customer</th>
                                <th scope="col">No. HP</th>
                                <th scope="col">Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($no = 1)
                            @foreach ($customers as $customer)
                            <tr>
                                <th scope="row">{{ $no++ }}</th>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->telepon }}</td>
                                <td>{{ $customer->alamat }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
