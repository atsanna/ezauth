<?php namespace EZAuth\Passwords;

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
        // Loop over our dictionary to see if we can find the password
        $fp = fopen(__DIR__ .'/_dictionary.txt', 'r');
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
}
