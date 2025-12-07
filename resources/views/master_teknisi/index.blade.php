@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Master Teknisi</h1>
        <a href="{{ route('master-teknisi.create') }}" class="btn btn-primary">
            + Tambah Teknisi
        </a>
    </div>

    @if ($teknisi->count() === 0)
        <div class="alert alert-info">
            Belum ada data teknisi. Klik <strong>Tambah Teknisi</strong> untuk menambah data baru.
        </div>
    @else
        <table class="table table-bordered table-striped align-middle">
            <thead>
            <tr>
                <th width="5%">#</th>
                <th>Kode</th>
                <th>Nama Lengkap</th>
                <th>Jabatan</th>
                <th>No HP</th>
                <th>Status</th>
                <th width="18%">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($teknisi as $row)
                <tr>
                    <td>{{ $loop->iteration + ($teknisi->currentPage() - 1) * $teknisi->perPage() }}</td>
                    <td>{{ $row->kode_teknisi }}</td>
                    <td>{{ $row->nama_lengkap }}</td>
                    <td>{{ $row->jabatan }}</td>
                    <td>{{ $row->no_hp }}</td>
                    <td>
                        @if($row->status_aktif)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-secondary">Tidak Aktif</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('master-teknisi.edit', $row->id) }}" class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <form action="{{ route('master-teknisi.destroy', $row->id) }}"
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

        {{-- Pagination --}}
        {{ $teknisi->links() }}
    @endif
@endsection

