<?php

namespace App\Filament\Resources\UserResource;

use App\Enums\Gender;
use App\Enums\Role;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Social';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('username')
                    ->required()
                    ->maxLength(255),

                TextInput::make('first_name')
                    ->maxLength(255),

                TextInput::make('last_name')
                    ->maxLength(255),

                TextInput::make('email')
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->required(),

                TextInput::make('password')
                    ->password()
                    ->required(fn($context) => $context === 'create')
                    ->dehydrateStateUsing(fn($state) => Hash::make($state)),

                Select::make('role')
                    ->options(
                        array_combine(Role::getValues(), Role::getValues())
                    )
                    ->required()
                    ->default(Role::USER->value),

                FileUpload::make('avatar')
                    ->image()
                    ->disk('public')
                    ->directory('avatars')
                    ->visibility('public'),

                TextInput::make('phone_number')
                    ->tel()
                    ->maxLength(20),

                Select::make('gender')
                    ->options(
                        array_combine(Gender::getValues(), Gender::getValues())
                    )
                    ->required()
                    ->default(Gender::MALE->value),

                TextInput::make('address')
                    ->maxLength(255),

                TextInput::make('biography')
                    ->maxLength(500)
                    ->columnSpanFull(),

                TextInput::make('birthday')
                    ->type('date'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
