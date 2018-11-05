<?php namespace EZAuth\Controllers;

use CodeIgniter\Controller;
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
		$this->validate([
			'password'     => 'min_length[8]',
			'pass_confirm' => 'matches[password]',
		]);

		$userModel = new UserModel();

		$user = new User($this->request->getPost());

		if (! $userModel->save($user))
		{
			return redirect()->back()->with('errors', $userModel->errors());
		}

		return redirect()->route('login')->with('message', lang('Auth.registerSuccess'));
	}
}
