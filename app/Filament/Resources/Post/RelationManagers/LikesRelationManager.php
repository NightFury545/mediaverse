<?php

namespace App\Filament\Resources\Post\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;

class LikesRelationManager extends RelationManager
{
    protected static string $relationship = 'likes';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.username')->label('Liked By'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Liked At'),
            ]);
    }
}

