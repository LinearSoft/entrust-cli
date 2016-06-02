<?php
/**
 * Created by PhpStorm.
 * User: meej
 * Date: 6/1/2016
 * Time: 8:00 PM
 */

namespace LinearSoft\EntrustCli\Commands;

use LinearSoft\EntrustCli\Models\Permission;

class PermDelete extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entrust-cli:permission:delete 
                            {name : Name of the permission}
                            {--soft : Handle the special case of soft delete models with non-cascading deletes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete an Entrust permission';

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
        /** @var Permission perm */
        $perm = $this->loadPerm($name);
        if($perm == null) return;
        $perm->delete();
        if($this->option('soft')) {
            $perm->roles()->sync([]);
            $perm->forceDelete();
        }
        $this->info("Successfully deleted the permission '$name'.");
    }

}