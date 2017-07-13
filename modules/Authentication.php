<?php
namespace FirstAide;

class Authentication
{
    private $db;
    private $user;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Create instance with session token
    public static function withSessionToken($db, $session_token)
    {
        if (empty($session_token)) {
            return null;
        }
        $instance = new self($db);
        $row = $instance->getUserIdFromSessionToken($session_token);   
        if (!empty($row) && $row['user_id']) {
            $User = new User($db, '', $row['user_id']);
            if (!empty($User)) {
                $instance->user = $User;
                return $instance;
            }
        }
        return null;
    }

    // Create instance with email and password
    public static function withEmailPassword($db, $email, $password)
    {
        if (empty($email) || empty($password) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return null;
        }
        $instance = new self($db);

        $User = new User($db, $email);
        if ($User != null) {
            $validity = $User->validateCredentials($password);
            if (!$validity) {
                return null;
            }
            $instance->user = $User;
            return $instance;
        }
        return null;
    }

    public function getUserIdFromSessionToken($session_token) {
        $stmt = $this->db->prepare("SELECT * FROM `user_session` WHERE `session_token` = ?");
        $stmt->bind_param('i', $session_token);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row;
    }

    // Create session token and adding log in database for validation
    public static function createSession($db, $user_id)
    {
        if ($user_id > 0) {
            $session_token = self::generateSessionToken();

            $stmt = $db->prepare("SELECT * FROM `user_session` WHERE `user_id` = ?");
            $stmt->bind_param('i', $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $stmt->close();

            if (!empty($row) && isset($row['user_id'])) {
                $stmt = $db->prepare("UPDATE `user_session` SET `session_token` = ? WHERE `user_id` = ?");
                $stmt->bind_param('si', $session_token, $user_id);
                $stmt->execute();
                $affected_rows = $stmt->affected_rows;
                $stmt->close();
            } else {
                $stmt = $db->prepare("INSERT INTO `user_session` (`session_token`, `user_id`) VALUES (?, ?)");
                $stmt->bind_param('si', $session_token, $user_id);
                $stmt->execute();
                $affected_rows = $stmt->affected_rows;
                $stmt->close();
            }

            if ($affected_rows > 0) {
                return $session_token;
            }
        }
        return false;
    }

    // Generate random session token
    public static function generateSessionToken()
    {
        return md5(self::generateRandomString());
    }

    // Generate random string of length n
    public function generateRandomString($length = 10)
    {
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
    public function getUserId()
    {
        return ($this->user != null) ? $this->user->isValidUser() : 0;
    }
}
