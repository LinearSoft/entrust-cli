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
use LinearSoft\EntrustCli\Models\User;

class BaseCommand extends Command
{
    /**
     * Loads Role based upon name
     * 
     * @param $name
     * @param bool $failOnSuccess
     * @return null|Role
     */
    protected function loadRole($name, $failOnSuccess=false)
    {
        $role = Role::query()->where(Role::PROPERTY_NAME,$name)->first();
        if($role == null) {
            if($failOnSuccess) return null;
            $this->error("The Entrust role '$name' does not exist.");
        } elseif ($failOnSuccess) {
            $this->error("The Entrust role '$name' already exists.");
        }
        return $role;
    }

    /**
     * Loads Permission based upon name
     *
     * @param $name
     * @param bool $failOnSuccess
     * @return null|Permission
     */
    protected function loadPerm($name, $failOnSuccess=false)
    {
        $perm = Permission::query()->where(Permission::PROPERTY_NAME,$name)->first();
        if($perm == null) {
            if($failOnSuccess) return null;
            $this->error("The Entrust permission '$name' does not exist.");
        } elseif ($failOnSuccess) {
            $this->error("The Entrust permission '$name' already exists.");
        }
        return $perm;
    }

    protected function loadUser($identity, $identField = false, $failOnSuccess=false)
    {
        $model = User::getAppModel();
        $user = null;
        if($identField === false) {
            $user = $model->query()->where(User::PROPERTY_EMAIL,$identity)->first();
            if($user == null) $user = $model->query()->where(User::PROPERTY_USERNAME,$identity)->first();
        } else  {
            $user = $model->query()->where($identField,$identity)->first();
        }
        if($user == null) {
            if($failOnSuccess) return null;
            $this->error("The user '$identity' does not exist.");
        } elseif ($failOnSuccess) {
            $this->error("The user '$identity' already exists.");
        }
        return $user;
    }
    
    
    protected function toArrayImplode($glue,$key,$array)
    {
        if(!is_array($array) || empty($array)) return '';
        $out = '';
        $first = true;
        foreach($array as $data) {
            if(!$first) $out .= $glue;
            else $first = false;
            $out .= $data[$key];
        }
        return $out;
    }
}