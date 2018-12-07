<?php namespace EZAuth\Passwords;

use CodeIgniter\Config\BaseConfig;
use EZAuth\Entities\User;

class Passwords
{
    /**
     * @var \EZAuth\Config\Auth
     */
    protected $config;

    public function __construct(BaseConfig $config)
    {
        $this->config = $config;
    }

    /**
     * Checks the password against our dictionary of leaked passwords.
     *
     * @param string      $password
     * @param string|null $error
     *
     * @return bool
     */
    public function isSafe(string $password, string &$error = null): bool
    {
        if (! $this->config->doDictionaryCheck)
        {
            return true;
        }

        // Loop over our dictionary to see if we can find the password
        $fp = fopen($this->config->dictionaryPath, 'r');
        if ($fp)
        {
            while (($line = fgets($fp, 4096)) !== false)
            {
                if ($password == trim($line))
                {
                    fclose($fp);

                    $error = lang('Auth.errorPasswordCommon');
                    return false;
                }
            }
        }

        fclose($fp);

        return true;
    }

    /**
     * Does a basic check of the password against the user's first name,
     * last name, and first part of the email address. If those are found
     * within the password, the password is rejected.
     *
     * @param string $password
     * @param User   $user
     *
     * @return bool
     */
    public function hasPersonalVariations(string $password, User $user)
    {
        $password = strtolower($password);
        $fields = [
            strtolower($user->first_name),
            strtolower($user->last_name),
            strtolower(substr($user->email, 0, strpos($user->email, '@')))
        ];

        foreach ($fields as $field)
        {
            if (strpos($password, $field) !== false)
            {
                return true;
            }
        }

        return false;
    }
}
