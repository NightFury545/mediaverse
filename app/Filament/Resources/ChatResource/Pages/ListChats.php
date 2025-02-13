<?php

namespace App\Filament\Resources\ChatResource\Pages;

use App\Filament\Resources\ChatResource\ChatResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ListChats extends ListRecords
{
    protected static string $resource = ChatResource::class;

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
                TextColumn::make('userOne.username')
                    ->label('User One')
                    ->sortable(),
                TextColumn::make('userTwo.username')
                    ->label('User Two')
                    ->sortable(),
                TextColumn::make('last_message')
                    ->label('Last Message'),
                TextColumn::make('last_message_at')
                    ->label('Last Message At')
                    ->dateTime(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}

