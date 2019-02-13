<?php namespace EZAuth\Entities;

use CodeIgniter\Entity;
use CodeIgniter\HTTP\IncomingRequest;

class LoginAttempt extends Entity
{
    protected $id;
    protected $ip_address;
    protected $email;
    protected $user_agent;
    protected $user_id;
    protected $date;
    protected $success;

    protected $_options = [
        'casts' => [
            'date' => 'datetime',
            'success' => 'boolean',
        ],
        'dates' => ['created_at', 'updated_at'],
        'datamap' =>  []
    ];

    /**
     * Fills out the required fields from a request instance.
     *
     * @param IncomingRequest $request
     *
     * @return LoginAttempt
     */
    public function fromRequest(IncomingRequest $request)
    {
        $this->ip_address = $request->getIPAddress();
        $this->email = $request->getVar('email', FILTER_SANITIZE_EMAIL);
        $this->user_agent = (string)$request->getUserAgent();
        $this->date = date('Y-m-d H:i:s');

        return $this;
    }
}
