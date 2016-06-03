# Entrust-Cli
Provides a console interface to Entrust for Laravel

Currently this package only supports Entrust for Laravel 5.

### Requirements

You must have Entrust installed and working before attempting to use Entrust-Cli.

Before using Entrust-Cli you must have the Entrust service provider and alias configured.
```php
'providers' => [
    ...
    Zizaco\Entrust\EntrustServiceProvider::class,
    ...
],
'aliases' => [
    ...
     'Entrust'   => Zizaco\Entrust\EntrustFacade::class,
    ...
],
```
You must also have the Entrust database tables created.
```bash
php artisan entrust:migration
php artisan migrate
```

Visit the [Entrust GitHub](https://github.com/Zizaco/entrust) for more information on installing and configuring Entrust.

## Installation
Install the latest version with

```
$ composer require linearsoft/entrust-cli
```

Then in your `config/app.php` you must add 
```php
    LinearSoft\EntrustCli\EntrustCliServiceProvider::class,
```
to your `providers` array.

## Usage
Entrust-Cli adds the following artisan commands
```bash
php artisan list
 ...
 entrust-cli
  entrust-cli:permission:attach  Add a permission to an Entrust role
  entrust-cli:permission:create  Create an Entrust permission
  entrust-cli:permission:delete  Delete an Entrust permission
  entrust-cli:permission:detach  Remove a permission from an Entrust role
  entrust-cli:permission:list    List all Entrust permissions
  entrust-cli:role:attach        Add an Entrust role to a user
  entrust-cli:role:create        Create an Entrust role
  entrust-cli:role:delete        Delete an Entrust role
  entrust-cli:role:detach        Remove an Entrust role from a user
  entrust-cli:role:info          Show details for an Entrust role
  entrust-cli:role:list          List all Entrust role
  
 ...
```

| Command             | Action                                    | Parameters                        | Example                                          |
|:--------------------|:------------------------------------------|:----------------------------------|:-------------------------------------------------|
| `*:create`          | Creates a role/permission                 | name [display name] [description] | `entrust-cli:role:create myrole "My Role"`       |
| `*:delete`          | Deletes a role/permission                 | name                              | `entrust-cli:permission:delete perm1`            |
| `*:list`            | Lists all roles/permissions               | _none_                            | `entrust-cli:role:list`                          |
| `permission:attach` | Attaches a permission to a role           | permission_name role_name         | `entrust-cli:permission:attach perm1 myrole`     |
| `permission:detach` | Detaches a permission from a role         | permission_name role_name         | `entrust-cli:permission:detach perm1 myrole`     |
| `role:info`         | Provides detailed role info (perms/users) | role_name                         | `entrust-cli:role:info myrole`                   |
| `role:attach`       | Attaches a role to a user                 | role_name identity [--attr=]      | `entrust-cli:role:attach myrole user2@gmail.com` |
| `role:detach`       | Detaches a role from a user               | role_name identity [--attr=]      | `entrust-cli:role:detach myrole user2`           |

#### User Identity

Entrust-Cli does not know for certain what attribute your application uses to lookup user records.  By default it will check for an `email` attribute 
and then fail-over to a `username`.  If your User model does not use either one of these you must manually specify which attribute to search on:
```
entrust-cli:role:attach myrole "John Doe" --attr=name
entrust-cli:role:attach myrole 8846811346 --attr=barcode
```

## About
### Bugs or features requests
Found a problem or would like a feature submit it via [GitHub](https://github.com/LinearSoft/entrust-cli/issues)
### License
Entrust-Cli is licensed under the GPLv3 License - see the `LICENSE` file for details
