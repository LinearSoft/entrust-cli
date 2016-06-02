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

class RolesAddPermissionCommand extends RolesCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entrust-cli:roles:perm-add {role_name} {perm_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a permission to an Entrust role';

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
        $role_name = $this->argument('role_name');
        $perm_name = $this->argument('perm_name');
        /** @var Role $role */
        $role = $this->loadRole($role_name);
        if($role == null) return;
        /** @var Permission $perm */
        $perm = $this->loadPerm($perm_name);
        if($perm == null) return;
        $role->attachPermission($perm);
        $this->info("Successfully added the '$perm_name' permission to the '$role_name' role.");
    }

}