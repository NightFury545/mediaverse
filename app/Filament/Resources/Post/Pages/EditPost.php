<?php

namespace App\Filament\Resources\Post\Pages;

use App\Filament\Resources\Post\PostResource;
use Filament\Resources\Pages\EditRecord;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;
}

