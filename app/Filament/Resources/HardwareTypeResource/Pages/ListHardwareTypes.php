<?php

namespace App\Filament\Resources\HardwareTypeResource\Pages;

use App\Filament\Resources\HardwareTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHardwareTypes extends ListRecords
{
    protected static string $resource = HardwareTypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
