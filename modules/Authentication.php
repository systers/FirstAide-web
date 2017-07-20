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
/**
     * @method : getUserIdFromSessionToken
     * @description : get user_id for a given session token
     * @dsession_token string : session token for a user
     */
    private function getUserIdFromSessionToken($session_token)
    {
        $stmt = $this->db->prepare("SELECT * FROM `user_session` WHERE `session_token` = ?");
        $stmt->bindParams('s', $session_token);
        $stmt->execute();
        $result = $stmt->getResults();
        $row = $result->fetchAssoc();
        $stmt->close();
        if (!empty($row) && $row['user_id']) {
            return $row['user_id'];
        }
        return false;
    }
    /**
     * @method : createInstanceWithSessionToken
     * @description : Create authentication instance with session token
     * @db MysqlDatabase : database instance
     * @session_token string : session token of the user
     */
    public static function createInstanceWithSessionToken($db, $session_token)
    {
        if (empty($session_token)) {
            return null;
        }
        $instance = new self($db);
        $found_user_id = $instance->getUserIdFromSessionToken($session_token);
        if ($found_user_id) {
            $User = new User($db, '', $found_user_id);
            if (!empty($User)) {
                $instance->user = $User;
                return $instance;
            }
        }
        return null;
    }

    /**
     * @method : createInstanceWithEmailPassword
     * @description : Create authentication instance with email and password
     * @db MysqlDatabase : database instance
     * @email string : email of the user
     * @password string: password for the corresponding email
     */
    public static function createInstanceWithEmailPassword($db, $email, $password)
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

    /**
     * @method : createSession
     * @description : Create session token and adding log in database for validation
     * @db MysqlDatabase: database instance
     * @user_id int : user_id of the user
     */
    public static function createSession($db, $user_id)
    {
        if ($user_id > 0) {
            $session_token = self::generateSessionToken();

            $stmt = $db->prepare("SELECT * FROM `user_session` WHERE `user_id` = ?");
            $stmt->bindParams('i', $user_id);
            $stmt->execute();
            $result = $stmt->getResults();
            $row = $result->fetchAssoc();
            $stmt->close();

            if (!empty($row) && isset($row['user_id'])) {
                $stmt = $db->prepare("UPDATE `user_session` SET `session_token` = ? WHERE `user_id` = ?");
                $stmt->bindParams('si', $session_token, $user_id);
                $stmt->execute();
                $affected_rows = $stmt->getAffectedRows();
                $stmt->close();
            } else {
                $stmt = $db->prepare("INSERT INTO `user_session` (`session_token`, `user_id`) VALUES (?, ?)");
                $stmt->bindParams('si', $session_token, $user_id);
                $stmt->execute();
                $affected_rows = $stmt->getAffectedRows();
                $stmt->close();
            }

            if ($affected_rows > 0) {
                return $session_token;
            }
        }
        return false;
    }

    /**
     * @method : generateSessionToken
     * @description : Generate random session token
     */
    public static function generateSessionToken()
    {
        return md5(self::generateRandomString());
    }

    /**
     * @method : generateRandomString
     * @description : Generate random string of length n
     * @length int : length of the required random string
     */
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

    /**
     * @method : isValid
     * @description : Check for valid authentication instance
     */
    public function isValid()
    {
        return ($this->user != null) ? true : false;
    }

    /**
     * @method : getUserId
     * @description : Check of the user_id is valid
     */
    public function getUserId()
    {
        return ($this->user != null) ? $this->user->isValidUser() : 0;
    }
}
