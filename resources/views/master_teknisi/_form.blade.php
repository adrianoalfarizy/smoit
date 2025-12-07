<form action="{{ $route }}" method="POST">
    @csrf

    @if (in_array($method, ['PUT', 'PATCH']))
        @method($method)
    @endif

    <div class="mb-3">
        <label for="kode_teknisi" class="form-label">Kode Teknisi *</label>
        <input type="text"
               name="kode_teknisi"
               id="kode_teknisi"
               class="form-control @error('kode_teknisi') is-invalid @enderror"
               value="{{ old('kode_teknisi', $masterTeknisi->kode_teknisi ?? '') }}">
        @error('kode_teknisi')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="nama_lengkap" class="form-label">Nama Lengkap *</label>
        <input type="text"
               name="nama_lengkap"
               id="nama_lengkap"
               class="form-control @error('nama_lengkap') is-invalid @enderror"
               value="{{ old('nama_lengkap', $masterTeknisi->nama_lengkap ?? '') }}">
        @error('nama_lengkap')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="nik" class="form-label">NIK / ID Karyawan</label>
        <input type="text"
               name="nik"
               id="nik"
               class="form-control @error('nik') is-invalid @enderror"
               value="{{ old('nik', $masterTeknisi->nik ?? '') }}">
        @error('nik')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="jabatan" class="form-label">Jabatan</label>
        <input type="text"
               name="jabatan"
               id="jabatan"
               class="form-control @error('jabatan') is-invalid @enderror"
               value="{{ old('jabatan', $masterTeknisi->jabatan ?? '') }}">
        @error('jabatan')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="no_hp" class="form-label">No HP</label>
            <input type="text"
                   name="no_hp"
                   id="no_hp"
                   class="form-control @error('no_hp') is-invalid @enderror"
                   value="{{ old('no_hp', $masterTeknisi->no_hp ?? '') }}">
            @error('no_hp')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 col-md-6">
            <label for="email" class="form-label">Email Kerja</label>
            <input type="email"
                   name="email"
                   id="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email', $masterTeknisi->email ?? '') }}">
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label for="status_aktif" class="form-label">Status *</label>
        <select name="status_aktif"
                id="status_aktif"
                class="form-select @error('status_aktif') is-invalid @enderror">
            @php
                $status = old('status_aktif', $masterTeknisi->status_aktif ?? 1);
            @endphp
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
                  class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $masterTeknisi->keterangan ?? '') }}</textarea>
        @error('keterangan')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">
        {{ $buttonText }}
    </button>
    <a href="{{ route('master-teknisi.index') }}" class="btn btn-secondary">
        Batal
    </a>
</form>

    