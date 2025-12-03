<?php

namespace App\Filament\Resources\PerjadinForms\Pages;

use App\Filament\Resources\PerjadinForms\PerjadinFormResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPerjadinForm extends EditRecord
{
    protected static string $resource = PerjadinFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
