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

class PermAttach extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entrust-cli:permission:attach
                            {perm_name : Name of permission to attach}
                            {role_name : Name of role to attach permission to}';

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
        $perm_name = $this->argument('perm_name');
        $role_name = $this->argument('role_name');
        /** @var Permission $perm */
        $perm = $this->loadPerm($perm_name);
        if($perm == null) return;
        /** @var Role $role */
        $role = $this->loadRole($role_name);
        if($role == null) return;

        $role->attachPermission($perm);
        $this->info("Successfully attached the '$perm_name' permission to the '$role_name' role.");
    }

}