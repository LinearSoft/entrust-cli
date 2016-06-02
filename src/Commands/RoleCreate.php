<?php
/**
 * Created by PhpStorm.
 * User: meej
 * Date: 6/1/2016
 * Time: 8:00 PM
 */

namespace LinearSoft\EntrustCli\Commands;

use LinearSoft\EntrustCli\Models\Role;

class RoleCreate extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entrust-cli:role:create 
                            {name : Name of the role} 
                            {display_name? : Display name of the role} 
                            {description? : Description of the role}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an Entrust role';

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
        $role = $this->loadRole($name,true);
        if($role != null) return;
        $displayName = $this->argument('display_name');
        $description = $this->argument('description');
        Role::create([
            Role::PROPERTY_NAME => $name,
            Role::PROPERTY_DISPLAY => $displayName,
            Role::PROPERTY_DESC => $description
        ]);
        $this->info("Successfully created the role '$name'.");
    }

}