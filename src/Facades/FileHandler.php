<?php

namespace YasinKose\FileHandler\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \YasinKose\FileHandler\FileHandler sendFile(?array $files = [])
 * @method static \YasinKose\FileHandler\FileHandler addFile($files)
 */
class FileHandler extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'file-handler';
    }
}
