<?php

namespace App\Filament\Resources\ActorResource\Pages;

use App\Filament\Resources\ActorResource\ActorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;

class ListActors extends ListRecords
{
    protected static string $resource = ActorResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Actor Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('movies')
                    ->label('Movies Count')
                    ->counts('movies')
                    ->sortable(),
            ]);
    }
    protected function getTableActions(): array
    {
        return [
            EditAction::make(),
            DeleteAction::make(),
        ];
    }
}

