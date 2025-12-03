<?php

namespace App\Filament\Resources\PerjadinForms\Pages;

use App\Filament\Resources\PerjadinForms\PerjadinFormResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPerjadinForms extends ListRecords
{
    protected static string $resource = PerjadinFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
