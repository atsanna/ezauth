<?php namespace EZAuth\Controllers;

use CodeIgniter\Controller;
use Config\Services;
use EZAuth\Config\Auth;
use EZAuth\Entities\User;
use EZAuth\Models\UserModel;

class RegisterController extends Controller
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
	 * Displays the registration form.
	 */
	public function index()
	{
		echo view($this->config->views['register']);
	}

	/**
	 * Updates or creates a user in the system.
	 */
	public function save(int $id = null)
	{
		// We need to validate passwords here since
		// the User Entity automatically creates the
		// password_hash field, which means these are
		// no longer around during the save method.
		if (! $this->validate([
			'password'     => 'required|min_length[8]|valid_password',
			'pass_confirm' => 'matches[password]',
		]))
        {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

		$userModel = new UserModel();
		$user = new User($this->request->getPost());

		// Check password one last time against variations of personal
        // information they've provided and reject if it matches.
        $passwords = Services::passwords();
        if ($passwords->hasPersonalVariations($this->request->getPost('password'), $user))
        {
            return redirect()->back()->withInput()->with('error', lang('Auth.noPersonalInfoAllowed'));
        }

		if (! $userModel->save($user))
		{
			return redirect()->back()->with('errors', $userModel->errors());
		}

		return redirect()->route('login')->with('message', lang('Auth.registerSuccess'));
	}
}
