@extends('layouts.app')

@section('title', 'Form Perjalanan Dinas')

@section('content')
<style>
    .disabled-input {
        background-color: #f8f9fa !important;
        border: 1px solid #e9ecef !important;
        color: #6c757d !important;
        cursor: not-allowed !important;
        opacity: 0.8 !important;
        font-weight: 500 !important;
    }
    
    .disabled-input:focus {
        outline: none !important;
        box-shadow: none !important;
        border-color: #e9ecef !important;
    }
    
    .form-group label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
    }
    
    /* Style untuk date picker disabled dates */
    input[type="date"]::-webkit-calendar-picker-indicator {
        cursor: pointer;
    }
    
    /* Style untuk dates yang disabled di date picker */
    input[type="date"]:disabled {
        background-color: #f8f9fa !important;
        border: 1px solid #e9ecef !important;
        color: #6c757d !important;
        cursor: not-allowed !important;
        opacity: 0.8 !important;
    }
    
    /* Custom styling untuk calendar picker */
    input[type="date"]::-webkit-datetime-edit-text {
        color: #495057;
    }
    
    input[type="date"]::-webkit-datetime-edit-month-field {
        color: #495057;
    }
    
    input[type="date"]::-webkit-datetime-edit-day-field {
        color: #495057;
    }
    
    input[type="date"]::-webkit-datetime-edit-year-field {
        color: #495057;
    }
    
    /* Style untuk calendar popup */
    input[type="date"]::-webkit-calendar-picker-indicator:hover {
        background-color: #e9ecef;
        border-radius: 4px;
    }
    
    /* Additional styling untuk better UX */
    input[type="date"]:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    
    @media (max-width: 768px) {
        .disabled-input {
            font-size: 0.9rem;
            padding: 0.6rem;
        }
    }
</style>

<div class="card">
    <h1 style="margin-bottom: 2rem;">📝 Form Perjalanan Dinas</h1>

    <form action="{{ route('perjadin.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Informasi Pengguna -->
        <fieldset style="border: 1px solid #ddd; padding: 1.5rem; border-radius: 4px; margin-bottom: 2rem;">
            <legend style="padding: 0 0.5rem; font-weight: bold;">Informasi Pengguna</legend>
            <div class="form-row">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" value="{{ auth()->user()->name }}" disabled class="disabled-input" readonly>
                </div>
                <div class="form-group">
                    <label>NIP</label>
                    <input type="text" value="{{ auth()->user()->nip }}" disabled class="disabled-input" readonly>
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

            <!-- Pengikut Section -->
            <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #eee;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                    <label style="font-weight: bold; margin: 0;">Pengikut</label>
                    <button type="button" id="addFollowerBtn" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.875rem;">+ Tambah Pengikut</button>
                </div>

                <div id="followersContainer">
                    @php
                        $followers = old('followers', []);
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
            <a href="{{ route('perjadin.history') }}" class="btn btn-secondary">Batal</a>
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

    // Validasi tanggal pulang tidak boleh sebelum tanggal berangkat
    function validateDateRange() {
        const tanggalBerangkat = document.getElementById('tanggal_berangkat');
        const tanggalPulang = document.getElementById('tanggal_pulang');
        
        if (tanggalBerangkat && tanggalPulang) {
            // Event listener untuk perubahan tanggal berangkat
            tanggalBerangkat.addEventListener('change', function() {
                if (this.value) {
                    // Set min date untuk tanggal pulang
                    tanggalPulang.min = this.value;
                    
                    // Add visual feedback
                    tanggalPulang.style.backgroundColor = '#fff';
                    tanggalPulang.style.borderColor = '#ddd';
                    
                    // Jika tanggal pulang sudah dipilih dan kurang dari tanggal berangkat, reset
                    if (tanggalPulang.value && tanggalPulang.value < this.value) {
                        tanggalPulang.value = '';
                        tanggalPulang.setCustomValidity('Tanggal pulang harus setelah atau sama dengan tanggal berangkat');
                        
                        // Add error styling
                        tanggalPulang.style.backgroundColor = '#fff5f5';
                        tanggalPulang.style.borderColor = '#e53e3e';
                    } else {
                        tanggalPulang.setCustomValidity('');
                    }
                }
            });
            
            // Event listener untuk input event (saat user mengetik)
            tanggalPulang.addEventListener('input', function() {
                if (this.value && tanggalBerangkat.value && this.value < tanggalBerangkat.value) {
                    // Clear invalid input immediately
                    this.value = '';
                    this.setCustomValidity('Tanggal pulang harus setelah atau sama dengan tanggal berangkat');
                    
                    // Add error styling
                    this.style.backgroundColor = '#fff5f5';
                    this.style.borderColor = '#e53e3e';
                    
                    // Show browser validation
                    this.reportValidity();
                } else {
                    this.setCustomValidity('');
                    this.style.backgroundColor = '#fff';
                    this.style.borderColor = '#ddd';
                }
            });
            
            // Event listener untuk perubahan tanggal pulang (change event)
            tanggalPulang.addEventListener('change', function() {
                if (this.value && tanggalBerangkat.value && this.value < tanggalBerangkat.value) {
                    // Clear the invalid value
                    this.value = '';
                    this.setCustomValidity('Tanggal pulang harus setelah atau sama dengan tanggal berangkat');
                    
                    // Add error styling
                    this.style.backgroundColor = '#fff5f5';
                    this.style.borderColor = '#e53e3e';
                    
                    // Show browser validation message
                    this.reportValidity();
                } else {
                    this.setCustomValidity('');
                    
                    // Reset styling
                    this.style.backgroundColor = '#fff';
                    this.style.borderColor = '#ddd';
                }
            });
            
            // Prevent paste of invalid dates
            tanggalPulang.addEventListener('paste', function(e) {
                e.preventDefault();
                
                // Get pasted data
                const pastedData = (e.clipboardData || window.clipboardData).getData('text');
                
                // Validate pasted date
                if (pastedData && tanggalBerangkat.value && pastedData < tanggalBerangkat.value) {
                    this.setCustomValidity('Tanggal pulang harus setelah atau sama dengan tanggal berangkat');
                    this.style.backgroundColor = '#fff5f5';
                    this.style.borderColor = '#e53e3e';
                    this.reportValidity();
                } else if (pastedData) {
                    this.value = pastedData;
                    this.setCustomValidity('');
                    this.style.backgroundColor = '#fff';
                    this.style.borderColor = '#ddd';
                }
            });
            
            // Add hover effect untuk date picker
            tanggalPulang.addEventListener('mouseenter', function() {
                if (this.min) {
                    this.style.cursor = 'pointer';
                }
            });
        }
    }
    
    // Initialize date validation
    validateDateRange();
</script>
@endsection
