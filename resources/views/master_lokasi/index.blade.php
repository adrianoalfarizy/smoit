@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Master Lokasi</h1>
        <a href="{{ route('master-lokasi.create') }}" class="btn btn-primary">
            + Tambah Lokasi
        </a>
    </div>

    @if ($lokasi->count() === 0)
        <div class="alert alert-info">
            Belum ada data lokasi. Klik <strong>Tambah Lokasi</strong> untuk menambah data baru.
        </div>
    @else
        <table class="table table-bordered table-striped align-middle">
            <thead>
            <tr>
                <th>#</th>
                <th>Kode</th>
                <th>Nama Lokasi</th>
                <th>Jenis</th>
                <th>Kota</th>
                <th>Status</th>
                <th width="18%">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($lokasi as $row)
                <tr>
                    <td>{{ $loop->iteration + ($lokasi->currentPage() - 1) * $lokasi->perPage() }}</td>
                    <td>{{ $row->kode_lokasi }}</td>
                    <td>{{ $row->nama_lokasi }}</td>
                    <td>{{ $row->jenis_lokasi }}</td>
                    <td>{{ $row->kota }}</td>
                    <td>
                        @if($row->status_aktif)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-secondary">Tidak Aktif</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('master-lokasi.edit', $row->id) }}" class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <form action="{{ route('master-lokasi.destroy', $row->id) }}"
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

        {{ $lokasi->links() }}
    @endif
@endsection

