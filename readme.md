# Laravel permissions

```
composer require spatie/laravel-permission
```


config/app.php:
```
'providers' => [
    // ...
    Spatie\Permission\PermissionServiceProvider::class,
];
```

```
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="migrations"
php artisan migrate
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="config"

```
если проект свежий:
php artisan make:auth
В моделе юзеров: app\User.php:
дописываем
```
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;
```


# USAGE

Роли и Разрешения  - это обычные Eloquent-модели!
1 Роль может иметь несколько Разрешений!
Пишем в php artisan tinker:

```
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

//создаем роль:
$role = Role::create(['name' => 'writer']);
//создаем пермишенс:
$permission = Permission::create(['name' => 'edit articles']);
$permission2 = Permission::create(['name' => 'editor']);
```

## присобачить Разрешение конкретной Роле можно одним из методов:
```
$role->givePermissionTo($permission);
//либо:
$permission->assignRole($role);

## "отозвать" Права у Роли - одним из методов:
$role->revokePermissionTo($permission);
//либо:
$permission->removeRole($role);
```

## Присобачить к Пермишнсы к юзеру:

если залогинен:
```
Role::create(['name'=>'writte']);
Permission::create(['name'=>'edit post']);

auth()->user()->givePermissionTo('edit post);
```



либо через tinker:
```
factory(User::class, 33)->create(); //создадим пользователей
$user = User::first();
$user->givePermissionTo('write post');
```

добавится запись в model_has_permissions