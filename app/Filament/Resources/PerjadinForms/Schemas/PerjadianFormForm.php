<?php

namespace App\Filament\Resources\PerjadinForms\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PerjadianFormForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Pengguna')
                    ->columns(2)
                    ->schema([
                        TextInput::make('nama')
                            ->label('Nama')
                            ->required()
                            ->disabled(),
                        TextInput::make('nip')
                            ->label('NIP')
                            ->required()
                            ->disabled(),
                    ]),

                Section::make('Informasi Surat')
                    ->columns(2)
                    ->schema([
                        TextInput::make('nomor_surat')
                            ->label('Nomor Surat')
                            ->required(),
                        DatePicker::make('tanggal_surat')
                            ->label('Tanggal Surat')
                            ->required(),
                    ]),

                Section::make('Tanggal Perjalanan')
                    ->columns(2)
                    ->schema([
                        DatePicker::make('tanggal_berangkat')
                            ->label('Tanggal Berangkat')
                            ->required(),
                        DatePicker::make('tanggal_pulang')
                            ->label('Tanggal Pulang')
                            ->required(),
                    ]),

                Section::make('Informasi Kegiatan')
                    ->columns(2)
                    ->schema([
                        TextInput::make('nama_kegiatan')
                            ->label('Nama Kegiatan')
                            ->required(),
                        Select::make('jenis_kegiatan')
                            ->label('Jenis Kegiatan')
                            ->options([
                                'dalam_kota' => 'Dalam Kota',
                                'luar_kota' => 'Luar Kota',
                            ])
                            ->required(),
                    ]),

                Section::make('Lokasi Kegiatan')
                    ->columns(2)
                    ->schema([
                        TextInput::make('nama_instansi')
                            ->label('Nama Instansi')
                            ->required(),
                        Textarea::make('alamat_kegiatan')
                            ->label('Alamat Kegiatan')
                            ->required()
                            ->rows(3),
                    ]),

                Section::make('Dokumen')
                    ->schema([
                        FileUpload::make('surat_kegiatan')
                            ->label('Upload Surat Kegiatan')
                            ->directory('perjadian-forms')
                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                            ->maxSize(5120),
                    ]),

                Section::make('Status & Catatan')
                    ->columns(2)
                    ->schema([
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'draft' => 'Draft',
                                'submitted' => 'Submitted',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                            ])
                            ->required(),
                        Textarea::make('catatan_admin')
                            ->label('Catatan Admin')
                            ->rows(3),
                    ]),
            ]);
    }
}
