<?php

namespace App\Filament\Exports;

use App\Models\PerjadianForm;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class PerjadianFormExporter extends Exporter
{
    protected static ?string $model = PerjadianForm::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('user.name')
                ->label('Nama Pengguna'),
            ExportColumn::make('user.nip')
                ->label('NIP'),
            ExportColumn::make('nomor_surat')
                ->label('Nomor Surat'),
            ExportColumn::make('tanggal_surat')
                ->label('Tanggal Surat'),
            ExportColumn::make('nama_kegiatan')
                ->label('Nama Kegiatan'),
            ExportColumn::make('jenis_kegiatan')
                ->label('Jenis Kegiatan')
                ->formatStateUsing(fn (string $state): string => match($state) {
                    'dalam_kota' => 'Dalam Kota',
                    'luar_kota' => 'Luar Kota',
                    default => $state,
                }),
            ExportColumn::make('tanggal_berangkat')
                ->label('Tanggal Berangkat'),
            ExportColumn::make('tanggal_pulang')
                ->label('Tanggal Pulang'),
            ExportColumn::make('nama_instansi')
                ->label('Nama Instansi'),
            ExportColumn::make('alamat_kegiatan')
                ->label('Alamat Kegiatan'),
            ExportColumn::make('status')
                ->label('Status')
                ->formatStateUsing(fn (string $state): string => match($state) {
                    'draft' => 'Draft',
                    'submitted' => 'Submitted',
                    'approved' => 'Approved',
                    'rejected' => 'Rejected',
                    default => $state,
                }),
            ExportColumn::make('catatan_admin')
                ->label('Catatan Admin'),
            ExportColumn::make('created_at')
                ->label('Dibuat Pada'),
            ExportColumn::make('updated_at')
                ->label('Diupdate Pada'),
        ];
    }

    public static function getFileName(Export $export): string
    {
        return "perjadian-forms-{$export->getKey()}.csv";
    }
}
