<?php

namespace YasinKose\FileHandler\Tests;

use YasinKose\FileHandler\Facades\FileHandler;
use YasinKose\FileHandler\ServiceProvider;
use Orchestra\Testbench\TestCase;

class FileHandlerTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'file-handler' => FileHandler::class,
        ];
    }
}
