<?php

class User
{
    public $email;
    private $user_id;

    const COUNT_CIRCLE_OF_TRUST = 5;

    public function __construct($email)
    {
        if (Utils::isValidEmail($email)) {
            $this->email = $email;
            $this->user_id = $this->isValidUser();
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

        if (!empty($row) && isset($row['user_id'])) {
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

    public function getCircleOfTrust()
    {
        global $DB_CONNECT;
        $stmt = $DB_CONNECT->prepare("SELECT * FROM `comrades` WHERE `user_id` = ?");
        $stmt->bind_param('i', $this->user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        $found_user_id = false;
        if (!empty($row) && isset($row['user_id'])) {
            return $row;
        }
        return false;
    }
    public function updateCircleOfTrust($comrades)
    {
        global $DB_CONNECT;

        $return = array(
            'response' => false,
            'message' => 'Something went wrong.'
        );
        if (is_array($comrades) && $this->user_id) {
            $comrades_str = implode(', ', $comrades);
            $found_user_id = $this->getCircleOfTrust();

            if ($found_user_id) {
                $stmt = $DB_CONNECT->prepare("UPDATE `comrades` SET `comrade_details` = ? WHERE `user_id` = ?");
                $stmt->bind_param('si', $comrades_str, $found_user_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
                var_dump('1');
            } else {
                $stmt = $DB_CONNECT->prepare("INSERT INTO `comrades` (`user_id`, `comrade_details`) VALUES (?, ?)");
                $stmt->bind_param('is', $this->user_id, $comrades_str);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
                var_dump('2');
            }
            $return = array(
                'response' => true,
                'message' => "Updated comrade's details."
            );
        }
        return $return;
    }

     public function getCurrentPostCountry()
    {
        global $DB_CONNECT, $APPLICATION_DIR;

        $email = $this->email;
        $active_post_countries = array('SY','TN','UG');

        $country_list = file_get_contents($APPLICATION_DIR.'/javascripts/country_list.json');
        $country_list_json = json_decode($country_list, true);

        $stmt = $DB_CONNECT->prepare("SELECT `country` FROM `users` WHERE `email` = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        // default is Uganda
        $country_found = 'UG';
        if (!empty($row) && isset($row['country'])) {
            $country_found = strtoupper($row['country']);
            $country_found = in_array($country_found, $active_post_countries) ?
                $country_found :
                'UG';
        }
        return $country_list_json[$country_found];
    }
}
