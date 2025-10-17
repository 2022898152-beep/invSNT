<?php

namespace App\Filament\Resources;

use App\Enums\HardwareStatus;
use App\Enums\HardwareType as EnumsHardwareType;
use App\Filament\Resources\HardwareResource\Pages;
use App\Models\Hardware;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\Column;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HardwareResource extends Resource
{
    protected static ?string $model = Hardware::class;

    protected static ?string $navigationGroup = 'bookmark';

    protected static ?string $navigationIcon = 'heroicon-o-chip';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('make')
                    ->label('Brand')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('model')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('serial')
                    ->label('Serial Number')
                    ->required()
                    ->maxLength(255),
                Select::make('status')
                    ->label('Status')
                    ->options(HardwareStatus::options()),
                Forms\Components\TextInput::make('os_name')
                    ->label('Opereanting System Name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('os_version')
                    ->label('Opereanting System Version')
                    ->maxLength(255),
                Forms\Components\TextInput::make('ram')
                    ->label('RAM')
                    ->maxLength(255),
                Forms\Components\TextInput::make('cpu')
                    ->label('CPU')
                    ->maxLength(255),
                Forms\Components\Select::make('type_id')
                    ->label('Type of Hardware')
                    ->relationship('hardwareType', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->unique(),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(),
                    ]),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name'),
                Forms\Components\Select::make('provaider_id')
                    ->relationship('provaider', 'name')
                    ->required(),
                Forms\Components\DateTimePicker::make('purchased_at')
                    ->required(),
                Forms\Components\Toggle::make('current')
                    ->default(true)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        Column::configureUsing(function (Column $column): void {
            $column
                ->toggleable()
                ->searchable()
                ->sortable();
        });

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Assigned User')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('make')
                    ->label('Brand')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('model')
                    ->label('Model')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),
                Tables\Columns\BadgeColumn::make('serial')
                    ->label('Serial #')
                    ->color('primary'),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn ($state) => HardwareStatus::getLabel($state))
                    ->color(fn ($state): string => match($state) {
                        HardwareStatus::ACTIVE, HardwareStatus::ONLINE, HardwareStatus::READY => 'success',
                        HardwareStatus::INACTIVE, HardwareStatus::OFFLINE, HardwareStatus::PENDING => 'warning',
                        HardwareStatus::FAULTY, HardwareStatus::ERROR, HardwareStatus::OUT_OF_SERVICE => 'danger',
                        HardwareStatus::UNDER_MAINTENANCE, HardwareStatus::UPGRADING, HardwareStatus::DECOMMISSIONED => 'secondary',
                        HardwareStatus::UNAVAILABLE => 'info',
                        default => 'gray',
                    }),
                Tables\Columns\BadgeColumn::make('hardwareType.name')
                    ->label('Type')
                    ->color('info')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('os_name')
                    ->label('Operating System')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('ram')
                    ->label('RAM')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('cpu')
                    ->label('CPU')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('provaider.name')
                    ->label('Provider')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('current')
                    ->label('Active')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger'),
                Tables\Columns\TextColumn::make('purchased_at')
                    ->label('Purchase Date')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Added')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\SelectFilter::make('status')
                    ->options(HardwareStatus::options())
                    ->label('Status'),
                Tables\Filters\SelectFilter::make('type_id')
                    ->relationship('hardwareType', 'name')
                    ->label('Type'),
                Tables\Filters\SelectFilter::make('user_id')
                    ->relationship('user', 'name')
                    ->label('User'),
                Tables\Filters\SelectFilter::make('provaider_id')
                    ->relationship('provaider', 'name')
                    ->label('Provaider'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
                \pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // ProvaiderResource::getRelations()
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHardware::route('/'),
            'create' => Pages\CreateHardware::route('/create'),
            'edit' => Pages\EditHardware::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
