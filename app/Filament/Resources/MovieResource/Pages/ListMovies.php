<?php

namespace App\Filament\Resources\MovieResource\Pages;

use App\Filament\Resources\MovieResource\MovieResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Table;

class ListMovies extends ListRecords
{
    protected static string $resource = MovieResource::class;

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
                TextColumn::make('title')
                    ->label('Title')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('release_date')
                    ->label('Release Date')
                    ->sortable()
                    ->dateTime(),

                ImageColumn::make('poster_path')
                    ->label('Poster'),

                ImageColumn::make('backdrop_path')
                    ->label('Backdrop'),

                ImageColumn::make('video_path')
                    ->label('Video'),

                TextColumn::make('api_rating')
                    ->label('API Rating'),

                TextColumn::make('user_rating')
                    ->label('User Rating'),
            ])
            ->filters([])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
