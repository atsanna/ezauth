<?php namespace EZAuth\Models;

use CodeIgniter\Model;
use EZAuth\Entities\LoginAttempt;

class LoginModel extends Model
{
	protected $table = 'auth_logins';

	protected $allowedFields = [
		'ip_address', 'email', 'user_agent', 'user_id', 'date', 'success'
	];

	protected $useTimestamps = true;

	protected $validationRules = [
		'ip_address' => 'required',
		'email'      => 'required|valid_email',
        'user_agent' => 'required',
        'user_id'    => 'integer',
        'date'       => 'required|valid_date',
        'success'    => 'integer'
	];

	protected $returnType = LoginAttempt::class;
}
