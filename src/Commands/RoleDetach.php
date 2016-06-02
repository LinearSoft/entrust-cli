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


class RoleDetach extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entrust-cli:role:detach
                            {role_name : Name of role to detach}
                            {identity} : Identifying user info (defaults to email)}
                            {--e|email? : The identity is an email address (default)}
                            {--u|username? : The identity is a username}
                            {--o|other=? : Specify a specific identify field}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove an Entrust role from a user';


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
        $field = User::PROPERTY_EMAIL;
        if($this->option('username')) $field = User::PROPERTY_USERNAME;
        elseif($this->option('other')) $field = $this->option('other');
        /** @var User $user */
        $user = $this->loadUser($identity,$field);
        if($user == null) return;

        $user->detachRole($role);
        $this->info("Successfully detached the '$role_name' role from the '$identity' user.");
    }

}