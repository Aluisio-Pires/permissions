# Filament Permission

Requirements:

- https://github.com/filamentphp/filament
- https://github.com/spatie/laravel-permission

Features:

- Access control list (ACL) tool / menu
- Roles and Permissions Filament pages

## Installation

- Make sure you have your Laravel Filament installed:

- Add the package with composer:
```shell
composer require pdmfc/filament-permission
```

## Configuration

- Create Files

```
php artisan filament-permission:create-files
```

- Run migrations

```
php artisan migrate
```

- Now you can add the `hasRoles` trait to your `User` model to enable the authorization

```
...
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasRoles, Notifiable;
...
```

- If your `User` model has the `SoftDeletes` trait, you can remove the commented code from `UsersRelationManager` class to enable the trashed filter.

```
...
->filters([
    Tables\Filters\TrashedFilter::make(),
])
```
## Usage

Add the `admin` role to your user and access your filament admin panel to see the new `Administration` navigation group.

Example:

```php
User::factory()->create([
    'name' => 'Test User',
    'email' => 'test@example.com',
])->assignRole('admin');
```

## More information
 It's recommended to read the Spatie/Laravel-Permission documentation at:
 https://spatie.be/docs/laravel-permission/v6/introduction

