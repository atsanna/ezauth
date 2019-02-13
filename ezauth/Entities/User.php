<?php namespace EZAuth\Entities;

use CodeIgniter\Entity;
use EZAuth\Passwords\Passwords;

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
		$this->password_hash = Passwords::hash($password);

		return $this;
	}
}
