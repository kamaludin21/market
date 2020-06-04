@extends('layouts.app')

@section('status-kategori') active @endsection

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Kategori</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            @include('layouts.alert')
            <div class="card">
                <div class="card-header">
                    Data kategori
                    <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal"
                        data-target="#kategori">
                        <i class="fa fa-plus mr-1"></i>
                        Tambah Kategori
                    </button>
                </div>
                <div class="card-body">
                    @if($categories->isEmpty())
                    <div class="text-center">
                        <img src="{{ asset('img/bank.svg') }}" class="img-fluid mb-2" width="150">
                        <p>Kategori kosong</p>
                    </div>
                    @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" width="10">#</th>
                                <th scope="col">Nama kategori</th>
                                <th scope="col">Jumlah produk</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($no = 1)
                            @foreach ($categories as $item)
                            <tr>
                                <th scope="row">{{ $no++ }}.</th>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->jumlahProduk }} Buah</td>
                                <td>
                                    <form action="{{ url('kategori/destroy', [$item->id]) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <a href="{{ url('kategori/edit', [$item->id]) }}"
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
                        {{ $categories->links() }}
                    </nav>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Modal kategori --}}
<div class="modal fade" id="kategori" tabindex="-1" role="dialog" aria-labelledby="kategoriLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kategoriLabel">Form kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('kategori/store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama kategori</label>
                        <input type="text" name="title" class="form-control" placeholder="Nama kategori" required>
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
