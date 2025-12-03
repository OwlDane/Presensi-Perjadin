<?php

namespace App\Filament\Resources\PerjadianForms\Pages;

use App\Filament\Resources\PerjadianForms\PerjadianFormResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPerjadianForms extends ListRecords
{
    protected static string $resource = PerjadianFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
