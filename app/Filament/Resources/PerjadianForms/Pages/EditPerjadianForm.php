<?php

namespace App\Filament\Resources\PerjadianForms\Pages;

use App\Filament\Resources\PerjadianForms\PerjadianFormResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPerjadianForm extends EditRecord
{
    protected static string $resource = PerjadianFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
