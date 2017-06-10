<?php

class Authentication
{
    private $user;

    public function __construct($email, $password)
    {
        if (!$email || !$password) {
            return null;
        }

        $User = new User($email);
        $validity = $User->validateCredentials($password);
        if (!$validity) {
            return null;
        }
        $this->user = $User;
    }

    public function isValid()
    {
        return ($this->user != null) ? true : false;
    }
}
