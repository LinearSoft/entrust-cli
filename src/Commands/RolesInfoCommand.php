<?php
/**
 * Created by PhpStorm.
 * User: meej
 * Date: 6/1/2016
 * Time: 8:00 PM
 */

namespace LinearSoft\EntrustCli\Commands;

use LinearSoft\EntrustCli\Models\Role;

class RolesInfoCommand extends RolesCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entrust-cli:roles:info {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show details for an Entrust role';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        /** @var Role $role */
        $role = $this->loadRole($name);
        if($role == null) return;
        $this->info('Role Info:');
        $this->table(['Name','Display Name','Description','Id'],[[
            $role->{Role::PROPERTY_NAME},$role->{Role::PROPERTY_DISPLAY},$role->{Role::PROPERTY_DESC},$role->{Role::PROPERTY_KEY},
        ]]);
        $this->info('Role Users:');
        $users = $role->users()->get()->toArray();
        $users = implode(', ',$users);
        $this->info($users);
    }

}