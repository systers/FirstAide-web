<?php

namespace Tests\FirstAide;

use FirstAide\User;
use FirstAide\MysqlDatabase;
use PHPUnit\Framework\TestCase;
use Tests\MysqlWrapperMockTrait;

class UserTest extends TestCase
{
    use MysqlWrapperMockTrait;

    private function assertUsersFound(
        MysqlDatabase $databaseMock,
        array $expectedUsers
    ) {
        $userCounter = 0;
        foreach ($expectedUsers as $user) {
            $userObj = new User($databaseMock, $user['email']);
            $this->assertInstanceOf(User::class, $userObj);
            $this->assertEquals(
                $expectedUsers[$userCounter]['email'],
                $userObj->getEmailAddress()
            );
            $this->assertEquals(
                $expectedUsers[$userCounter]['name'],
                $userObj->getName()
            );
            $userCounter += 1;
        }

        $this->assertEquals(count($expectedUsers), $userCounter);
    }
    
    private function assertUsersFoundWithUserId(
        MysqlDatabase $databaseMock,
        array $expectedUsers
    ) {
        $userCounter = 0;
        foreach ($expectedUsers as $user) {
            $userObj = new User($databaseMock, '', $user['user_id']);
            $this->assertInstanceOf(User::class, $userObj);
            $this->assertEquals(
                $expectedUsers[$userCounter]['email'],
                $userObj->getEmailAddress()
            );
            $this->assertEquals(
                $expectedUsers[$userCounter]['name'],
                $userObj->getName()
            );
            $userCounter += 1;
        }

        $this->assertEquals(count($expectedUsers), $userCounter);
    }
    
    private function assertUsersNotFoundWithUserId(
        MysqlDatabase $databaseMock,
        array $expectedUsers
    ) {
        $userCounter = 0;
        foreach ($expectedUsers as $user) {
            $userObj = new User($databaseMock, '', $user['user_id']);
            $this->assertFalse($userObj->valid);
            $userCounter += 1;
        }

        $this->assertEquals(count($expectedUsers), $userCounter);
    }

    private function assertUsersNotFound(
        MysqlDatabase $databaseMock,
        array $expectedUsers
    ) {
        $userCounter = 0;
        foreach ($expectedUsers as $user) {
            $userObj = new User($databaseMock, $user['email']);
            $this->assertFalse($userObj->valid);
            $userCounter += 1;
        }

        $this->assertNotEquals(count($expectedUsers), 0);
    }

    private function assertCountryFound(
        MysqlDatabase $databaseMock,
        array $expectedUsers
    ) {
        $userCounter = 0;
        foreach ($expectedUsers as $user) {
            $userObj = new User($databaseMock, $user['email']);
            $this->assertInstanceOf(User::class, $userObj);
            $this->assertEquals(
                $expectedUsers[$userCounter]['email'],
                $userObj->getEmailAddress()
            );
            $this->assertEquals($userObj->getCurrentPostCountry(), $user['country']);
            $userCounter += 1;
        }

        $this->assertEquals(count($expectedUsers), $userCounter);
    }

    private function assertNewUserFound(
        MysqlDatabase $databaseMock,
        array $expectedUsers
    ) {
        $userCounter = 0;
        foreach ($expectedUsers as $user) {
            $userObj = new User($databaseMock, $user['email']);
            $this->assertInstanceOf(User::class, $userObj);
            $this->assertEquals($userObj->addUser($user), 1);
            $userCounter += 1;
        }

        $this->assertEquals(count($expectedUsers), $userCounter);
    }

    private function assertNewUserNotFound(
        MysqlDatabase $databaseMock,
        array $expectedUsers
    ) {
        $userCounter = 0;
        foreach ($expectedUsers as $user) {
            $userObj = new User($databaseMock, $user['email']);
            $this->assertInstanceOf(User::class, $userObj);
            $this->assertFalse($userObj->addUser($user));
            $userCounter += 1;
        }

        $this->assertEquals(count($expectedUsers), $userCounter);
    }

    private function assertUserValidity(
        MysqlDatabase $databaseMock,
        array $expectedUsers
    ) {
        $userCounter = 0;
        foreach ($expectedUsers as $user) {
            $userObj = new User($databaseMock, $user['email']);
            $this->assertInstanceOf(User::class, $userObj);
            $this->assertTrue($userObj->validateCredentials($user['password']));
            $userCounter += 1;
        }

        $this->assertEquals(count($expectedUsers), $userCounter);
    }

    private function assertCircleOfTrustFound(
        MysqlDatabase $databaseMock,
        array $expectedUsers
    ) {
        $userCounter = 0;
        foreach ($expectedUsers as $user) {
            $userObj = new User($databaseMock, $user['email']);
            $this->assertInstanceOf(User::class, $userObj);
            $this->assertTrue(is_array($userObj->getCircleOfTrust()));
            $userCounter += 1;
        }

        $this->assertEquals(count($expectedUsers), $userCounter);
    }

    private function assertCircleOfTrustUpdated(
        MysqlDatabase $databaseMock,
        array $expectedUsers
    ) {
        $userCounter = 0;
        foreach ($expectedUsers as $user) {
            $userObj = new User($databaseMock, $user['email']);
            $this->assertInstanceOf(User::class, $userObj);
            $updatedResponse = $userObj->updateCircleOfTrust($user['comrades']);
            $this->assertTrue($updatedResponse['response']);
            $userCounter += 1;
        }

        $this->assertEquals(count($expectedUsers), $userCounter);
    }

    /**
     * @dataProvider mysqlMockProvider
     */
    public function testMultipleUsersWithEmail($databaseMock)
    {
        $this->assertUsersFound(
            $databaseMock,
            array(
                array(
                    'email' => 'r@domain.com',
                    'name' => 'Ragina'
                ),
                array(
                    'email' => 'ken@domain.com',
                    'name' => 'Ken'
                )
            )
        );
    }

    /**
     * @dataProvider mysqlMockProvider
     */
    public function testMultipleUsersWithInvalidData($databaseMock)
    {
        $this->assertUsersNotFound(
            $databaseMock,
            array(
                array(
                    'email' => 'r3@domain.com',
                    'name' => 'Ragina'
                ),
                array(
                    'email' => 'kfen@domain.com',
                    'name' => 'Ken'
                ),
                array(
                    'email' => 'kfendomain.com',
                    'name' => 'kh23'
                )
            )
        );
    }

    /**
     * @dataProvider mysqlMockProvider
     */
    public function testMultipleUsersWithUserId($databaseMock)
    {
        $this->assertUsersFoundWithUserId(
            $databaseMock,
            array(
                array(
                    'user_id' => 1,
                    'email' => 'r@domain.com',
                    'name' => 'Ragina'
                ),
                array(
                    'user_id' => 2,
                    'email' => 'ken@domain.com',
                    'name' => 'Ken'
                )
            )
        );
    }

    /**
     * @dataProvider mysqlMockProvider
     */
    public function testMultipleUsersWithInvalidUserId($databaseMock)
    {
        $this->assertUsersNotFoundWithUserId(
            $databaseMock,
            array(
                array(
                    'user_id' => -1,
                    'email' => 'r@domain.com'
                ),
                array(
                    'user_id' => -2,
                    'email' => 'ken@domain.com'
                )
            )
        );
    }

    /**
     * @dataProvider mysqlMockProvider
    */
    public function testCurrentPostCountry($databaseMock)
    {
        $this->assertCountryFound(
            $databaseMock,
            array(
                array(
                    'email' => 'r@domain.com',
                    'country' => 'India'
                ),
                array(
                    'email' => 'ken@domain.com',
                    'country' => 'Uganda'
                )
            )
        );
    }

    /**
     * @dataProvider mysqlMockProvider
    */
    public function testAddUser($databaseMock)
    {
        $this->assertNewUserFound(
            $databaseMock,
            array(
                array(
                    'email' => 'r@domain.com',
                    'name' => 'Ragina',
                    'password' => 'dummypassword',
                    'country' => 'in'
                )
            )
        );
    }

    /**
     * @dataProvider mysqlMockProvider
    */
    public function testAddUserWithInvalidData($databaseMock)
    {
        $this->assertNewUserNotFound(
            $databaseMock,
            array(
                array(
                    'email' => 'r@domain.com',
                    'password' => 'dummypassword',
                    'country' => 'in'
                ),
                array(
                    'email' => 'r@domain.com',
                    'name' => 'Ragina',
                    'country' => 'in'
                ),
                array(
                    'email' => 'r@domain.com',
                    'name' => 'Ragina',
                    'password' => 'dummypassword',
                )
            )
        );
    }

    /**
     * @dataProvider mysqlMockProvider
    */
    public function testValidCredentials($databaseMock)
    {
        $this->assertUserValidity(
            $databaseMock,
            array(
                array(
                    'email' => 'r@domain.com',
                    'password' => 'dummypassword'
                ),
                array(
                    'email' => 'ken@domain.com',
                    'password' => 'dummypassword2'
                )
            )
        );
    }

    /**
     * @dataProvider mysqlMockProvider
    */
    public function testGetCircleOfTrust($databaseMock)
    {
        $this->assertCircleOfTrustFound(
            $databaseMock,
            array(
                array(
                    'email' => 'r@domain.com',
                    'password' => 'dummypassword'
                ),
                array(
                    'email' => 'ken@domain.com',
                    'password' => 'dummypassword2'
                )
            )
        );
    }

    /**
     * @dataProvider mysqlMockProvider
    */
    public function testUpdateCircleOfTrust($databaseMock)
    {
        $this->assertCircleOfTrustUpdated(
            $databaseMock,
            array(
                array(
                    'email' => 'r@domain.com',
                    'comrades' => array('919999999999', '918999999999')
                ),
                array(
                    'email' => 'ken@domain.com',
                    'comrades' => array('917999999999', '918899999999')
                )
            )
        );
    }


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
            "SELECT `country` FROM `users` WHERE `email` = 'r@domain.com'" => array(
                'country' => 'in'
            ),
            "SELECT `country` FROM `users` WHERE `email` = 'ken@domain.com'" => array(
                'country' => 'ug'
            ),
            "INSERT INTO `users` (`email`, `name`, `password`, `username`, `country`) VALUES ('r@domain.com', 'Ragina', '7cc573c138bf8f6e731d39b14b8b0aa31ec161bb', 'ragina', 'in')" => array(
                'user_id' => 3
            ),
            "SELECT * FROM `comrades` WHERE `user_id` = 1" => array(
                'user_id' => 1,
                'comrade_details' => '919999999999, 918999999999'
            ),
            "SELECT * FROM `comrades` WHERE `user_id` = 2" => array(
                'user_id' => 1,
                'comrade_details' => '917999999999, 918899999999'
            )
        );

        $databaseMock = $this->getMysqlWrapperMock($mockData);

        return [
            [$databaseMock]
        ];
    }
}
