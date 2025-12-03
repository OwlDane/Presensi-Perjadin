<?php

namespace App\Filament\Resources\PerjadianForms\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PerjadianFormsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama Pengguna')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.nip')
                    ->label('NIP')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nomor_surat')
                    ->label('Nomor Surat')
                    ->searchable(),
                TextColumn::make('nama_kegiatan')
                    ->label('Nama Kegiatan')
                    ->searchable(),
                TextColumn::make('jenis_kegiatan')
                    ->label('Jenis Kegiatan')
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'dalam_kota' => 'Dalam Kota',
                        'luar_kota' => 'Luar Kota',
                        default => $state,
                    }),
                TextColumn::make('tanggal_berangkat')
                    ->label('Tgl Berangkat')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('tanggal_pulang')
                    ->label('Tgl Pulang')
                    ->date('d/m/Y')
                    ->sortable(),
                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'gray' => 'draft',
                        'info' => 'submitted',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ])
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'draft' => 'Draft',
                        'submitted' => 'Submitted',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                        default => $state,
                    }),
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'submitted' => 'Submitted',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ]),
                SelectFilter::make('jenis_kegiatan')
                    ->options([
                        'dalam_kota' => 'Dalam Kota',
                        'luar_kota' => 'Luar Kota',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
