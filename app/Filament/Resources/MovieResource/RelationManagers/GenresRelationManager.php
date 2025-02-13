<?php

namespace App\Filament\Resources\MovieResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Components\TextInput;

class GenresRelationManager extends RelationManager
{
    protected static string $relationship = 'genres';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Genre Name'),
            ])
            ->headerActions([
                AttachAction::make()
                    ->preloadRecordSelect()
                    ->form([
                        TextInput::make('name')->required()->label('Genre Name'),
                    ])
                    ->label('Create New Genre'),
            ])
            ->actions([
                EditAction::make(),
                DetachAction::make(),
            ]);
    }
}

