@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-3">Transaksi Sparepart</h1>

    @if($transaksi->count() === 0)
        <div class="alert alert-info">
            Belum ada transaksi sparepart.
        </div>
    @else
        <table class="table table-bordered table-striped align-middle">
            <thead>
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Kode / Nama Sparepart</th>
                <th>Tipe</th>
                <th>Qty</th>
                <th>Sumber/Tujuan</th>
                <th>Catatan</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transaksi as $row)
                <tr>
                    <td>{{ $loop->iteration + ($transaksi->currentPage() - 1) * $transaksi->perPage() }}</td>
                    <td>{{ $row->tanggal }}</td>
                    <td>
                        {{ $row->sparepart->kode_sparepart ?? '-' }} -
                        {{ $row->sparepart->nama_sparepart ?? '-' }}
                    </td>
                    <td>{{ $row->tipe }}</td>
                    <td>{{ $row->qty }}</td>
                    <td>{{ $row->sumber_tujuan }}</td>
                    <td>{{ $row->catatan }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $transaksi->links() }}
    @endif
@endsection

