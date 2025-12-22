{{-- resources/views/mdr/create.blade.php --}}
@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-3">Edit MDR</h1>

    @include('mdr._form', [
        'route' => route('mdr.update',  $mdr->id),
        'method' => 'PUT',
        'buttonText' => 'Simpan',
    ])
@endsection