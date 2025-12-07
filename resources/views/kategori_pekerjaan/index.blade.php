@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Kategori Pekerjaan</h1>
        <a href="{{ route('kategori-pekerjaan.create') }}" class="btn btn-primary">
            + Tambah Kategori
        </a>
    </div>

    @if ($kategoriPekerjaan->count() === 0)
        <div class="alert alert-info">
            Belum ada kategori pekerjaan. Klik <strong>Tambah Kategori</strong> untuk menambah data baru.
        </div>
    @else
        <table class="table table-bordered table-striped align-middle">
            <thead>
            <tr>
                <th>#</th>
                <th>Kode</th>
                <th>Nama Kategori</th>
                <th>SLA Response (jam)</th>
                <th>SLA Selesai (jam)</th>
                <th>Status</th>
                <th width="18%">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($kategoriPekerjaan as $row)
                <tr>
                    <td>{{ $loop->iteration + ($kategoriPekerjaan->currentPage() - 1) * $kategoriPekerjaan->perPage() }}</td>
                    <td>{{ $row->kode_kategori }}</td>
                    <td>{{ $row->nama_kategori }}</td>
                    <td>{{ $row->sla_jam_response }}</td>
                    <td>{{ $row->sla_jam_selesai }}</td>
                    <td>
                        @if($row->status_aktif)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-secondary">Tidak Aktif</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('kategori-pekerjaan.edit', $row->id) }}" class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <form action="{{ route('kategori-pekerjaan.destroy', $row->id) }}"
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

        {{ $kategoriPekerjaan->links() }}
    @endif
@endsection

