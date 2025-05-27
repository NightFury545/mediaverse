<?php

namespace App\Filament\Resources\MessageResource\Pages;

use App\Filament\Resources\MessageResource\MessageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ListMessages extends ListRecords
{
    protected static string $resource = MessageResource::class;

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
                TextColumn::make('content')
                    ->label('Message Content'),
                TextColumn::make('user.username')
                    ->label('User')
                    ->sortable(),
                BooleanColumn::make('is_read')
                    ->label('Is Read'),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->sortable()
                    ->dateTime(),
            ])
            ->filters([
                SelectFilter::make('is_read')
                    ->label('Is Read')
                    ->options([
                        'true' => 'Read',
                        'false' => 'Unread',
                    ])
                    ->query(function ($query, $value) {
                        if ($value === 'true') {
                            return $query->where('is_read', true);
                        }

                        return $query->where('is_read', false);
                    }),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}

