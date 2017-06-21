<?php

class User
{
    public $email;
    public function __construct($email)
    {
        if (Utils::isValidEmail($email)) {
            $this->email = $email;
        } else {
            return null;
        }
    }

    private function getEncryptedPassword($password)
    {
        if (isset($this->email)) {
            return sha1(
                substr($this->email, 0, strlen($this->email)) .
                substr($password, 0, strlen($password)) .
                substr($this->email, strlen($this->email)) .
                substr($password, strlen($password))
            );
        }
        return false;
    }

    public function getUserDetails($userData)
    {
        return false;
    }

    public function isValidUser()
    {
        global $DB_CONNECT;

        $email = $this->email;

        $stmt = $DB_CONNECT->prepare("SELECT `user_id` FROM `users` WHERE `email` = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if (!empty($row && isset($row['user_id']))) {
            return $row['user_id'];
        }
        return false;
    }

    public function validateCredentials($password)
    {
        global $DB_CONNECT;

        $email = $this->email;

        $stmt = $DB_CONNECT->prepare("SELECT * FROM `users` WHERE `email` = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        $encryptedPassword = $this->getEncryptedPassword($password);
        if (!empty($row) && $row != null && $row['email'] == $this->email && $row['password'] == $encryptedPassword) {
            return true;
        }
        return false;
    }

    public function addUser($userData)
    {
        global $DB_CONNECT;
        if (isset($userData['email']) &&
            isset($userData['name']) &&
            isset($userData['password']) &&
            isset($userData['country']) &&
            isset($this->email)
        ) {
            if ($userData['email'] == $this->email) {
                $username = strtolower(str_replace(' ', '_', $userData['name']));
                $password = $this->getEncryptedPassword($userData['password']);
                $stmt = $DB_CONNECT->prepare("
						INSERT INTO `users` (
							`email`,
							`name`,
							`password`,
							`username`,
							`country`
						) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param(
                    'sssss',
                    $userData['email'],
                    $userData['name'],
                    $password,
                    $username,
                    $userData['country']
                );
                $stmt->execute();
                $affected = $stmt->affected_rows;
                $stmt->close();
                return $affected;
            }
        }
        return false;
    }

    public function updateUserDetails($userData)
    {
        return false;
    }
}
