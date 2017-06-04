<?php
	class Authentication {
		private $user;

		function __construct($email, $password) {
			if (!($email && $password)) {
				return false;
			}
			$user = new User();
		}
	}
?>
