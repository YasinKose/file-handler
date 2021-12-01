<?php

namespace YasinKose\FileHandler;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const CONFIG_PATH = __DIR__ . '/../config/file-handler.php';

    public function boot()
    {
        if ($this->app instanceof LaravelApplication) {
            $this->publishes([self::CONFIG_PATH => config_path('file-handler.php')], 'config');
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('file-handler');
        }

        $this->mergeConfigFrom(self::CONFIG_PATH, 'file-handler');
    }

    public function register()
    {
        $this->app->bind('file-handler', function () {
            return new FileHandler();
        });
    }
}
