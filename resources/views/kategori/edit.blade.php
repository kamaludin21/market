@extends('layouts.app')

@section('status-kategori') active @endsection

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('kategori') }}">Kategori</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $category->title }}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            @include('layouts.alert')
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('kategori') }}" class="btn btn-sm btn-secondary mr-2">
                        <i class="gg-chevron-left"></i>
                    </a>
                    Edit kategori
                </div>
                <form action="{{ url('kategori/update', [$category->id]) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nama kategori</label>
                            <input type="text" name="title" value="{{ $category->title }}" class="form-control"
                                placeholder="Nama kategori" required>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ url('kategori') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
