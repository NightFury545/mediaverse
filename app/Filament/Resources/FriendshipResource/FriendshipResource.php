<?php

namespace App\Filament\Resources\FriendshipResource;

use App\Models\Friendship;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;

class FriendshipResource extends Resource
{
    protected static ?string $model = Friendship::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Social';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('User')
                    ->options(User::pluck('username', 'id'))
                    ->searchable()
                    ->required(),

                Select::make('friend_id')
                    ->label('Friend')
                    ->options(User::pluck('username', 'id'))
                    ->searchable()
                    ->required(),

                TextInput::make('status')
                    ->label('Status')
                    ->required(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFriendships::route('/'),
            'create' => Pages\CreateFriendship::route('/create'),
            'edit' => Pages\EditFriendship::route('/{record}/edit'),
        ];
    }
}

