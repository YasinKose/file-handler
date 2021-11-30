<?php

namespace YasinKose\FileHandler;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const CONFIG_PATH = __DIR__ . '/../config/file-handler.php';

    public function boot()
    {
        $this->publishes([
            self::CONFIG_PATH => app()->basePath() . '/config/file-handler.php',
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            self::CONFIG_PATH,
            'file-handler'
        );

        $this->app->bind('file-handler', function () {
            return new FileHandler();
        });
    }
}
