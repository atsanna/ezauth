<?php namespace EZAuth\Config;

use CodeIgniter\Config\BaseConfig;
use EZAuth\Libraries\Authentication;
use EZAuth\Models\LoginModel;
use EZAuth\Models\UserModel;
use EZAuth\Passwords\Passwords;

class Services extends \Config\Services
{
    /**
     * @param LoginModel|null $logins
     * @param bool            $getShared
     *
     * @return mixed
     */
    public static function authentication(LoginModel $logins = null, UserModel $users = null, $getShared = true)
    {
        if ($getShared)
        {
            return self::getSharedInstance('authentication', $logins, $users);
        }

        $auth = new Authentication();

        if (is_null($logins))
        {
            $logins = new LoginModel();
        }

        if (is_null($users))
        {
            $users = new UserModel();
        }

        return $auth->setLoginModel($logins)->setUserModel($users);
    }

    /**
     * Returns the passwords utility class.
     *
     * @param BaseConfig|null $config
     * @param bool            $getShared
     *
     * @return Passwords|mixed
     */
    public static function passwords(Auth $config = null, $getShared = true)
    {
        if ($getShared)
        {
            return self::getSharedInstance('passwords', $config);
        }

        if (is_null($config))
        {
            $config = new Auth();
        }

        return new Passwords($config);
    }
}
