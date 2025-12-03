@extends('layouts.app')

@section('title', 'Edit Perjalanan Dinas')

@section('content')
<div class="card">
    <h1 style="margin-bottom: 2rem;">✏️ Edit Perjalanan Dinas</h1>

    <form action="{{ route('perjadin.update', $perjadianForm) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Informasi Pengguna -->
        <fieldset style="border: 1px solid #ddd; padding: 1.5rem; border-radius: 4px; margin-bottom: 2rem;">
            <legend style="padding: 0 0.5rem; font-weight: bold;">Informasi Pengguna</legend>
            <div class="form-row">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" value="{{ $perjadianForm->nama }}" disabled>
                </div>
                <div class="form-group">
                    <label>NIP</label>
                    <input type="text" value="{{ $perjadianForm->nip }}" disabled>
                </div>
            </div>
        </fieldset>

        <!-- Informasi Surat -->
        <fieldset style="border: 1px solid #ddd; padding: 1.5rem; border-radius: 4px; margin-bottom: 2rem;">
            <legend style="padding: 0 0.5rem; font-weight: bold;">Informasi Surat</legend>
            <div class="form-row">
                <div class="form-group">
                    <label for="nomor_surat">Nomor Surat *</label>
                    <input type="text" id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat', $perjadianForm->nomor_surat) }}" required>
                    @error('nomor_surat')
                        <span style="color: #e74c3c; font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tanggal_surat">Tanggal Surat *</label>
                    <input type="date" id="tanggal_surat" name="tanggal_surat" value="{{ old('tanggal_surat', $perjadianForm->tanggal_surat->format('Y-m-d')) }}" required>
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
                    <input type="date" id="tanggal_berangkat" name="tanggal_berangkat" value="{{ old('tanggal_berangkat', $perjadianForm->tanggal_berangkat->format('Y-m-d')) }}" required>
                    @error('tanggal_berangkat')
                        <span style="color: #e74c3c; font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tanggal_pulang">Tanggal Pulang *</label>
                    <input type="date" id="tanggal_pulang" name="tanggal_pulang" value="{{ old('tanggal_pulang', $perjadianForm->tanggal_pulang->format('Y-m-d')) }}" required>
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
                    <input type="text" id="nama_kegiatan" name="nama_kegiatan" value="{{ old('nama_kegiatan', $perjadianForm->nama_kegiatan) }}" required>
                    @error('nama_kegiatan')
                        <span style="color: #e74c3c; font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jenis_kegiatan">Jenis Kegiatan *</label>
                    <select id="jenis_kegiatan" name="jenis_kegiatan" required>
                        <option value="">-- Pilih --</option>
                        <option value="dalam_kota" {{ old('jenis_kegiatan', $perjadianForm->jenis_kegiatan) === 'dalam_kota' ? 'selected' : '' }}>Dalam Kota</option>
                        <option value="luar_kota" {{ old('jenis_kegiatan', $perjadianForm->jenis_kegiatan) === 'luar_kota' ? 'selected' : '' }}>Luar Kota</option>
                    </select>
                    @error('jenis_kegiatan')
                        <span style="color: #e74c3c; font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Pengikut Section -->
            <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #eee;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                    <label style="font-weight: bold; margin: 0;">Pengikut</label>
                    <button type="button" id="addFollowerBtn" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.875rem;">+ Tambah Pengikut</button>
                </div>

                <div id="followersContainer">
                    @php
                        $followers = old('followers', $perjadianForm->pengikut ?? []);
                    @endphp
                    @if (count($followers) > 0)
                        @foreach ($followers as $index => $follower)
                            <div class="follower-item" style="display: flex; gap: 0.5rem; margin-bottom: 1rem; align-items: flex-end;">
                                <div style="flex: 1;">
                                    <select name="followers[]" class="follower-select" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                                        <option value="">-- Pilih Pengikut --</option>
                                        @foreach (\App\Models\User::where('role', 'user')->get() as $user)
                                            <option value="{{ $user->id }}" {{ $follower == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->nip }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="button" class="removeFollowerBtn btn btn-danger" style="padding: 0.5rem 1rem; font-size: 0.875rem;">🗑️ Hapus</button>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </fieldset>

        <!-- Lokasi Kegiatan -->
        <fieldset style="border: 1px solid #ddd; padding: 1.5rem; border-radius: 4px; margin-bottom: 2rem;">
            <legend style="padding: 0 0.5rem; font-weight: bold;">Lokasi Kegiatan</legend>
            <div class="form-group">
                <label for="nama_instansi">Nama Instansi *</label>
                <input type="text" id="nama_instansi" name="nama_instansi" value="{{ old('nama_instansi', $perjadianForm->nama_instansi) }}" required>
                @error('nama_instansi')
                    <span style="color: #e74c3c; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="alamat_kegiatan">Alamat Kegiatan *</label>
                <textarea id="alamat_kegiatan" name="alamat_kegiatan" required>{{ old('alamat_kegiatan', $perjadianForm->alamat_kegiatan) }}</textarea>
                @error('alamat_kegiatan')
                    <span style="color: #e74c3c; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>
        </fieldset>

        <!-- Dokumen -->
        <fieldset style="border: 1px solid #ddd; padding: 1.5rem; border-radius: 4px; margin-bottom: 2rem;">
            <legend style="padding: 0 0.5rem; font-weight: bold;">Dokumen</legend>
            @if ($perjadianForm->surat_kegiatan)
                <div class="form-group" style="margin-bottom: 1rem;">
                    <label>File Saat Ini</label>
                    <div style="margin-top: 0.5rem;">
                        <a href="{{ asset('storage/' . $perjadianForm->surat_kegiatan) }}" target="_blank" class="btn btn-primary" style="padding: 0.5rem 1rem;">
                            📥 Download File
                        </a>
                    </div>
                </div>
            @endif
            <div class="form-group">
                <label for="surat_kegiatan">Upload Surat Kegiatan Baru (PDF/Gambar, Max 5MB)</label>
                <input type="file" id="surat_kegiatan" name="surat_kegiatan" accept=".pdf,.jpg,.jpeg,.png">
                <small style="color: #7f8c8d;">Biarkan kosong jika tidak ingin mengubah file</small>
                @error('surat_kegiatan')
                    <span style="color: #e74c3c; font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>
        </fieldset>

        <div style="display: flex; gap: 1rem; justify-content: center;">
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="{{ route('perjadin.show', $perjadianForm) }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<script>
    // Get all users untuk dropdown
    const allUsers = [
        @foreach (\App\Models\User::where('role', 'user')->get() as $user)
            { id: {{ $user->id }}, name: '{{ $user->name }}', nip: '{{ $user->nip }}' },
        @endforeach
    ];

    // Tombol tambah pengikut
    document.getElementById('addFollowerBtn').addEventListener('click', function(e) {
        e.preventDefault();
        
        const container = document.getElementById('followersContainer');
        const followerItem = document.createElement('div');
        followerItem.className = 'follower-item';
        followerItem.style.cssText = 'display: flex; gap: 0.5rem; margin-bottom: 1rem; align-items: flex-end;';
        
        let optionsHtml = '<option value="">-- Pilih Pengikut --</option>';
        allUsers.forEach(user => {
            optionsHtml += `<option value="${user.id}">${user.name} (${user.nip})</option>`;
        });
        
        followerItem.innerHTML = `
            <div style="flex: 1;">
                <select name="followers[]" class="follower-select" required style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                    ${optionsHtml}
                </select>
            </div>
            <button type="button" class="removeFollowerBtn btn btn-danger" style="padding: 0.5rem 1rem; font-size: 0.875rem;">🗑️ Hapus</button>
        `;
        
        container.appendChild(followerItem);
        
        // Attach event listener ke tombol hapus baru
        followerItem.querySelector('.removeFollowerBtn').addEventListener('click', function(e) {
            e.preventDefault();
            followerItem.remove();
        });
    });

    // Event listener untuk tombol hapus yang sudah ada
    document.querySelectorAll('.removeFollowerBtn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            this.closest('.follower-item').remove();
        });
    });
</script>
@endsection
