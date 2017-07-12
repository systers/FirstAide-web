<?php

use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__).'/../../includes/settings.php';
require_once dirname(__FILE__).'/../../includes/db_connection.php';
require_once dirname(__FILE__).'/../../modules/Utils.php';

class AuthenticationTest extends TestCase
{
    private static $email;
    private static $password;
    private static $user_id;

    public static function setUpBeforeClass()
    {
        global $DB_CONNECT;

        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $temp_mail = '';
        for ($i = 0; $i < 7; $i++) {
            $temp_mail .= $characters[rand(0, $charactersLength - 1)];
        }
        $temp_mail = $temp_mail.'@domain.com';

        $name = 'FirstAide User';
        $password = 'somerandompassword';
        $country = 'UG';
        $password_hash = sha1(
            substr($temp_mail, 0, strlen($temp_mail)) .
                substr($password, 0, strlen($password)) .
                substr($temp_mail, strlen($temp_mail)) .
                substr($password, strlen($password))
        );
        $username = strtolower(str_replace(' ', '_', $name));
        $stmt = $DB_CONNECT->prepare(
            "
				INSERT INTO `users` (
					`email`,
					`name`,
					`password`,
					`username`,
					`country`
				) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param(
            'sssss',
            $temp_mail,
            $name,
            $password_hash,
            $username,
            $country
        );
        $stmt->execute();
        $affected = $stmt->affected_rows;
        $stmt->close();

        $stmt = $DB_CONNECT->prepare("SELECT * FROM `users` WHERE `email` = ?");
        $stmt->bind_param('s', $temp_mail);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        $user_id = 0;
        if (!empty($row) && isset($row['user_id'])) {
            $user_id = $row['user_id'];
        }

        self::$email = $temp_mail;
        self::$password = $password;
        self::$user_id = $user_id;
    }

    public function testValidEmailAddress()
    {
        $Auth = Authentication::withEmailPassword(self::$email, self::$password);
        $this->assertNotNull($Auth);
        $this->assertTrue($Auth->isValid());
        $this->assertEquals($Auth->getUserId(), self::$user_id);
    }

    public function testInvalidEmailAddress()
    {
        $Auth = Authentication::withEmailPassword('invalid', self::$password);
        $this->assertNull($Auth);
    }

    public function testValidSessionToken()
    {
        $Auth = Authentication::withSessionToken(self::$session_token);
        $this->assertNotNull($Auth);
        $this->assertTrue($Auth->isValid());
        $this->assertEquals($Auth->getUserId(), self::$user_id);
    }

    public function testInvalidSessionToken()
    {
        $Auth = Authentication::withSessionToken('');
        $this->assertNull($Auth);
    }

    public function testGenerateSessionToken()
    {
        $this->assertNotEquals(
            Authentication::generateSessionToken(),
            Authentication::generateSessionToken()
        );
    }

    public function testCreateSessionWithValidUserId()
    {
        $this->assertNotEquals(
            Authentication::createSession(self::$user_id),
            self::$session_token
        );
    }

    public function testCreateSessionWithInvalidUserId()
    {
        $this->assertFalse(
            Authentication::createSession(0)
        );
    }

    public static function tearDownAfterClass()
    {
        global $DB_CONNECT;

        $stmt = $DB_CONNECT->prepare("DELETE FROM `users` WHERE `user_id` = ?");
        $stmt->bind_param('i', self::$user_id);
        $stmt->execute();
        $affected_rows = $stmt->affected_rows;
        $stmt->close();

        $stmt = $DB_CONNECT->prepare("DELETE FROM `user_session` WHERE `user_id` = ?");
        $stmt->bind_param('i', self::$user_id);
        $stmt->execute();
        $affected_rows = $stmt->affected_rows;
        $stmt->close();
    }
}
