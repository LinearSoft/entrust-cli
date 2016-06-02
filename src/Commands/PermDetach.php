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

class PermDetach extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entrust-cli:permission:detach
                            {perm_name : Name of permission to detach}
                            {role_name : Name of role to detach permission from}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove a permission from an Entrust role';

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
        $perm_name = $this->argument('perm_name');
        $role_name = $this->argument('role_name');
        /** @var Permission $perm */
        $perm = $this->loadPerm($perm_name);
        if($perm == null) return;
        /** @var Role $role */
        $role = $this->loadRole($role_name);
        if($role == null) return;

        if(!$role->hasPermission($perm_name)) {
            $this->error("The permission '$perm_name' is not attached to the '$role_name' role.");
            return;
        }
        
        $role->detachPermission($perm);
        $this->info("Successfully detached the '$perm_name' permission from the '$role_name' role.");
    }

}