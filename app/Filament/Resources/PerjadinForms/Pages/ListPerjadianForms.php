<?php

namespace App\Filament\Resources\PerjadinForms\Pages;

use App\Filament\Resources\PerjadinForms\PerjadianFormResource;
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
