@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-3">Edit Teknisi</h1>

    @include('master_teknisi._form', [
        'route' => route('master-teknisi.update', $masterTeknisi->id),
        'method' => 'PUT',
        'buttonText' => 'Update',
    ])
@endsection

