<?php
/**
 * Created by PhpStorm.
 * User: meej
 * Date: 6/1/2016
 * Time: 8:00 PM
 */

namespace LinearSoft\EntrustCli\Commands;

use LinearSoft\EntrustCli\Models\Role;
use LinearSoft\EntrustCli\Models\User;


class RoleAttach extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entrust-cli:role:attach
                            {role_name : Name of role to attach}
                            {identity} : Identifying user info (email/username)}
                            {--attr= : Manually set identify attribute}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add an Entrust role to a user';


    protected $userModel;

    /**
     * Create a new command instance.
     *
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
        /** @var Role $role */
        $role = $this->loadRole($role_name);
        if($role == null) return;

        $identity = $this->argument('identity');
        /** @var User $user */
        $user = $this->loadUser($identity,$this->option('attr'));
        if($user == null) return;

        if($user->hasRole($role_name)) {
            $this->error("The role '$role_name' is already attached to the '$identity' user.");
            return;
        }


        $user->attachRole($role);
        $this->info("Successfully attached the '$role_name' role to the '$identity' user.");
    }

}