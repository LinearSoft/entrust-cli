<?php
/**
 * Created by PhpStorm.
 * User: meej
 * Date: 6/1/2016
 * Time: 8:00 PM
 */

namespace LinearSoft\EntrustCli\Commands;


use Illuminate\Console\Command;
use LinearSoft\EntrustCli\Models\Role;

class RolesListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entrust-cli:roles:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all Entrust role';

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
        $roles = Role::all([Role::PROPERTY_NAME,Role::PROPERTY_DISPLAY,Role::PROPERTY_DESC,Role::PROPERTY_KEY])->toArray();
        $this->table($headers,$roles);
    }

}