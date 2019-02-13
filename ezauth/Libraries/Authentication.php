<?php namespace EZAuth\Libraries;

use CodeIgniter\Database\Exceptions\DataException;
use CodeIgniter\Entity;
use CodeIgniter\Model;
use Config\Services;
use EZAuth\Entities\User;
use EZAuth\Models\UserModel;
use EZAuth\Models\LoginModel;
use EZAuth\Entities\LoginAttempt;
use CodeIgniter\HTTP\IncomingRequest;
use EZAuth\Passwords\Passwords;

class Authentication
{
    /**
     * @var LoginModel
     */
    protected $loginModel;

    /**
     * @var LoginAttempt
     */
    protected $loginAttempt;

    /**
     * @var UserModel
     */
    protected $userModel;
    /**
     * @var User
     */
    protected $user;

    /**
     * Sets the LoginModel instance to use for this class.
     *
     * @param Model $model
     *
     * @return $this
     */
    public function setLoginModel(Model $model)
    {
        $this->loginModel = $model;

        return $this;
    }

    /**
     * @param Model $model
     *
     * @return $this
     */
    public function setUserModel(Model $model)
    {
        $this->userModel = $model;

        return $this;
    }

    /**
     * @return User
     */
    public function user()
    {
        return $this->user;
    }

    /**
     * @return mixed|null
     */
    public function id()
    {
        return $this->user->id ?? null;
    }

    /**
     * Attempts to log the current user in.
     *
     * @param IncomingRequest $request
     *
     * @return bool
     */
    public function attempt(IncomingRequest $request)
    {
        // We always save the request whether it's successful or not.
        $this->loginAttempt = (new LoginAttempt())->fromRequest($request);

        $email = $request->getVar('email', FILTER_SANITIZE_EMAIL);
        $password = $request->getVar('password', FILTER_SANITIZE_STRING);

        if (session('logged_in') == 1)
        {
            $success = true;
        }
        else
        {
            $success = $this->validate($email, $password, true);
        }

        $this->loginAttempt->success = $success;
        $this->loginAttempt->user_id = $this->user->id ?? 0;
        if (! $this->loginModel->save($this->loginAttempt))
        {
            throw new DataException(implode(', ', $this->loginModel->errors()));
        }

        if (! $success)
        {
            return false;
        }

        $this->logUserIn($this->user,$request->getPost('remember') ?? false);

        return true;
    }

    /**
     * Validates a user login based on email/password.
     * If the attempt was a success, the current user will be
     * save at $this->user.
     *
     * @param string $email
     * @param string $password
     *
     * @return bool
     */
    public function validate(string $email, string $password)
    {
        $user = $this->userModel
            ->where('email', $email)
            ->first();

        if (! $user instanceof Entity)
        {
            return false;
        }

        if (! password_verify($password, $user->password_hash))
        {
            return false;
        }

        if (password_needs_rehash($password, PASSWORD_DEFAULT, ['cost' => 12]))
        {
            $user->setPassword($password);
            $this->userModel->save($user);
        }

        $this->user = $user;

        return true;
    }

    /**
     * Logs a user in and saves a remember-me token if necessary.
     *
     * @param User            $user
     * @param bool            $remember
     * @param IncomingRequest $request
     */
    public function logUserIn(User $user, bool $remember = false)
    {
        $config = config('App');

        // Regenerate the session to help prevent session fixation attacks.
        session()->regenerate();

        session()->set('logged_in', 1);

        // @todo handle remember-me safely
    }

    /**
     * Checks to see if a user is currently logged in.
     *
     * @return bool
     */
    public function isLoggedIn()
    {
        if ($this->user instanceof Entity)
        {
            return true;
        }

        if ($userId = session('logged_in'))
        {
            // Store our current user object
            $this->user = $this->userModel->find($userId);

            return true;
        }

        return false;
    }

    /**
     * Logs a user out and destroys their current session.
     */
    public function logUserOut()
    {
        // Clean up our session
        session()->set('logged_in', 0);
        session()->destroy();
        session()->regenerate(true);

        // @todo delete old remember me tokens.
    }
}
