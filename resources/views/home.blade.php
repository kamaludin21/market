@extends('layouts.app')

@section('status-home') active @endsection

@section('content')
<div class="container">
    <div class="jumbotron">
        <h1 class="display-4">Hai {{ Auth::user()->name }} &#128126;</h1>
      </div>
</div>
@endsection
