<?php

namespace App\Filament\Resources\PerjadinForms;

use App\Filament\Resources\PerjadinForms\Pages\CreatePerjadinForm;
use App\Filament\Resources\PerjadinForms\Pages\EditPerjadinForm;
use App\Filament\Resources\PerjadinForms\Pages\ListPerjadinForms;
use App\Filament\Resources\PerjadinForms\Schemas\PerjadinFormForm;
use App\Filament\Resources\PerjadinForms\Tables\PerjadinFormsTable;
use App\Models\PerjadinForm;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PerjadinFormResource extends Resource
{
    protected static ?string $model = PerjadinForm::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PerjadinFormForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PerjadinFormsTable::configure($table);
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
            'index' => ListPerjadinForms::route('/'),
            'create' => CreatePerjadinForm::route('/create'),
            'edit' => EditPerjadinForm::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->role === 'admin';
    }
}
