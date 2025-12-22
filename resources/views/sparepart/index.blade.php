@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Sparepart</h1>
        <a href="{{ route('sparepart.create') }}" class="btn btn-primary">
            + Tambah Sparepart
        </a>
    </div>

    {{-- Notifikasi stok menipis --}}
    @if($lowStock->count() > 0)
        <div class="alert alert-warning">
            <strong>Perhatian!</strong> Beberapa sparepart stoknya menipis:
            <ul class="mb-0">
                @foreach($lowStock as $item)
                    <li>
                        {{ $item->kode_sparepart }} - {{ $item->nama_sparepart }}
                        (stok: {{ $item->stok }}, minimum: {{ $item->stok_minimum }})
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($sparepart->count() === 0)
        <div class="alert alert-info">
            Belum ada data sparepart.
        </div>
    @else
        <table class="table table-bordered table-striped align-middle">
            <thead>
            <tr>
                <th>#</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Satuan</th>
                <th>Status</th>
                <th width="18%">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sparepart as $row)
                <tr>
                    <td>{{ $loop->iteration + ($sparepart->currentPage() - 1) * $sparepart->perPage() }}</td>
                    <td>{{ $row->kode_sparepart }}</td>
                    <td>{{ $row->nama_sparepart }}</td>
                    <td>{{ $row->kategori }}</td>
                    <td>{{ $row->stok }}</td>
                    <td>{{ $row->satuan }}</td>
                    <td>
                        @if($row->status_aktif)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-secondary">Tidak Aktif</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('sparepart.edit', $row->id) }}" class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <form action="{{ route('sparepart.destroy', $row->id) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $sparepart->links() }}
    @endif
@endsection

