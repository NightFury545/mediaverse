<?php

namespace App\Filament\Resources\GenreResource;

use App\Models\Genre;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;

class GenreResource extends Resource
{
    protected static ?string $model = Genre::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationGroup = 'Movies';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Genre Name')
                    ->required()
                    ->maxLength(255),
            ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGenres::route('/'),
            'create' => Pages\CreateGenre::route('/create'),
            'edit' => Pages\EditGenre::route('/{record}/edit'),
        ];
    }
}

