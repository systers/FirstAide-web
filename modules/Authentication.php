<?php

class Authentication
{
    private $user;

    public function __construct() {
    }

    // Create instance with session token
    public static function withSessionToken($session_token) {
        global $DB_CONNECT;

        if (empty($session_token)) {
            return null;
        }
        $instance = new self();
        $stmt = $DB_CONNECT->prepare("SELECT * FROM `user_session` WHERE `session_token` = ?");
        $stmt->bind_param('i', $session_token);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        if (!empty($row) && $row['user_id']) {
            $User = new User('', $row['user_id']);
            if (!empty($User)) {
                $instance->user = $User;
                return $instance;
            }
        }
        return null;
    }

    // Create instance with email and password
    public static function withEmailPassword($email, $password)
    {
        if (empty($email) || empty($password)) {
            return null;
        }
        $instance = new self();

        $User = new User($email);
        $validity = $User->validateCredentials($password);
        if (!$validity) {
            return null;
        }
        $instance->user = $User;
        return $instance;
    }

    // Create session token and adding log in database for validation
    public static function createSession($user_id) {
        global $DB_CONNECT;


        $session_token = self::generateSessionToken();

        $stmt = $DB_CONNECT->prepare("SELECT * FROM `user_session` WHERE `user_id` = ?");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if (!empty($row) && isset($row['user_id'])) {
            $stmt = $DB_CONNECT->prepare("UPDATE `user_session` SET `session_token` = ? WHERE `user_id` = ?");
            $stmt->bind_param('si', $session_token, $user_id);
            $stmt->execute();
            $affected_rows = $stmt->affected_rows;
            $stmt->close();
        } else {
            $stmt = $DB_CONNECT->prepare("INSERT INTO `user_session` (`session_token`, `user_id`) VALUES (?, ?)");
            $stmt->bind_param('si', $session_token, $user_id);
            $stmt->execute();
            $affected_rows = $stmt->affected_rows;
            $stmt->close();
        }

        if ($affected_rows > 0) {
            return $session_token;
        }
        return false;
    }

    // Generate random session token
    public static function generateSessionToken() {
        return md5(self::generateRandomString());
    }

    // Generate random string of length n
    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    // Check instance is valid
    public function isValid()
    {
        return ($this->user != null) ? true : false;
    }

    // Get instance User ID
    public function getUserId() {
        return $this->user->isValidUser();
    }
}


