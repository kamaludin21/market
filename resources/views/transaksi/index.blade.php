@extends('layouts.app')

@section('status-transaksi') active @endsection

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Data transaksi</div>
                <div class="card-body">
                    @if($transactions->isEmpty())
                    <div class="text-center">
                        <img src="{{ asset('img/bank.svg') }}" class="img-fluid mb-2" width="150">
                        <p>Transaksi kosong</p>
                    </div>
                </div>
                @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" width="10">#</th>
                            <th scope="col">Customer</th>
                            <th scope="col">No. Telp</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Tanggal transaksi</th>
                            <th scope="col" width="50" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($no = 1)
                        @foreach ($transactions as $item)
                        <tr>
                            <th scope="row">{{ $no++ }}</th>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->telepon }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ Str::limit($item->created_at, 10, '') }}</td>
                            <td>
                                <a href="{{ url('transaksi/detail', [$item->ticket]) }}" class="btn btn-sm btn-light">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <nav aria-label="Page navigation example">
                    {{ $transactions->links() }}
                </nav>
            </div>
            @endif
        </div>
    </div>
</div>
</div>
@endsection
