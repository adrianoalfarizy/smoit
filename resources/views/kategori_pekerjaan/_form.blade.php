<form action="{{ $route }}" method="POST">
    @csrf
    @if (in_array($method, ['PUT', 'PATCH']))
        @method($method)
    @endif

    <div class="mb-3">
        <label for="kode_kategori" class="form-label">Kode Kategori *</label>
        <input type="text"
               name="kode_kategori"
               id="kode_kategori"
               class="form-control @error('kode_kategori') is-invalid @enderror"
               value="{{ old('kode_kategori', $kategoriPekerjaan->kode_kategori ?? '') }}">
        @error('kode_kategori')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="nama_kategori" class="form-label">Nama Kategori *</label>
        <input type="text"
               name="nama_kategori"
               id="nama_kategori"
               class="form-control @error('nama_kategori') is-invalid @enderror"
               value="{{ old('nama_kategori', $kategoriPekerjaan->nama_kategori ?? '') }}">
        @error('nama_kategori')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea name="deskripsi"
                  id="deskripsi"
                  rows="3"
                  class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $kategoriPekerjaan->deskripsi ?? '') }}</textarea>
        @error('deskripsi')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="sla_jam_response" class="form-label">SLA Jam Response</label>
            <input type="number"
                   min="0"
                   name="sla_jam_response"
                   id="sla_jam_response"
                   class="form-control @error('sla_jam_response') is-invalid @enderror"
                   value="{{ old('sla_jam_response', $kategoriPekerjaan->sla_jam_response ?? '') }}">
            @error('sla_jam_response')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 col-md-6">
            <label for="sla_jam_selesai" class="form-label">SLA Jam Selesai</label>
            <input type="number"
                   min="0"
                   name="sla_jam_selesai"
                   id="sla_jam_selesai"
                   class="form-control @error('sla_jam_selesai') is-invalid @enderror"
                   value="{{ old('sla_jam_selesai', $kategoriPekerjaan->sla_jam_selesai ?? '') }}">
            @error('sla_jam_selesai')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label for="status_aktif" class="form-label">Status *</label>
        @php
            $status = old('status_aktif', $kategoriPekerjaan->status_aktif ?? 1);
        @endphp
        <select name="status_aktif"
                id="status_aktif"
                class="form-select @error('status_aktif') is-invalid @enderror">
            <option value="1" {{ $status == 1 ? 'selected' : '' }}>Aktif</option>
            <option value="0" {{ $status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
        </select>
        @error('status_aktif')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="keterangan" class="form-label">Keterangan</label>
        <textarea name="keterangan"
                  id="keterangan"
                  rows="3"
                  class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $kategoriPekerjaan->keterangan ?? '') }}</textarea>
        @error('keterangan')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">
        {{ $buttonText }}
    </button>
    <a href="{{ route('kategori-pekerjaan.index') }}" class="btn btn-secondary">
        Batal
    </a>
</form>

