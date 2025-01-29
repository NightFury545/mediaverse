<?php

namespace App\Filament\Resources\Post;

use App\Enums\PostVisibility;
use App\Facades\Files\FileFacade;
use App\Models\Post;
use Filament\Forms;
use Filament\Resources\Resource;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('content')
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'username')
                    ->required(),
                Forms\Components\Repeater::make('attachments')
                    ->schema([
                        Forms\Components\FileUpload::make('file')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'video/mp4'])
                            ->maxSize(51200)
                            ->directory(function ($state) {
                                // Визначаємо директорію залежно від видимості
                                $visibility = $state['visibility'] ?? PostVisibility::PUBLIC->value;
                                $folder = PostVisibility::from($visibility) === PostVisibility::PUBLIC
                                    ? 'public'
                                    : 'private';

                                // Перевіряємо, чи є файли в state
                                if (!empty($state['file'])) {
                                    $file = $state['file']; // Беремо перший файл (Livewire передає файли як об'єкти)
                                    $extension = $file->getClientOriginalExtension(); // Визначаємо розширення файлу

                                    // Додаємо підкатегорії для зображень та відео
                                    $subfolder = in_array($extension, ['jpg', 'jpeg', 'png', 'gif']) ? 'images' : 'videos';
                                    return $folder . '/' . $subfolder; // Публічні або приватні директорії
                                }

                                return $folder; // Якщо файлів немає, повертаємо тільки основну директорію
                            })
                            ->disk(function ($state) {
                                // Визначаємо диск в залежності від видимості
                                $visibility = $state['visibility'] ?? PostVisibility::PUBLIC->value;
                                return PostVisibility::from($visibility) === PostVisibility::PUBLIC
                                    ? 'public' // Публічне сховище
                                    : 'private'; // Приватне сховище
                            })
                            ->afterStateUpdated(function ($state, $set, $get) {
                                // Перевіряємо, чи є файли в state
                                if (!empty($state)) { // Якщо state не порожнє
                                    $filePaths = [];
                                    $visibility = $get('visibility') ?? PostVisibility::PUBLIC->value;

                                    foreach ($state as $file) {
                                        // Визначаємо розширення файлу
                                        $extension = $file->getClientOriginalExtension();

                                        // Динамічне визначення директорії на основі розширення
                                        $folder = in_array($extension, ['jpg', 'jpeg', 'png', 'gif']) ? 'images' : 'videos';

                                        if ($visibility === PostVisibility::PUBLIC->value) {
                                            $filePaths[] = FileFacade::savePublicFile($file, $folder);
                                        } else {
                                            $filePaths[] = FileFacade::savePrivateFile($file, $folder);
                                        }
                                    }

                                    $set('attachments', $filePaths); // Оновлюємо стан з шляхами до файлів
                                }
                            })
                    ])
                    ->columnSpan('full'),
                Forms\Components\Toggle::make('comments_enabled')
                    ->label('Comments Enabled')
                    ->default(true),
                Forms\Components\Select::make('visibility')
                    ->options(PostVisibility::getValues())
                    ->default(PostVisibility::PUBLIC->value),
            ]);
    }


    public static function getRelations(): array
    {
        return [
            RelationManagers\CommentsRelationManager::class,
            RelationManagers\LikesRelationManager::class,
            RelationManagers\ReportsRelationManager::class,
            RelationManagers\TagsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
