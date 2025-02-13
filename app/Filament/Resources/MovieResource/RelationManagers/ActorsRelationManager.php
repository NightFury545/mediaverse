<?php

namespace App\Filament\Resources\MovieResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;

class ActorsRelationManager extends RelationManager
{
    protected static string $relationship = 'actors';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Actor Name'),
            ])
            ->headerActions([
                AttachAction::make()
                    ->preloadRecordSelect()
                    ->form([
                        TextInput::make('name')->required()->label('Actor Name'),
                    ])
                    ->label('Create New Actor'),
            ])
            ->actions([
                EditAction::make(),
                DetachAction::make(),
            ]);
    }
}

