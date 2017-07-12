<?php
namespace FirstAide;

class User
{
    private $db;
    private $user_id;
    private $name;
    private $country;

    public $email;

    const COUNT_CIRCLE_OF_TRUST = 5;

    public function __construct($db, $email = '', $user_id = 0)
    {
        $this->db = $db;
        if (Utils::isValidEmail($email)) {
            $this->email = $email;
            $found_user_id = $this->isValidUser();
            if (empty($found_user_id)) {
                return null;
            }
        } elseif ($user_id != 0) {
            $this->user_id = $user_id;
            $found_email = $this->getEmail();
            if (empty($found_email)) {
                return null;
            }
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

    public function getName()
    {
        return $this->name ?? '';
    }

    public function getEmail()
    {
        $user_id = $this->user_id;
        
        $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `user_id` = ?");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if (!empty($row) && isset($row['email'])) {
            $this->name = $row['name'];
            $this->country = $row['country'];
            $this->user_id = $row['user_id'];
            $this->email = $row['email'];
            return $row['email'];
        }
        return false;
    }

    public function isValidUser()
    {

        $email = $this->email;

        $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `email` = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if (!empty($row) && isset($row['user_id'])) {
            $this->name = $row['name'];
            $this->country = $row['country'];
            $this->user_id = $row['user_id'];
            $this->email = $row['email'];
            return $row['user_id'];
        }
        return false;
    }

    public function validateCredentials($password)
    {

        $email = $this->email;

        $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `email` = ?");
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
        if (isset($userData['email']) &&
            isset($userData['name']) &&
            isset($userData['password']) &&
            isset($userData['country']) &&
            isset($this->email)
        ) {
            if ($userData['email'] == $this->email) {
                $username = strtolower(str_replace(' ', '_', $userData['name']));
                $password = $this->getEncryptedPassword($userData['password']);
                $stmt = $this->db->prepare("
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
        $stmt = $this->db->prepare("SELECT * FROM `comrades` WHERE `user_id` = ?");
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

        $return = array(
            'response' => false,
            'message' => 'Something went wrong.'
        );
        if (is_array($comrades) && $this->user_id) {
            $comrades_str = implode(', ', $comrades);
            $found_user_id = $this->getCircleOfTrust();

            if ($found_user_id) {
                $stmt = $this->db->prepare("UPDATE `comrades` SET `comrade_details` = ? WHERE `user_id` = ?");
                $stmt->bind_param('si', $comrades_str, $found_user_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
            } else {
                $stmt = $this->db->prepare("INSERT INTO `comrades` (`user_id`, `comrade_details`) VALUES (?, ?)");
                $stmt->bind_param('is', $this->user_id, $comrades_str);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
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
        global $APPLICATION_DIR;

        $email = $this->email;
        $active_post_countries = array('SY','TN','UG');

        $country_list = file_get_contents($APPLICATION_DIR.'/javascripts/country_list.json');
        $country_list_json = json_decode($country_list, true);

        $stmt = $this->db->prepare("SELECT `country` FROM `users` WHERE `email` = ?");
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
