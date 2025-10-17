<?php

namespace App\Filament\Resources\HardwareResource\Pages;

use App\Filament\Resources\HardwareResource;
use Filament\Resources\Pages\CreateRecord;

class CreateHardware extends CreateRecord
{
    protected static string $resource = HardwareResource::class;

    protected function getCreateFormAction(): \Filament\Pages\Actions\Action
    {
        return \Filament\Pages\Actions\Action::make('create')
            ->label(__('filament::resources/pages/create-record.form.actions.create.label'))
            ->submit('create')
            ->keyBindings(['mod+s']);
    }

    protected function getCreateAnotherFormAction(): \Filament\Pages\Actions\Action
    {
        return \Filament\Pages\Actions\Action::make('createAnother')
            ->label(__('filament::resources/pages/create-record.form.actions.create_another.label'))
            ->action('createAnother')
            ->keyBindings(['mod+shift+s'])
            ->color('secondary');
    }

    protected function getFormActions(): array
    {
        return array_merge(
            [$this->getCreateFormAction()],
            static::canCreateAnother() ? [$this->getCreateAnotherFormAction()] : [],
        );
    }
}

