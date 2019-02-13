<?php namespace EZAuth\Controllers;

use Config\Services;
use EZAuth\Config\Auth;
use CodeIgniter\Controller;
use CodeIgniter\Database\Exceptions\DataException;

class LoginController extends Controller
{
    /**
     * @var Auth
     */
    protected $config;

    public function __construct()
    {
        $this->config = config(Auth::class);
    }

    /**
     * Displays the login form.
     */
	public function showForm()
	{
        echo view($this->config->views['login']);
	}

    /**
     * Attempts to login a user via their credentials.
     */
    public function attempt()
    {
        $auth = Services::authentication();

        try
        {
            $auth->attempt($this->request);
        }
        catch (DataException $e)
        {
            return redirect()->route('login')->with('error', $e->getMessage());
        }

        return redirect()->to('/')->with('message', 'Welcome back!');
	}
}
