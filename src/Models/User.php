<?php
/**
 * Created by PhpStorm.
 * User: meej
 * Date: 6/2/2016
 * Time: 9:23 AM
 */

namespace LinearSoft\EntrustCli\Models;

use Illuminate\Database\Eloquent\Model;

use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model
{
    use EntrustUserTrait;

    const PROPERTY_EMAIL    = 'email';
    const PROPERTY_USERNAME = 'username';
    const PROPERTY_KEY      = 'id';

    /**
     * @return User
     */
    public static function getAppModel()
    {
        /** @noinspection PhpUndefinedClassInspection */
        return new ${\Config::get('auth.providers.users.model')};
    }

    public static function calcUserIdentityField()
    {
        $model = self::getAppModel();


        $table = $model->getTable();

        /** @noinspection PhpUndefinedClassInspection */
        if(\Schema::hasColumn($table,self::PROPERTY_USERNAME)) return self::PROPERTY_USERNAME;
        /** @noinspection PhpUndefinedClassInspection */
        if(\Schema::hasColumn($table,self::PROPERTY_EMAIL)) return self::PROPERTY_EMAIL;
        return self::PROPERTY_KEY;
    }

}