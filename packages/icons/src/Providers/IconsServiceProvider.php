<?php

namespace Akrbdk\Icons\Providers;

use Illuminate\Support\ServiceProvider;

class IconsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'akrbdk-icons');
    }

    public function boot()
    {

    }
}
