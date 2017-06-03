<?php
	class Authentication {
		private $user;

		function __construct($email, $password) {
			if (!($email && $password)) {
				return false;
			}
			echo "<div>In Authentication constructor</div>";
			$user = new User();
		}
	}
?>