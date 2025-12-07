{{-- resources/views/kategori_pekerjaan/edit.blade.php --}}
@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-3">Edit Kategori Pekerjaan</h1>

    @include('kategori_pekerjaan._form', [
        'route' => route('kategori-pekerjaan.update', $kategoriPekerjaan->id),
        'method' => 'PUT',
        'buttonText' => 'Update',
    ])
@endsection

