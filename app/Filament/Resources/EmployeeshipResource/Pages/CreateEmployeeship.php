<?php

namespace App\Filament\Resources\EmployeeshipResource\Pages;

use App\Filament\Resources\EmployeeshipResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEmployeeship extends CreateRecord
{
    protected static string $resource = EmployeeshipResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Automatically set the company_id to the current user's company
        $data['company_id'] = auth()->user()->current_company_id;

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
