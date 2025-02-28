<?php

namespace AluisioPires\Permission\Commands;

use AluisioPires\Permission\Contracts\Permission as PermissionContract;
use Illuminate\Console\Command;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;

class CreateFiles extends Command
{
    protected $signature = 'permissions:create-files';

    protected $description = 'Create files';

    /**
     * @throws BindingResolutionException
     */
    public function handle(): void
    {
        Artisan::call(
            'vendor:publish',
            [
                '--provider' => "Spatie\Permission\PermissionServiceProvider",
            ]
        );

        copy(
            __DIR__ . '/stubs/database/migrations/seed_permissions.php.stub', $this->getMigrationFileName('seed_permissions.php'),
        );

        copy(
            __DIR__ . '/stubs/app/Filament/Pages/PermissionRolePage.php.stub', app_path('Filament/Pages/PermissionRolePage.php'),
        );

        copy(
            __DIR__ . '/stubs/app/Filament/Resources/PermissionResource/Pages/CreatePermission.php.stub', app_path('Filament/Resources/PermissionResource/Pages/CreatePermission.php'),
        );

        copy(
            __DIR__ . '/stubs/app/Filament/Resources/PermissionResource/Pages/EditPermission.php.stub', app_path('Filament/Resources/PermissionResource/Pages/EditPermission.php'),
        );

        copy(
            __DIR__ . '/stubs/app/Filament/Resources/PermissionResource/Pages/ListPermissions.php.stub', app_path('Filament/Resources/PermissionResource/Pages/ListPermissions.php'),
        );

        copy(
            __DIR__ . '/stubs/app/Filament/Resources/PermissionResource/Pages/ViewPermission.php.stub', app_path('Filament/Resources/PermissionResource/Pages/ViewPermission.php'),
        );

        copy(
            __DIR__ . '/stubs/app/Filament/Resources/PermissionResource/RelationManagers/RolesRelationManager.php.stub', app_path('Filament/Resources/PermissionResource/RelationManagers/RolesRelationManager.php'),
        );

        copy(
            __DIR__ . '/stubs/app/Filament/Resources/RoleResource/Pages/CreateRole.php.stub', app_path('Filament/Resources/RoleResource/Pages/CreateRole.php'),
        );

        copy(
            __DIR__ . '/stubs/app/Filament/Resources/RoleResource/Pages/EditRole.php.stub', app_path('Filament/Resources/RoleResource/Pages/EditRole.php'),
        );

        copy(
            __DIR__ . '/stubs/app/Filament/Resources/RoleResource/Pages/ListRoles.php.stub', app_path('Filament/Resources/RoleResource/Pages/ListRoles.php'),
        );

        copy(
            __DIR__ . '/stubs/app/Filament/Resources/RoleResource/Pages/ViewRole.php.stub', app_path('Filament/Resources/RoleResource/Pages/ViewRole.php'),
        );

        copy(
            __DIR__ . '/stubs/app/Filament/Resources/RoleResource/RelationManagers/PermissionsRelationManager.php.stub', app_path('Filament/Resources/RoleResource/RelationManagers/PermissionsRelationManager.php'),
        );

        copy(
            __DIR__ . '/stubs/app/Filament/Resources/RoleResource/RelationManagers/UsersRelationManager.php.stub', app_path('Filament/Resources/RoleResource/RelationManagers/UsersRelationManager.php'),
        );

        copy(
            __DIR__ . '/stubs/app/Filament/Resources/RoleResource.php.stub', app_path('Filament/Resources/RoleResource.php'),
        );

        copy(
            __DIR__ . '/stubs/app/Models/Permission.php.stub', app_path('Models/Permission.php'),
        );

        copy(
            __DIR__ . '/stubs/app/Models/Role.php.stub', app_path('Models/Role.php'),
        );

        copy(
            __DIR__ . '/stubs/app/Policies/PermissionPolicy.php.stub', app_path('Policies/PermissionPolicy.php'),
        );

        copy(
            __DIR__ . '/stubs/app/Policies/RolePolicy.php.stub', app_path('Policies/RolePolicy.php'),
        );

        copy(
            __DIR__ . '/stubs/database/factories/PermissionFactory.php.stub', database_path('factories/PermissionFactory.php'),
        );

        copy(
            __DIR__ . '/stubs/database/factories/RoleFactory.php.stub', database_path('factories/RoleFactory.php'),
        );

        copy(
            __DIR__ . '/stubs/database/seeders/PermissionSeeder.php.stub', database_path('seeders/PermissionSeeder.php'),
        );

        copy(
            __DIR__ . '/stubs/resources/views/filament/pages/permission-role-page.blade.php.stub', resource_path('views/filament/pages/permission-role-page.blade.php'),
        );
    }


    /**
     * Returns existing migration file if found, else uses the current timestamp.
     * @throws BindingResolutionException
     */
    protected function getMigrationFileName(string $migrationFileName): string
    {
        $timestamp = date('Y_m_d_His');

        $filesystem = app()->make(Filesystem::class);

        return Collection::make([app()->databasePath().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR])
            ->flatMap(fn ($path) => $filesystem->glob($path.'*_'.$migrationFileName))
            ->push(app()->databasePath()."/migrations/{$timestamp}_{$migrationFileName}")
            ->first();
    }
}
