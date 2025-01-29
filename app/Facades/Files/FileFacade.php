<?php
namespace App\Facades\Files;

use Illuminate\Support\Facades\Facade;

class FileFacade extends Facade
{
    /**
     * Отримує назву сервісу в контейнері, з яким буде працювати фасад.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'fileService';
    }
}

