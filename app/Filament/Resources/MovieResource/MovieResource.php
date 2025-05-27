<?php

namespace App\Filament\Resources\MovieResource;

use App\Filament\Resources\MovieResource\RelationManagers\ActorsRelationManager;
use App\Filament\Resources\MovieResource\RelationManagers\CategoriesRelationManager;
use App\Filament\Resources\MovieResource\RelationManagers\GenresRelationManager;
use App\Models\Director;
use App\Models\Movie;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;

class MovieResource extends Resource
{
    protected static ?string $model = Movie::class;

    protected static ?string $navigationIcon = 'heroicon-o-film';

    protected static ?string $navigationGroup = 'Movies';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->maxLength(255),

                Textarea::make('description')
                    ->label('Description')
                    ->nullable(),

                DatePicker::make('release_date')
                    ->label('Release Date')
                    ->nullable(),

                TextInput::make('runtime')
                    ->label('Runtime')
                    ->nullable(),

                FileUpload::make('poster_path')
                    ->label('Poster')
                    ->nullable()
                    ->disk('public')
                    ->visibility('public')
                    ->directory('images'),

                FileUpload::make('backdrop_path')
                    ->label('Backdrop')
                    ->nullable()
                    ->disk('public')
                    ->visibility('public')
                    ->directory('images'),

                FileUpload::make('video_path')
                    ->label('Video')
                    ->nullable()
                    ->disk('public')
                    ->visibility('public')
                    ->directory('videos'),

                TextInput::make('api_rating')
                    ->label('API Rating')
                    ->nullable(),

                TextInput::make('user_rating')
                    ->label('User Rating')
                    ->nullable(),

                Select::make('director_id')
                    ->label('Director')
                    ->options(Director::all()->pluck('name', 'id'))
                    ->required(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ActorsRelationManager::class,
            GenresRelationManager::class,
            CategoriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMovies::route('/'),
            'create' => Pages\CreateMovie::route('/create'),
            'edit' => Pages\EditMovie::route('/{record}/edit'),
        ];
    }
}
