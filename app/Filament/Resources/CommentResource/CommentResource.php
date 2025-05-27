<?php

namespace App\Filament\Resources\CommentResource;

use App\Models\Comment;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationLabel = 'Comments';

    protected static ?string $navigationGroup = 'Social';

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-oval-left';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('user_id')
                    ->label('User ID')
                    ->required()
                    ->numeric(),

                Textarea::make('content')
                    ->label('Content')
                    ->required()
                    ->rows(4),

                TextInput::make('likes_count')
                    ->label('Likes Count')
                    ->required()
                    ->numeric(),

                TextInput::make('parent_id')
                    ->label('Parent Comment ID')
                    ->nullable()
                    ->numeric(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComments::route('/'),
            'create' => Pages\CreateComment::route('/create'),
            'edit' => Pages\EditComment::route('/{record}/edit')
        ];
    }
}

