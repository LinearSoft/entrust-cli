<?php
/**
 * Created by PhpStorm.
 * User: meej
 * Date: 6/1/2016
 * Time: 8:00 PM
 */

namespace LinearSoft\EntrustCli\Commands;

use LinearSoft\EntrustCli\Models\Role;

class RolesDeleteCommand extends RolesCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entrust-cli:roles:delete 
                            {name : Name of the role}
                            {--soft : Handle the special case of soft delete models with non-cascading deletes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete an Entrust role';

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
        $role->delete();
        if($this->option('soft')) {
            $role->users()->sync([]);
            $role->perms()->sync([]);
            $role->forceDelete();
        }
        $this->info("Successfully deleted the role '$name'.");
    }

}