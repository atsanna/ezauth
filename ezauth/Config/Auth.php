<?php namespace EZAuth\Config;

class Auth
{
	public $views = [
		'register' => 'EZAuth\register',
		'login'    => ''
	];

	// Should the password be checked against a
    // database of leaked files?
	public $doDictionaryCheck = true;

	// The location to the dictionary file to use
    // Defaults to ezauth/Passwords/_dictionary.txt
	public $dictionaryPath = __DIR__ .'/../Passwords/_dictionary.txt';

	// Should the password be checked against the
    // supplied first/last/email that we got from registration?
	public $doPersonalVariationsCheck = true;
}
