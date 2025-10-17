<?php

namespace App\Filament\Resources\HardwareTypeResource\Pages;

use App\Filament\Resources\HardwareTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHardwareType extends EditRecord
{
    protected static string $resource = HardwareTypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
