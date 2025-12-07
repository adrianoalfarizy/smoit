{{-- resources/views/master_lokasi/create.blade.php --}}
@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-3">Tambah Lokasi</h1>

    @include('master_lokasi._form', [
        'route' => route('master-lokasi.update',  $masterLokasi->id),
        'method' => 'PUT',
        'buttonText' => 'Simpan',
    ])
@endsection