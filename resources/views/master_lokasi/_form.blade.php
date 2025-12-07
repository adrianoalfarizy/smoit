<form action="{{ $route }}" method="POST">
    @csrf
    @if (in_array($method, ['PUT', 'PATCH']))
        @method($method)
    @endif

    <div class="mb-3">
        <label for="kode_lokasi" class="form-label">Kode Lokasi *</label>
        <input type="text"
               name="kode_lokasi"
               id="kode_lokasi"
               class="form-control @error('kode_lokasi') is-invalid @enderror"
               value="{{ old('kode_lokasi', $masterLokasi->kode_lokasi ?? '') }}">
        @error('kode_lokasi')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="nama_lokasi" class="form-label">Nama Lokasi *</label>
        <input type="text"
               name="nama_lokasi"
               id="nama_lokasi"
               class="form-control @error('nama_lokasi') is-invalid @enderror"
               value="{{ old('nama_lokasi', $masterLokasi->nama_lokasi ?? '') }}">
        @error('nama_lokasi')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="jenis_lokasi" class="form-label">Jenis Lokasi</label>
        <input type="text"
               name="jenis_lokasi"
               id="jenis_lokasi"
               placeholder="kantor / client / gudang"
               class="form-control @error('jenis_lokasi') is-invalid @enderror"
               value="{{ old('jenis_lokasi', $masterLokasi->jenis_lokasi ?? '') }}">
        @error('jenis_lokasi')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea name="alamat"
                  id="alamat"
                  rows="3"
                  class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $masterLokasi->alamat ?? '') }}</textarea>
        @error('alamat')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="kota" class="form-label">Kota</label>
            <input type="text"
                   name="kota"
                   id="kota"
                   class="form-control @error('kota') is-invalid @enderror"
                   value="{{ old('kota', $masterLokasi->kota ?? '') }}">
            @error('kota')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 col-md-6">
            <label for="pic_nama" class="form-label">Nama PIC</label>
            <input type="text"
                   name="pic_nama"
                   id="pic_nama"
                   class="form-control @error('pic_nama') is-invalid @enderror"
                   value="{{ old('pic_nama', $masterLokasi->pic_nama ?? '') }}">
            @error('pic_nama')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label for="pic_kontak" class="form-label">Kontak PIC</label>
        <input type="text"
               name="pic_kontak"
               id="pic_kontak"
               class="form-control @error('pic_kontak') is-invalid @enderror"
               value="{{ old('pic_kontak', $masterLokasi->pic_kontak ?? '') }}">
        @error('pic_kontak')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="status_aktif" class="form-label">Status *</label>
        @php
            $status = old('status_aktif', $masterLokasi->status_aktif ?? 1);
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
                  class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $masterLokasi->keterangan ?? '') }}</textarea>
        @error('keterangan')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">
        {{ $buttonText }}
    </button>
    <a href="{{ route('master-lokasi.index') }}" class="btn btn-secondary">
        Batal
    </a>
</form>

