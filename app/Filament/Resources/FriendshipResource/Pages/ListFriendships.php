<?php

namespace App\Filament\Resources\FriendshipResource\Pages;

use App\Filament\Resources\FriendshipResource\FriendshipResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class ListFriendships extends ListRecords
{
    protected static string $resource = FriendshipResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.username')
                    ->label('User')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('friend.username')
                    ->label('Friend')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}

