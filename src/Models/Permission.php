<?php
/**
 * Created by PhpStorm.
 * User: meej
 * Date: 6/2/2016
 * Time: 11:31 AM
 */

namespace LinearSoft\EntrustCli\Models;


use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    const PROPERTY_NAME     = 'name';
    const PROPERTY_DISPLAY  = 'display_name';
    const PROPERTY_DESC     = 'description';
    const PROPERTY_KEY      = 'id';
}