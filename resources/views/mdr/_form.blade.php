<form action="{{ $route }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if (in_array($method, ['PUT', 'PATCH']))
        @method($method)
    @endif

    <div class="row mb-3">
        <div class="col-md-3">
            <label class="form-label">Tanggal *</label>
            <input type="date"
                   name="tanggal"
                   value="{{ old('tanggal', $mdr->tanggal ?? now()->toDateString()) }}"
                   class="form-control @error('tanggal') is-invalid @enderror">
            @error('tanggal') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-3">
            <label class="form-label">Teknisi *</label>
            <select name="teknisi_id" class="form-select @error('teknisi_id') is-invalid @enderror">
                <option value="">- Pilih -</option>
                @foreach($teknisi as $t)
                    <option value="{{ $t->id }}"
                        {{ old('teknisi_id', $mdr->teknisi_id ?? '') == $t->id ? 'selected' : '' }}>
                        {{ $t->nama_lengkap }}
                    </option>
                @endforeach
            </select>
            @error('teknisi_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-3">
            <label class="form-label">Lokasi *</label>
            <select name="lokasi_id" class="form-select @error('lokasi_id') is-invalid @enderror">
                <option value="">- Pilih -</option>
                @foreach($lokasi as $l)
                    <option value="{{ $l->id }}"
                        {{ old('lokasi_id', $mdr->lokasi_id ?? '') == $l->id ? 'selected' : '' }}>
                        {{ $l->nama_lokasi }}
                    </option>
                @endforeach
            </select>
            @error('lokasi_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-3">
            <label class="form-label">Kategori *</label>
            <select name="kategori_pekerjaan_id" class="form-select @error('kategori_pekerjaan_id') is-invalid @enderror">
                <option value="">- Pilih -</option>
                @foreach($kategori as $k)
                    <option value="{{ $k->id }}"
                        {{ old('kategori_pekerjaan_id', $mdr->kategori_pekerjaan_id ?? '') == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kategori }}
                    </option>
                @endforeach
            </select>
            @error('kategori_pekerjaan_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Nomor Tiket</label>
        <input type="text"
               name="nomor_tiket"
               value="{{ old('nomor_tiket', $mdr->nomor_tiket ?? '') }}"
               class="form-control @error('nomor_tiket') is-invalid @enderror">
        @error('nomor_tiket') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="row mb-3">
        <div class="col-md-3">
            <label class="form-label">Jam Mulai *</label>
            <input type="time"
                   name="jam_mulai"
                   value="{{ old('jam_mulai', $mdr->jam_mulai ?? '') }}"
                   class="form-control @error('jam_mulai') is-invalid @enderror">
            @error('jam_mulai') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-3">
            <label class="form-label">Jam Selesai</label>
            <input type="time"
                   name="jam_selesai"
                   value="{{ old('jam_selesai', $mdr->jam_selesai ?? '') }}"
                   class="form-control @error('jam_selesai') is-invalid @enderror">
            @error('jam_selesai') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-3">
            <label class="form-label">Status Pekerjaan *</label>
            <input type="text"
                   name="status_pekerjaan"
                   value="{{ old('status_pekerjaan', $mdr->status_pekerjaan ?? '') }}"
                   class="form-control @error('status_pekerjaan') is-invalid @enderror"
                   placeholder="Open / Progress / Done">
            @error('status_pekerjaan') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Deskripsi Pekerjaan *</label>
        <textarea name="deskripsi_pekerjaan"
                  rows="3"
                  class="form-control @error('deskripsi_pekerjaan') is-invalid @enderror">{{ old('deskripsi_pekerjaan', $mdr->deskripsi_pekerjaan ?? '') }}</textarea>
        @error('deskripsi_pekerjaan') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Catatan</label>
        <textarea name="catatan"
                  rows="2"
                  class="form-control @error('catatan') is-invalid @enderror">{{ old('catatan', $mdr->catatan ?? '') }}</textarea>
        @error('catatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Bukti Pekerjaan (foto/pdf)</label>
        <input type="file"
               name="bukti_pekerjaan"
               class="form-control @error('bukti_pekerjaan') is-invalid @enderror">
        @error('bukti_pekerjaan') <div class="invalid-feedback">{{ $message }}</div> @enderror

        @if(!empty($mdr->bukti_pekerjaan))
            <small class="d-block mt-1">
                File saat ini:
                <a href="{{ asset('storage/' . $mdr->bukti_pekerjaan) }}" target="_blank">Lihat bukti</a>
            </small>
        @endif
    </div>

    <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
    <a href="{{ route('mdr.index') }}" class="btn btn-secondary">Batal</a>
</form>

