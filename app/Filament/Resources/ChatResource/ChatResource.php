<?php

namespace App\Filament\Resources\ChatResource;

use App\Models\Chat;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;

class ChatResource extends Resource
{
    protected static ?string $model = Chat::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationGroup = 'Social';

    protected static ?string $navigationLabel = 'Chats';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Select::make('user_one_id')
                    ->label('User One')
                    ->options(function () {
                        return User::all()->pluck('username', 'id');
                    })
                    ->required(),

                Select::make('user_two_id')
                    ->label('User Two')
                    ->options(function () {
                        return User::all()->pluck('username', 'id');
                    })
                    ->required(),

                TextInput::make('last_message')
                    ->label('Last Message')
                    ->maxLength(255)
                    ->required(),

                DateTimePicker::make('last_message_at')
                    ->label('Last Message At')
                    ->required(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChats::route('/'),
            'create' => Pages\CreateChat::route('/create'),
            'edit' => Pages\EditChat::route('/{record}/edit'),
        ];
    }
}
