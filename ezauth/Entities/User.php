<?php namespace EZAuth\Entities;

use CodeIgniter\Entity;

class User extends Entity
{
	protected $first_name;
	protected $last_name;
	protected $email;
	protected $password_hash;

	/**
	 * Hashes the user's password and saves the hash.
	 *
	 * @param string $password
	 *
	 * @return $this
	 */
	public function setPassword(string $password)
	{
		// Replace all instances of multiple spaces to a single space
		// to keep a user from screwing themselves.
		$password = preg_replace('/\s+/', ' ', $password);

		$this->password_hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);

		return $this;
	}
}
