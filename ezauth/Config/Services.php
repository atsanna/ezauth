<?php namespace EZAuth\Config;

use CodeIgniter\Config\BaseConfig;
use EZAuth\Passwords\Passwords;

class Services extends \Config\Services
{
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
