<?php
	class Authentication {
		public $user;
		public $email;
		public $password;

		const SUCCESS_URL = HOST.'?query=dashboard';

		public function __construct($email, $password) {
			if (!$email || !$password) {
				return NULL;
			}
			$this->email = $email;
			$this->password = $password;

			$validity = $this->validateCredentials();
			if (!$validity) {
				return NULL;
			}
			$this->user = new User();
		}

		private function getEncryptedPassword() {
			return sha1(
				substr($this->email, 0, strlen($this->email)) .
				substr($this->password, 0, strlen($this->password)) .
				substr($this->email, strlen($this->email)) .
				substr($this->password, strlen($this->password))
			);
		}

		private function validateCredentials() {
			global $DB_CONNECT;

			$email = $this->email;

			$stmt = $DB_CONNECT->prepare("SELECT * FROM `users` WHERE `email` = ?");
			$stmt->bind_param('s', $email);
			$stmt->execute();
			$result = $stmt->get_result();
			$row = $result->fetch_assoc();
			$stmt->close();

			$encryptedPassword = $this->getEncryptedPassword();
			if (!empty($row) && $row != NULL && $row['email'] == $this->email && $row['password'] == $encryptedPassword) {
				return true;
			}
			return false;
		}
	}