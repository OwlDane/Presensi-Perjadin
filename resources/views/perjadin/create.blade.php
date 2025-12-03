@extends('layouts.app')

@section('title', 'Form Perjalanan Dinas')

@section('content')
<div class="card">
    <h1 style="margin-bottom: 2rem;">📝 Form Perjalanan Dinas</h1>

    <form action="{{ route('perjadian.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Informasi Pengguna -->
        <fieldset style="border: 1px solid #ddd; padding: 1.5rem; border-radius: 4px; margin-bottom: 2rem;">
            <legend style="padding: 0 0.5rem; font-weight: bold;">Informasi Pengguna</legend>
            <div class="form-row">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" value="{{ auth()->user()->name }}" disabled>
                </div>
                <div class="form-group">
                    <label>NIP</label>
                    <input type="text" value="{{ auth()->user()->nip }}" disabled>
                </div>
            </div>
        </fieldset>

        <!-- Informasi Surat -->
        <fieldset style="border: 1px solid #ddd; padding: 1.5rem; border-radius: 4px; margin-bottom: 2rem;">
            <legend style="padding: 0 0.5rem; font-weight: bold;">Informasi Surat</legend>
            <div class="form-row">
                <div class="form-group">
                    <label for="nomor_surat">Nomor Surat *</label>
                    <input type="text" id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat') }}" required>
                    @error('nomor_surat')
                        <span style="color: #e74c3c; font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tanggal_surat">Tanggal Surat *</label>
                    <input type="date" id="tanggal_surat" name="tanggal_surat" value="{{ old('tanggal_surat') }}" required>
                    @error('tanggal_surat')
                        <span style="color: #e74c3c; font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </fieldset>

        <!-- Tanggal Perjalanan -->
        <fieldset style="border: 1px solid #ddd; padding: 1.5rem; border-radius: 4px; margin-bottom: 2rem;">
            <legend style="padding: 0 0.5rem; font-weight: bold;">Tanggal Perjalanan</legend>
            <div class="form-row">
                <div class="form-group">
                    <label for="tanggal_berangkat">Tanggal Berangkat *</label>
                    <input type="date" id="tanggal_berangkat" name="tanggal_berangkat" value="{{ old('tanggal_berangkat') }}" required>
                    @error('tanggal_berangkat')
                        <span style="color: #e74c3c; font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tanggal_pulang">Tanggal Pulang *</label>
                    <input type="date" id="tanggal_pulang" name="tanggal_pulang" value="{{ old('tanggal_pulang') }}" required>
                    @error('tanggal_pulang')
                        <span style="color: #e74c3c; font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </fieldset>

        <!-- Informasi Kegiatan -->
        <fieldset style="border: 1px solid #ddd; padding: 1.5rem; border-radius: 4px; margin-bottom: 2rem;">
            <legend style="padding: 0 0.5rem; font-weight: bold;">Informasi Kegiatan</legend>
            <div class="form-row">
                <div class="form-group">
                    <label for="nama_kegiatan">Nama Kegiatan *</label>
                    <input type="text" id="nama_kegiatan" name="nama_kegiatan" value="{{ old('nama_kegiatan') }}" required>
                    @error('nama_kegiatan')
                        <span style="color: #e74c3c; font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jenis_kegiatan">Jenis Kegiatan *</label>
                    <select id="jenis_kegiatan" name="jenis_kegiatan" required>
                        <option value="">-- Pilih --</option>
                        <option value="dalam_kota" {{ old('jenis_kegiatan') === 'dalam_kota' ? 'selected' : '' }}>Dalam Kota</option>
                        <option value="luar_kota" {{ old('jenis_kegiatan') === 'luar_kota' ? 'selected' : '' }}>Luar Kota</option>
                    </select>
                    @error('jenis_kegiatan')
                        <span style="color: #e74c3c; font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </fieldset>

        <!-- Lokasi Kegiatan -->
        <fieldset style="border: 1px solid #ddd; padding: 1.5rem; border-radius: 4px; margin-bottom: 2rem;">
            <legend style="padding: 0 0.5rem; font-weight: bold;">Lokasi Kegiatan</legend>
            <div class="form-group">
                <label for="nama_instansi">Nama Instansi *</label>
                <input type="text" id="nama_instansi" name="nama_instansi" value="{{ old('nama_instansi') }}" required>
                @error('nama_instansi')
                    <span style="color: #e74c3c; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="alamat_kegiatan">Alamat Kegiatan *</label>
                <textarea id="alamat_kegiatan" name="alamat_kegiatan" required>{{ old('alamat_kegiatan') }}</textarea>
                @error('alamat_kegiatan')
                    <span style="color: #e74c3c; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>
        </fieldset>

        <!-- Dokumen -->
        <fieldset style="border: 1px solid #ddd; padding: 1.5rem; border-radius: 4px; margin-bottom: 2rem;">
            <legend style="padding: 0 0.5rem; font-weight: bold;">Dokumen</legend>
            <div class="form-group">
                <label for="surat_kegiatan">Upload Surat Kegiatan (PDF/Gambar, Max 5MB)</label>
                <input type="file" id="surat_kegiatan" name="surat_kegiatan" accept=".pdf,.jpg,.jpeg,.png">
                @error('surat_kegiatan')
                    <span style="color: #e74c3c; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>
        </fieldset>

        <div style="display: flex; gap: 1rem; justify-content: center;">
            <button type="submit" class="btn btn-success">Kirim Form</button>
            <a href="{{ route('perjadian.history') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
