{{-- resources/views/master_lokasi/store.blade.php --}}
@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-3">Tambah Lokasi</h1>

    @include('master_lokasi._form', [
        'route' => route('master-lokasi.store'),
        'method' => 'POST',
        'buttonText' => 'Simpan',
    ])
@endsection