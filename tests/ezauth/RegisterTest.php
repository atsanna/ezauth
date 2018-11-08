<?php

use CodeIgniter\Test\FeatureTestCase;

class RegisterTest extends FeatureTestCase
{
	protected $refresh = true;

	protected $namespace = 'EZAuth';

	public function testSeeRegisterForm()
	{
		$response = $this->get('register');

		$response->assertSee('<h2>Register</h2>');
	}

	public function testRegisterSuccess()
	{
		$data = [
			'first_name' => 'Tom',
			'last_name' => 'Foolery',
			'email' => 'tf@example.com',
			'password' => 'secret123',
			'pass_confirm' => 'secret123'
		];

		$this->dontSeeInDatabase('users', ['email' => 'tf@example.com']);

		$response = $this->post('register', $data);

		$this->assertTrue($response->isRedirect());
		$this->seeInDatabase('users', ['email' => 'tf@example.com']);
	}
}
