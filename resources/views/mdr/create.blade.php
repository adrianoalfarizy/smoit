{{-- resources/views/mdr/create.blade.php --}}
@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-3">Tambah MDR</h1>

    @include('mdr._form', [
        'route' => route('mdr.store'),
        'method' => 'POST',
        'buttonText' => 'Simpan',
    ])
@endsection