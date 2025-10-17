<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Hash;


class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
    protected function getFormSchema(): array
    {
        return [
            TextInput::make('name')->required(),
            TextInput::make('email')->email()->required(),
            TextInput::make('password')
            ->password()
            ->required()
            ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null),
        ];
    }
}
