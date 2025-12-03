@extends('layouts.app')

@section('title', 'Detail Perjalanan Dinas')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1>📄 Detail Perjalanan Dinas</h1>
        <span class="badge badge-{{ $perjadinForm->status }}">
            {{ match($perjadinForm->status) {
                'draft' => 'Draft',
                'submitted' => 'Submitted',
                'approved' => 'Approved',
                'rejected' => 'Rejected',
                default => $perjadinForm->status,
            } }}
        </span>
    </div>

    <!-- Informasi Pengguna -->
    <fieldset style="border: 1px solid #ddd; padding: 1.5rem; border-radius: 4px; margin-bottom: 2rem;">
        <legend style="padding: 0 0.5rem; font-weight: bold;">Informasi Pengguna</legend>
        <div class="form-row">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" value="{{ $perjadinForm->nama }}" disabled>
            </div>
            <div class="form-group">
                <label>NIP</label>
                <input type="text" value="{{ $perjadinForm->nip }}" disabled>
            </div>
        </div>
    </fieldset>

    <!-- Informasi Surat -->
    <fieldset style="border: 1px solid #ddd; padding: 1.5rem; border-radius: 4px; margin-bottom: 2rem;">
        <legend style="padding: 0 0.5rem; font-weight: bold;">Informasi Surat</legend>
        <div class="form-row">
            <div class="form-group">
                <label>Nomor Surat</label>
                <input type="text" value="{{ $perjadinForm->nomor_surat }}" disabled>
            </div>
            <div class="form-group">
                <label>Tanggal Surat</label>
                <input type="text" value="{{ $perjadinForm->tanggal_surat->format('d/m/Y') }}" disabled>
            </div>
        </div>
    </fieldset>

    <!-- Tanggal Perjalanan -->
    <fieldset style="border: 1px solid #ddd; padding: 1.5rem; border-radius: 4px; margin-bottom: 2rem;">
        <legend style="padding: 0 0.5rem; font-weight: bold;">Tanggal Perjalanan</legend>
        <div class="form-row">
            <div class="form-group">
                <label>Tanggal Berangkat</label>
                <input type="text" value="{{ $perjadinForm->tanggal_berangkat->format('d/m/Y') }}" disabled>
            </div>
            <div class="form-group">
                <label>Tanggal Pulang</label>
                <input type="text" value="{{ $perjadinForm->tanggal_pulang->format('d/m/Y') }}" disabled>
            </div>
        </div>
    </fieldset>

    <!-- Informasi Kegiatan -->
    <fieldset style="border: 1px solid #ddd; padding: 1.5rem; border-radius: 4px; margin-bottom: 2rem;">
        <legend style="padding: 0 0.5rem; font-weight: bold;">Informasi Kegiatan</legend>
        <div class="form-row">
            <div class="form-group">
                <label>Nama Kegiatan</label>
                <input type="text" value="{{ $perjadinForm->nama_kegiatan }}" disabled>
            </div>
            <div class="form-group">
                <label>Jenis Kegiatan</label>
                <input type="text" value="{{ $perjadinForm->jenis_kegiatan === 'dalam_kota' ? 'Dalam Kota' : 'Luar Kota' }}" disabled>
            </div>
        </div>
    </fieldset>

    <!-- Lokasi Kegiatan -->
    <fieldset style="border: 1px solid #ddd; padding: 1.5rem; border-radius: 4px; margin-bottom: 2rem;">
        <legend style="padding: 0 0.5rem; font-weight: bold;">Lokasi Kegiatan</legend>
        <div class="form-group">
            <label>Nama Instansi</label>
            <input type="text" value="{{ $perjadinForm->nama_instansi }}" disabled>
        </div>
        <div class="form-group">
            <label>Alamat Kegiatan</label>
            <textarea disabled>{{ $perjadinForm->alamat_kegiatan }}</textarea>
        </div>
    </fieldset>

    <!-- Dokumen -->
    @if ($perjadinForm->surat_kegiatan)
        <fieldset style="border: 1px solid #ddd; padding: 1.5rem; border-radius: 4px; margin-bottom: 2rem;">
            <legend style="padding: 0 0.5rem; font-weight: bold;">Dokumen</legend>
            <div class="form-group">
                <label>Surat Kegiatan</label>
                <div style="margin-top: 0.5rem;">
                    <a href="{{ asset('storage/' . $perjadinForm->surat_kegiatan) }}" target="_blank" class="btn btn-primary">
                        📥 Download File
                    </a>
                </div>
            </div>
        </fieldset>
    @endif

    <!-- Catatan Admin -->
    @if ($perjadinForm->catatan_admin)
        <fieldset style="border: 1px solid #ddd; padding: 1.5rem; border-radius: 4px; margin-bottom: 2rem;">
            <legend style="padding: 0 0.5rem; font-weight: bold;">Catatan Admin</legend>
            <div style="background-color: #f9f9f9; padding: 1rem; border-radius: 4px;">
                {{ $perjadinForm->catatan_admin }}
            </div>
        </fieldset>
    @endif

    <!-- Informasi Tambahan -->
    <fieldset style="border: 1px solid #ddd; padding: 1.5rem; border-radius: 4px; margin-bottom: 2rem;">
        <legend style="padding: 0 0.5rem; font-weight: bold;">Informasi Tambahan</legend>
        <div class="form-row">
            <div class="form-group">
                <label>Dibuat Pada</label>
                <input type="text" value="{{ $perjadinForm->created_at->format('d/m/Y H:i') }}" disabled>
            </div>
            <div class="form-group">
                <label>Diupdate Pada</label>
                <input type="text" value="{{ $perjadinForm->updated_at->format('d/m/Y H:i') }}" disabled>
            </div>
        </div>
    </fieldset>

    <div style="display: flex; gap: 1rem; justify-content: center;">
        @if ($perjadinForm->status === 'draft')
            <a href="{{ route('perjadin.edit', $perjadinForm) }}" class="btn btn-secondary">Edit</a>
            <form action="{{ route('perjadin.destroy', $perjadinForm) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        @endif
        <a href="{{ route('perjadin.history') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
