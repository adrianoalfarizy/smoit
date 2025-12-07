@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-3">Tambah Teknisi</h1>

    @include('master_teknisi._form', [
        'route' => route('master-teknisi.store'),
        'method' => 'POST',
        'buttonText' => 'Simpan',
    ])
@endsection

