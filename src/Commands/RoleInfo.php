<?php
/**
 * Created by PhpStorm.
 * User: meej
 * Date: 6/1/2016
 * Time: 8:00 PM
 */

namespace LinearSoft\EntrustCli\Commands;

use LinearSoft\EntrustCli\Models\Permission;
use LinearSoft\EntrustCli\Models\Role;
use LinearSoft\EntrustCli\Models\User;

class RoleInfo extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entrust-cli:role:info {name}';

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
        
        $this->table(['Name','Display Name','Description','Id'],[[
            $role->{Role::PROPERTY_NAME},$role->{Role::PROPERTY_DISPLAY},$role->{Role::PROPERTY_DESC},$role->{Role::PROPERTY_KEY},
        ]]);
        
        $perms = $role->perms()->get(Permission::PROPERTY_NAME)->toArray();
        if(empty($perms)) $list = '<none>';
        else $list = $this->toArrayImplode(', ',Permission::PROPERTY_NAME,$perms);
        $this->info('Permissions: '.$list);
        
        $identField = User::calcUserIdentityField();
        $users = $role->users()->get([$identField])->toArray();
        if(empty($users)) $list = '<none>';
        else $list = $this->toArrayImplode(', ',$identField,$users);
        $this->info('Members: '.$list);
    }

}