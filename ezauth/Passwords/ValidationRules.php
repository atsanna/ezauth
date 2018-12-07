<?php namespace EZAuth\Passwords;

use Config\Services;

class ValidationRules
{
    /**
     * Checks the password against our dictionary file.
     *
     * @param null        $password
     * @param string|null $error
     *
     * @return bool
     */
    public function valid_password($password = null, string &$error = null): bool
    {
        $passwords = Services::passwords();

        return $passwords->isSafe($password, $error);
    }
}
