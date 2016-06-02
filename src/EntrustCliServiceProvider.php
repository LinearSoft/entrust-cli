<?php
/**
 * Created by PhpStorm.
 * User: meej
 * Date: 6/2/2016
 * Time: 10:42 AM
 */

namespace LinearSoft\EntrustCli;


use Illuminate\Support\ServiceProvider;

class EntrustCliServiceProvider extends ServiceProvider
{
    /**
     * Boot and configure the application paths
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerRoleCommands();
    }

    protected function registerRoleCommands()
    {
        $this->app->singleton('command.entrust-cli.role.create', function() {
            return new Commands\RolesCreateCommand();
        });
        $this->app->singleton('command.entrust-cli.role.delete', function() {
            return new Commands\RolesDeleteCommand();
        });
        $this->app->singleton('command.entrust-cli.role.list', function() {
            return new Commands\RolesListCommand();
        });
        $this->app->singleton('command.entrust-cli.role.info', function() {
            return new Commands\RolesInfoCommand();
        });
        $this->app->singleton('command.entrust-cli.role.perm-add', function() {
            return new Commands\RolesAddPermissionCommand();
        });
        $this->commands([
            'command.entrust-cli.role.create',
            'command.entrust-cli.role.delete',
            'command.entrust-cli.role.list',
            'command.entrust-cli.role.info',
            'command.entrust-cli.role.perm-add',
        ]);
    }

    
}