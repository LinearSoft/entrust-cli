<?php
/**
 * Created by PhpStorm.
 * User: meej
 * Date: 6/1/2016
 * Time: 8:00 PM
 */

namespace LinearSoft\EntrustCli\Commands;

use LinearSoft\EntrustCli\Models\Permission;

class PermCreate extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entrust-cli:permission:create 
                            {name : Name of the permission} 
                            {display_name? : Display name of the permission} 
                            {description? : Description of the permission}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an Entrust permission';

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
        $perm = $this->loadPerm($name,true);
        if($perm != null) return;
        $displayName = $this->argument('display_name');
        $description = $this->argument('description');
        Permission::create([
            Permission::PROPERTY_NAME => $name,
            Permission::PROPERTY_DISPLAY => $displayName,
            Permission::PROPERTY_DESC => $description
        ]);
        $this->info("Successfully created the permission '$name'.");
    }

}