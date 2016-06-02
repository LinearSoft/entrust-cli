<?php
/**
 * Created by PhpStorm.
 * User: meej
 * Date: 6/1/2016
 * Time: 8:00 PM
 */

namespace LinearSoft\EntrustCli\Commands;

use Illuminate\Console\Command;
use LinearSoft\EntrustCli\Models\Permission;


class PermList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entrust-cli:permission:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all Entrust permissions';

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
        $headers = ['Name','Display Name','Description','Id'];
        $roles = Permission::all([Permission::PROPERTY_NAME,Permission::PROPERTY_DISPLAY,Permission::PROPERTY_DESC,Permission::PROPERTY_KEY])->toArray();
        $this->table($headers,$roles);
    }

}