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
        $this->registerPermCommands();
    }

    protected function registerRoleCommands()
    {
        $this->app->singleton('command.entrust-cli.role.create', function() {
            return new Commands\RoleCreate();
        });
        $this->app->singleton('command.entrust-cli.role.delete', function() {
            return new Commands\RoleDelete();
        });
        $this->app->singleton('command.entrust-cli.role.list', function() {
            return new Commands\RoleList();
        });
        $this->app->singleton('command.entrust-cli.role.info', function() {
            return new Commands\RoleInfo();
        });
        $this->app->singleton('command.entrust-cli.role.attach', function() {
            return new Commands\RoleAttach();
        });
        $this->app->singleton('command.entrust-cli.role.detach', function() {
            return new Commands\RoleDetach();
        });
        $this->commands([
            'command.entrust-cli.role.create',
            'command.entrust-cli.role.delete',
            'command.entrust-cli.role.list',
            'command.entrust-cli.role.info',
            'command.entrust-cli.role.attach',
            'command.entrust-cli.role.detach',
        ]);
    }

    protected function registerPermCommands()
    {
        $this->app->singleton('command.entrust-cli.permission.create', function() {
            return new Commands\PermCreate();
        });
        $this->app->singleton('command.entrust-cli.permission.delete', function() {
            return new Commands\PermDelete();
        });
        $this->app->singleton('command.entrust-cli.permission.list', function() {
            return new Commands\PermList();
        });
        $this->app->singleton('command.entrust-cli.permission.attach', function() {
            return new Commands\PermAttach();
        });
        $this->app->singleton('command.entrust-cli.permission.detach', function() {
            return new Commands\PermDetach();
        });
        $this->commands([
            'command.entrust-cli.permission.create',
            'command.entrust-cli.permission.delete',
            'command.entrust-cli.permission.list',
            'command.entrust-cli.permission.attach',
            'command.entrust-cli.permission.detach',
        ]); 
    }
    
}