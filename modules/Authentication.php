<?php
	class Authentication {
		public $user;

		public function __construct($email, $password) {
			if (!$email || !$password) {
				return NULL;
			}

			$User = new User($email);
			$validity = $User->validateCredentials($password);
			if (!$validity) {
				return NULL;
			}
			$this->user = $User;
		}
	}