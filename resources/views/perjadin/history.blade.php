@extends('layouts.app')

@section('title', 'Riwayat Perjalanan Dinas')

@section('content')
<style>
    .header-with-button {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        gap: 1rem;
    }

    .header-with-button h1 {
        margin: 0;
        flex: 1;
    }

    .btn-form-baru {
        padding: 0.75rem 1.5rem;
        background-color: #3498db;
        color: white;
        border: none;
        border-radius: 4px;
        text-decoration: none;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .btn-form-baru:hover {
        background-color: #2980b9;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    @media (max-width: 768px) {
        .header-with-button {
            flex-direction: column;
            align-items: stretch;
            margin-bottom: 1.5rem;
        }

        .header-with-button h1 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .btn-form-baru {
            width: 100%;
            padding: 1rem;
            font-size: 1rem;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            box-shadow: 0 2px 8px rgba(52, 152, 219, 0.3);
        }

        .btn-form-baru:active {
            transform: translateY(0);
            box-shadow: 0 1px 4px rgba(52, 152, 219, 0.2);
        }
    }
</style>

<div class="card">
    <div class="header-with-button">
        <h1>📋 Riwayat Perjalanan Dinas</h1>
        <a href="{{ route('perjadin.create') }}" class="btn-form-baru">📝 Form Baru</a>
    </div>

    @if ($forms->count() > 0)
        <div style="overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>No. Surat</th>
                        <th>Kegiatan</th>
                        <th>Jenis</th>
                        <th>Tgl Berangkat</th>
                        <th>Tgl Pulang</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($forms as $form)
                        <tr>
                            <td><strong>{{ $form->nomor_surat }}</strong></td>
                            <td>{{ $form->nama_kegiatan }}</td>
                            <td>
                                <span class="badge badge-{{ $form->jenis_kegiatan }}">
                                    {{ $form->jenis_kegiatan === 'dalam_kota' ? 'Dalam Kota' : 'Luar Kota' }}
                                </span>
                            </td>
                            <td>{{ $form->tanggal_berangkat->format('d/m/Y') }}</td>
                            <td>{{ $form->tanggal_pulang->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge badge-{{ $form->status }}">
                                    {{ match($form->status) {
                                        'draft' => 'Draft',
                                        'submitted' => 'Submitted',
                                        'approved' => 'Approved',
                                        'rejected' => 'Rejected',
                                        default => $form->status,
                                    } }}
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('perjadian.show', $form) }}" class="btn btn-primary">Lihat</a>
                                    @if ($form->status === 'draft')
                                        <a href="{{ route('perjadian.edit', $form) }}" class="btn btn-secondary">Edit</a>
                                        <form action="{{ route('perjadian.destroy', $form) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            @if ($forms->onFirstPage())
                <span>&laquo; Sebelumnya</span>
            @else
                <a href="{{ $forms->previousPageUrl() }}">&laquo; Sebelumnya</a>
            @endif

            @foreach ($forms->getUrlRange(1, $forms->lastPage()) as $page => $url)
                @if ($page == $forms->currentPage())
                    <span class="active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach

            @if ($forms->hasMorePages())
                <a href="{{ $forms->nextPageUrl() }}">Selanjutnya &raquo;</a>
            @else
                <span>Selanjutnya &raquo;</span>
            @endif
        </div>
    @else
        <div style="text-align: center; padding: 3rem;">
            <p style="font-size: 1.1rem; color: #7f8c8d; margin-bottom: 2rem;">Belum ada rekapan perjalanan dinas</p>
            <a href="{{ route('perjadin.create') }}" class="btn-form-baru" style="display: inline-flex; width: auto;">📝 Buat Form Baru</a>
        </div>
    @endif
</div>

<style>
    @media (max-width: 768px) {
        .card {
            padding: 1.5rem;
        }
    }
</style>
@endsection
