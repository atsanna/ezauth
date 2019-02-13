<?php namespace EZAuth\Models;

use CodeIgniter\Model;
use EZAuth\Entities\User;

class UserModel extends Model
{
	protected $table = 'users';

	protected $allowedFields = [
		'first_name', 'last_name', 'email', 'password_hash',
	];

	protected $useTimestamps = true;

	protected $validationRules = [
		'first_name' => 'required|min_length[2]',
		'last_name'  => 'required|min_length[2]',
		'email'      => 'required|valid_email|is_unique[users.email,id,{id}]',
	];

	protected $returnType = User::class;
}
