<?php
/**
 *
 * AuthenticationTest.php is unit test file for Authentication module.
 * (modules/Authentication.php)
 */

namespace Tests\FirstAide;

/**
 * Importing required modules/wrappers
 */
use FirstAide\User;
use FirstAide\Authentication;
use FirstAide\MysqlDatabase;
use PHPUnit\Framework\TestCase;
use Tests\MysqlWrapperMockTrait;

class AuthenticationTest extends TestCase
{
    /**
     * Importing mock MySQL wrapper
     */
    use MysqlWrapperMockTrait;

    /**
     * Method : assertSessionFoundForSessionToken
     * Description : Method to assert if session was found for session token
     * @databaseMock MysqlDatabase : mock MysqlDatabase instance
     * @users array : array of expected users
     */
    private function assertSessionFoundForSessionToken(
        MysqlDatabase $databaseMock,
        array $expectedUsers
    ) {
        $userCounter = 0;
        foreach ($expectedUsers as $user) {
            $UserAuth = Authentication::createInstanceWithSessionToken($databaseMock, $user['session_token']);
            $this->assertInstanceOf(Authentication::class, $UserAuth);
            $this->assertTrue($UserAuth->isValid());
            $this->assertEquals($UserAuth->getUserId(), $user['user_id']);
            $userCounter += 1;
        }
        $this->assertEquals(count($expectedUsers), $userCounter);
    }

    /**
     * Method : assertSessionFoundForEmailAndPassword
     * Description : Method to assert if session is found for valid user credentials
     * @databaseMock MysqlDatabase : mock MysqlDatabase instance
     * @espectedUsers array : array of expected users
     */
    private function assertSessionFoundForEmailAndPassword(
        MysqlDatabase $databaseMock,
        array $expectedUsers
    ) {
        $userCounter = 0;
        foreach ($expectedUsers as $user) {
            $UserAuth = Authentication::createInstanceWithEmailPassword(
                $databaseMock,
                $user['email'],
                $user['password']
            );
            $this->assertInstanceOf(Authentication::class, $UserAuth);
            $this->assertTrue($UserAuth->isValid());
            $this->assertEquals($UserAuth->getUserId(), $user['user_id']);
            $userCounter += 1;
        }
        $this->assertEquals(count($expectedUsers), $userCounter);
    }

    /**
     * Method : assertMultipleUniqueSessions
     * Description : Method to assert multiple unique sessions
     * @databaseMock MysqlDatabase : mock MysqlDatabase instance
     * @expectedUsers array : array of expected users
     */
    private function assertMultipleUniqueSessions(
        MysqlDatabase $databaseMock,
        array $expectedUsers
    ) {
        $userCounter = 0;
        $sessionTokens = array();
        foreach ($expectedUsers as $user_id) {
            $sessionToken = Authentication::createSession(
                $databaseMock,
                $user_id
            );
            $this->assertNotFalse($sessionToken);
            $this->assertTrue(!in_array($sessionToken, $sessionTokens));
            $sessionTokens[] = $sessionToken;
            $userCounter += 1;
        }
        $this->assertEquals(count($expectedUsers), $userCounter);
    }

    /**
     * Method : testMultipleSessionToken
     * Description : Method to test multiple session tokens
     * @databaseMock MysqlDatabase : mock MysqlDatabase instance
     *
     * @dataProvider mysqlMockProvider
     */
    public function testMultipleSessionToken($databaseMock)
    {
        $this->assertSessionFoundForSessionToken(
            $databaseMock,
            array(
                array(
                    'user_id' => 1,
                    'session_token' => '0e1461b241f9c30acd59a8161e6057f1'
                ),
                array(
                    'user_id' => 2,
                    'session_token' => '0e372a4f0447f221acdd37671fd3d3a3'
                )
            )
        );
    }

    /**
     * Method : testMultipleSessionsForEmailAndPassword
     * Description : Method to test multiple sessions for valid user credentials
     * @databaseMock MysqlDatabase : mock MysqlDatabase instance
     *
     * @dataProvider mysqlMockProvider
     */
    public function testMultipleSessionsForEmailAndPassword($databaseMock)
    {
        $this->assertSessionFoundForEmailAndPassword(
            $databaseMock,
            array(
                array(
                    'user_id' => 1,
                    'email' => 'r@domain.com',
                    'password' => 'dummypassword'
                ),
                array(
                    'user_id' => 2,
                    'email' => 'ken@domain.com',
                    'password' => 'dummypassword2'
                )
            )
        );
    }

    /**
     * Method : testMultipleCreatedSessions
     * Description : Method to test multiple created session
     * @databaseMock MysqlDatabase : mock MysqlDatabase instance
     *
     * @dataProvider mysqlMockProvider
     */
    public function testMultipleCreatedSessions($databaseMock)
    {
        $this->assertMultipleUniqueSessions(
            $databaseMock,
            array(1, 2, 3, 3, 3)
        );
    }

    /**
     * Method : testIsValidCsrfWithValidToken
     * Description : Method to test valid csrf token
     */
    public function testIsValidCsrfWithValidToken()
    {
        $this->assertTrue(
            Authentication::isValidCsrf('randomvalidcsrftoken', 'randomvalidcsrftoken')
        );
    }

    /**
     * Method : testIsNotValidCsrfWithInvalidToken
     * Description : Method to test invalid csrf token
     */
    public function testIsNotValidCsrfWithInvalidToken()
    {
        $this->assertFalse(
            Authentication::isValidCsrf('randomvalidcsrftoken', 'randominvalidcsrftoken')
        );
    }

    /**
     * Method : mysqlMockProvider
     * Description : Method to mock MySQL queries
     *
     * @dataProvider mysqlMockProvider
     */
    public function mysqlMockProvider(): array
    {
        $mockData = array(
            "SELECT * FROM `users` WHERE `email` = 'r@domain.com'" => array(
                'user_id' => 1,
                'name' => 'Ragina',
                'country' => 'in',
                'password' => '7cc573c138bf8f6e731d39b14b8b0aa31ec161bb',
                'email' => 'r@domain.com'
            ),
            "SELECT * FROM `users` WHERE `email` = 'ken@domain.com'" => array(
                'user_id' => 2,
                'name' => 'Ken',
                'country' => 'ug',
                'password' => '5d1c650af336dc19205c974f8f4ae1319c283a78',
                'email' => 'ken@domain.com'
            ),
            "SELECT * FROM `users` WHERE `user_id` = 1" => array(
                'user_id' => 1,
                'name' => 'Ragina',
                'country' => 'in',
                'password' => '7cc573c138bf8f6e731d39b14b8b0aa31ec161bb',
                'email' => 'r@domain.com'
            ),
            "SELECT * FROM `users` WHERE `user_id` = 2" => array(
                'user_id' => 2,
                'name' => 'Ken',
                'country' => 'ug',
                'password' => '5d1c650af336dc19205c974f8f4ae1319c283a78',
                'email' => 'ken@domain.com'
            ),
            "SELECT * FROM `user_session` WHERE `session_token` = '0e1461b241f9c30acd59a8161e6057f1'" => array(
                'user_id' => 1,
                'name' => 'Ragina',
                'country' => 'in',
                'email' => 'r@domain.com'
            ),
            "SELECT * FROM `user_session` WHERE `session_token` = '0e372a4f0447f221acdd37671fd3d3a3'" => array(
                'user_id' => 2,
                'name' => 'Ken',
                'country' => 'ug',
                'email' => 'ken@domain.com'
            ),
            "SELECT * FROM `user_session` WHERE `user_id` = 1" => array(
                'user_id' => 1,
                'name' => 'Ragina',
                'country' => 'in',
                'email' => 'r@domain.com'
            ),
            "SELECT * FROM `user_session` WHERE `user_id` = 2" => array(
                'user_id' => 2,
                'name' => 'Ken',
                'country' => 'ug',
                'email' => 'ken@domain.com'
            ),
            "UPDATE `user_session` SET `session_token` = ? WHERE `user_id` = 1" => array(
                'user_id' => 1
            ),
            "UPDATE `user_session` SET `session_token` = ? WHERE `user_id` = 2" => array(
                'user_id' => 2
            ),
            "INSERT INTO `user_session` (`session_token`, `user_id`) VALUES (?, 3)" => array(
                'user_id' => 3
            )
        );
        
        // for special queries where patterns need to be replaced with random values
        $replacePatterns = array(
            array(
                'pattern' => "/UPDATE `user_session` SET `session_token` = ('(.*)') WHERE `user_id` =/",
                'replace_with' => '?',
                'regex_reponse_index' => 1
            ),
            array(
                'pattern' => "/INSERT INTO `user_session` \(`session_token`, `user_id`\) VALUES \(('(.*)')/",
                'replace_with' => '?',
                'regex_reponse_index' => 1
            )
        );

        $databaseMock = $this->getMysqlWrapperMock($mockData, $replacePatterns);

        return [
            [$databaseMock]
        ];
    }
}
