<?php

namespace AluisioPires\Permission;

use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    public function boot(): void
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
