{{-- resources/views/kategori_pekerjaan/create.blade.php --}}
@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-3">Tambah Kategori Pekerjaan</h1>

    @include('kategori_pekerjaan._form', [
        'route' => route('kategori-pekerjaan.store'),
        'method' => 'POST',
        'buttonText' => 'Simpan',
    ])
@endsection

