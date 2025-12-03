<?php

namespace App\Filament\Resources\PerjadinForms;

use App\Filament\Resources\PerjadinForms\Pages\CreatePerjadianForm;
use App\Filament\Resources\PerjadinForms\Pages\EditPerjadianForm;
use App\Filament\Resources\PerjadinForms\Pages\ListPerjadianForms;
use App\Filament\Resources\PerjadinForms\Schemas\PerjadianFormForm;
use App\Filament\Resources\PerjadinForms\Tables\PerjadianFormsTable;
use App\Models\PerjadianForm;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PerjadianFormResource extends Resource
{
    protected static ?string $model = PerjadianForm::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PerjadianFormForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PerjadianFormsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPerjadianForms::route('/'),
            'create' => CreatePerjadianForm::route('/create'),
            'edit' => EditPerjadianForm::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->role === 'admin';
    }
}
