<?php
/**
 * Created by PhpStorm.
 * User: meej
 * Date: 6/2/2016
 * Time: 11:06 AM
 */

namespace LinearSoft\EntrustCli\Commands;


use Illuminate\Console\Command;
use LinearSoft\EntrustCli\Models\Permission;
use LinearSoft\EntrustCli\Models\Role;

class RolesCommand extends Command
{
    protected function loadRole($name, $failOnSuccess=false)
    {
        $role = Role::query()->where(Role::PROPERTY_NAME,$name)->first();
        if($role == null && !$failOnSuccess) {
            $this->error("The Entrust role '$name' does not exist.");
        } elseif ($failOnSuccess) {
            $this->error("The Entrust role '$name' already exists.");
        }
        return $role;
    }
    
    protected function loadPerm($name, $failOnSuccess=false)
    {
        $perm = Permission::query()->where(Permission::PROPERTY_NAME,$name)->first();
        if($perm == null && !$failOnSuccess) {
            $this->error("The Entrust permission '$name' does not exist.");
        } elseif ($failOnSuccess) {
            $this->error("The Entrust permission '$name' already exists.");
        }
        return $perm;
    }

}