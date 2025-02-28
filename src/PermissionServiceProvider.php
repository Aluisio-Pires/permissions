<?php

namespace AluisioPires\Permission;

use Composer\InstalledVersions;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerCommands();
    }

    public function register()
    {
        //
    }

    protected function registerCommands(): void
    {
        $this->commands([
            Commands\CreateFiles::class,
        ]);
    }
}
