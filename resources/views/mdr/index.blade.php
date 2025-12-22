@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-3">Maintenance Daily Report (MDR)</h1>

    {{-- Filter --}}
    <form method="GET" class="card card-body mb-3">
        <div class="row g-2">
            <div class="col-md-3">
                <label class="form-label">Tanggal dari</label>
                <input type="date" name="tanggal_dari" value="{{ request('tanggal_dari') }}" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label">Tanggal sampai</label>
                <input type="date" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}" class="form-control">
            </div>
            <div class="col-md-2">
                <label class="form-label">Teknisi</label>
                <select name="teknisi_id" class="form-select">
                    <option value="">- Semua -</option>
                    @foreach($teknisi as $t)
                        <option value="{{ $t->id }}" {{ request('teknisi_id') == $t->id ? 'selected' : '' }}>
                            {{ $t->nama_lengkap }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Lokasi</label>
                <select name="lokasi_id" class="form-select">
                    <option value="">- Semua -</option>
                    @foreach($lokasi as $l)
                        <option value="{{ $l->id }}" {{ request('lokasi_id') == $l->id ? 'selected' : '' }}>
                            {{ $l->nama_lokasi }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Kategori</label>
                <select name="kategori_pekerjaan_id" class="form-select">
                    <option value="">- Semua -</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->id }}" {{ request('kategori_pekerjaan_id') == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mt-3 d-flex justify-content-between">
            <div>
                <button class="btn btn-primary" type="submit">Filter</button>
                <a href="{{ route('mdr.index') }}" class="btn btn-secondary">Reset</a>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('mdr.export.pdf', request()->query()) }}" class="btn btn-outline-danger btn-sm">
                    Export PDF
                </a>
                <a href="{{ route('mdr.export.excel', request()->query()) }}" class="btn btn-outline-success btn-sm">
                    Export Excel
                </a>
                <a href="{{ route('mdr.create') }}" class="btn btn-success btn-sm">
                    + Tambah MDR
                </a>
            </div>
        </div>
    </form>

    @if ($mdr->count() === 0)
        <div class="alert alert-info">
            Belum ada data MDR.
        </div>
    @else
        <table class="table table-bordered table-striped align-middle">
            <thead>
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Teknisi</th>
                <th>Lokasi</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Bukti</th>
                <th width="15%">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($mdr as $row)
                <tr>
                    <td>{{ $loop->iteration + ($mdr->currentPage() - 1) * $mdr->perPage() }}</td>
                    <td>{{ $row->tanggal }}</td>
                    <td>{{ $row->teknisi->nama_lengkap ?? '-' }}</td>
                    <td>{{ $row->lokasi->nama_lokasi ?? '-' }}</td>
                    <td>{{ $row->kategoriPekerjaan->nama_kategori ?? '-' }}</td>
                    <td>{{ $row->status_pekerjaan }}</td>
                    <td>
                        @if($row->bukti_pekerjaan)
                            <a href="{{ asset('storage/' . $row->bukti_pekerjaan) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                Lihat
                            </a>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('mdr.edit', $row->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('mdr.destroy', $row->id) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $mdr->links() }}
    @endif
@endsection

