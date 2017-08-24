<?php
namespace FirstAide;

class User
{
    private $db;
    private $user_id;
    private $name;
    private $country;

    public $email;
    public $valid;

    const COUNT_CIRCLE_OF_TRUST = 5;

    /**
     * Method : __construct
     * Description : constructor for the user object
     * @db  string : database instance
     * @email string : email of user corresponding to user object
     * @user_id string : unique user_id of a user
     */
    public function __construct($db, $email = '', $user_id = 0)
    {
        $this->db = $db;
        if (Utils::isValidEmail($email)) {
            $this->email = $email;
            $found_user_id = $this->isValidUser();
            if (empty($found_user_id)) {
                $this->setEmptyObject();
                return null;
            }
        } elseif ($user_id != 0) {
            $this->user_id = $user_id;
            $found_email = $this->getEmailFromDb();
            if (empty($found_email)) {
                $this->setEmptyObject();
                return null;
            }
        } else {
            $this->setEmptyObject();
            return null;
        }
    }

    /**
     * Method : setEmptyObject
     * Description : Method to check if an object is empty
     */
    private function setEmptyObject()
    {
        $this->valid = false;
    }

    /**
     * Method : getEncryptedPassword
     * Description : Method to encrypt password using sha1 encryption algorithm
     * @password string : password of user that needs to be encrypted
     */
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

    /**
     * Method : getName
     * Description : Method to get user name for a particular user object
     */
    public function getName()
    {
        return $this->name ?? '';
    }

    /**
     * Method : getEmailAddress
     * Description : Method to get email address of a user corresponding to a user object
     */
    public function getEmailAddress()
    {
        return $this->email ?? '';
    }

    /**
     * Method : getEmailFromDb
     * Description : Method to fetch email and user details from database
     */
    public function getEmailFromDb()
    {
        $user_id = $this->user_id;
        
        $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `user_id` = ?");
        $stmt->bindParams('i', $user_id);
        $stmt->execute();
        $result = $stmt->getResults();
        $row = $result->fetchAssoc();
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

    /**
     * Method : isValidUser
     * Description : Method to check if a user is valid
     */
    public function isValidUser()
    {
        $email = $this->email;

        $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `email` = ?");
        $stmt->bindParams('s', $email);
        $stmt->execute();
        $result = $stmt->getResults();
        $row = $result->fetchAssoc();
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

    /**
     * Method : validateCredentials
     * Description : Method to validate user credentials
     * @password string : password of user that needs to be encrypted
     */
    public function validateCredentials($password)
    {

        $email = $this->email;

        $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `email` = ?");
        $stmt->bindParams('s', $email);
        $stmt->execute();
        $result = $stmt->getResults();
        $row = $result->fetchAssoc();
        $stmt->close();

        $encryptedPassword = $this->getEncryptedPassword($password);
        if (!empty($row) && $row != null && $row['email'] == $this->email && $row['password'] == $encryptedPassword) {
            return true;
        }
        return false;
    }

    /**
     * Method : addUser
     * Description : Method to add user to database
     * @userData string : User object for the user module having credentials of a unique user
     */
    public function addUser($userData)
    {
        if (isset($userData['email']) &&
            isset($userData['name']) &&
            isset($userData['password']) &&
            isset($userData['country']) &&
            isset($this->email)
        ) {
            if ($userData['email'] == $this->email) {
                $password = $this->getEncryptedPassword($userData['password']);
                $stmt = $this->db->prepare("
                    INSERT INTO `users` (`email`, `name`, `password`, `country`)
                    VALUES (?, ?, ?, ?)");
                $stmt->bindParams(
                    'ssss',
                    $userData['email'],
                    $userData['name'],
                    $password,
                    $userData['country']
                );
                $stmt->execute();
                $affected = $stmt->getAffectedRows();
                $stmt->close();
                return $affected;
            }
        }
        return false;
    }

    /**
     * Method : getCircleOfTrust
     * Description : Method to get all the comrade details in circle of trust for a particular user
     */
    public function getCircleOfTrust()
    {
        $stmt = $this->db->prepare("SELECT * FROM `comrades` WHERE `user_id` = ?");
        $stmt->bindParams('i', $this->user_id);
        $stmt->execute();
        $result = $stmt->getResults();
        $row = $result->fetchAssoc();
        $stmt->close();

        $found_user_id = false;
        if (!empty($row) && isset($row['user_id'])) {
            return $row;
        }
        return false;
    }

    /**
     * Method : getCircleOfTrustNumbers
     * Description : Method to get comrade numbers corresponding to a unique users' circle of trust
     */
    public function getCircleOfTrustNumbers()
    {
        $numbers = array();
        $comrades_detail = $this->getCircleOfTrust();
        if ($comrades_detail && is_array($comrades_detail)) {
            $numbers = !empty($comrades_detail['comrade_details'])
                ? explode(', ', $comrades_detail['comrade_details'])
                : array();
            array_walk($numbers, function (&$v, &$k) {
                $v = '+' . $v;
            });
        }
        return $numbers;
    }

    /**
     * Method : updateCircleOfTrust
     * Description : Method to update circle of trust details
     * @comrades string : Details of circle of trust comrades
     */
    public function updateCircleOfTrust($comrades)
    {
        $return = array(
            'response' => false,
            'message' => 'Something went wrong.'
        );
        if (is_array($comrades) && $this->user_id) {
            $comrades_str = implode(', ', $comrades);
            $found_circle_of_trust = $this->getCircleOfTrust();
            $found_user_id = $found_circle_of_trust['user_id'];

            if ($found_user_id) {
                $stmt = $this->db->prepare("UPDATE `comrades` SET `comrade_details` = ? WHERE `user_id` = ?");
                $stmt->bindParams('si', $comrades_str, $found_user_id);
            } else {
                $stmt = $this->db->prepare("INSERT INTO `comrades` (`user_id`, `comrade_details`) VALUES (?, ?)");
                $stmt->bindParams('is', $this->user_id, $comrades_str);
            }
            $stmt->execute();
            $affected = $stmt->getAffectedRows();
            $stmt->close();
            $return = array(
                'response' => true,
                'message' => "Updated comrade's details."
            );
        }
        return $return;
    }

    /**
     * Method : getCurrentPostCountry
     * Description : Method to get current country post data
     */
    public function getCurrentPostCountry()
    {
        global $APPLICATION_DIR;

        $email = $this->email;
        $active_post_countries = array('SY','TN','UG');

        $APPLICATION_DIR = empty($APPLICATION_DIR)
            ? str_replace('modules', '', dirname(__FILE__))
            : $APPLICATION_DIR;
        $country_list = file_get_contents($APPLICATION_DIR.'/js/country_list.json');
        $country_list_json = json_decode($country_list, true);

        $stmt = $this->db->prepare("SELECT `country` FROM `users` WHERE `email` = ?");
        $stmt->bindParams('s', $email);
        $stmt->execute();
        $result = $stmt->getResults();
        $row = $result->fetchAssoc();
        $stmt->close();

        // default is Uganda
        $country_found = 'UG';
        if (!empty($row) && isset($row['country'])) {
            $country_found = strtoupper($row['country']);
        }

        return $country_list_json[$country_found];
    }

    /**
     * Method : updateUserInfo
     * Description : Method to update user information such as email and password
     * through account settings section
     * @userInfo array : array of user info containing email, password and country
     */
    public function updateUserInfo($userInfo)
    {
        $return = array(
            'response' => false,
            'reload' => true,
            'message' => 'Something went wrong.'
        );
        if (!is_array($userInfo)
            || !(isset($userInfo['email']))
            || !isset($userInfo['name'])
            || !isset($userInfo['country'])
            || !isset($userInfo['password'])
        ) {
            $return['response'] = false;
            $return['message'] = "Please fill up all the fields.";
            return $return;
        }
        if ($userInfo['email'] != $this->email) {
            $return['response'] = false;
            $return['message'] = "Unauthorised access.";
            return $return;
        }
        $user_id = $this->user_id;
        $name = $userInfo['name'];
        $country = $userInfo['country'];
        $password = $userInfo['password'];
        $encryptedPassword = $this->getEncryptedPassword($password);

        $stmt = $this->db->prepare(
            "UPDATE `users` SET `name` = ?, `country` = ?, `password` = ? WHERE `user_id` = ?"
        );
        $stmt->bindParams('sssi', $name, $country, $encryptedPassword, $user_id);
        $stmt->execute();
        $affected = $stmt->getAffectedRows();
        $stmt->close();
        $return['response'] = true;
        $return['message'] = "Updated user's details.";
        return $return;
    }
}
