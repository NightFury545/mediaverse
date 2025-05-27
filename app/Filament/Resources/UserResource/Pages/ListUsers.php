<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Enums\Gender;
use App\Enums\Role;
use App\Filament\Resources\UserResource\UserResource;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('username')
                    ->label('Username')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('gender')
                    ->label('Gender')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('birthday')
                    ->label('Birthday')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('role')
                    ->label('Role')
                    ->sortable()
                    ->searchable(),

                ImageColumn::make('avatar')
                    ->label('Avatar'),

                TextColumn::make('created_at')
                    ->label('Created at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->options(
                        array_combine(Role::getValues(), Role::getValues())
                    ),
                SelectFilter::make('gender')
                    ->options(
                        array_combine(Gender::getValues(), Gender::getValues())
                    ),
                Filter::make('birthday')
                    ->form([
                        DatePicker::make('from')
                            ->label('Народжені після')
                            ->nullable(),
                        DatePicker::make('to')
                            ->label('Народжені до')
                            ->nullable(),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'], fn ($query) => $query->where('birthday', '>=', $data['from']))
                            ->when($data['to'], fn ($query) => $query->where('birthday', '<=', $data['to']));
                    }),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}

