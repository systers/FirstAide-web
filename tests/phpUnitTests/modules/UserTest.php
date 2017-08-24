<?php
/**
 *
 * UserTest.php is unit test file for User module (modules/User.php).
 *
 */

namespace Tests\FirstAide;

/**
 * Importing required modules/wrappers
 */
use FirstAide\User;
use FirstAide\MysqlDatabase;
use PHPUnit\Framework\TestCase;
use Tests\MysqlWrapperMockTrait;

class UserTest extends TestCase
{
    /**
     * Importing mock MySQL wrapper
     */
    use MysqlWrapperMockTrait;

    /**
     * Method to assert if user object was found with valid user emails
     */
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
    
    /**
     * Method to assert if user object were found with valid User ID
     */
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

    /**
     * Method to assert if user object was not found with invalid user_id
     */
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

    /**
     * Method to assert if user object was not found with invalid user emails
     */
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

    /**
     * Method to assert if users' current country post is found
     */
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

    /**
     * Method to assert if new user is added
     */
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

    /**
     * Method to assert if new users are not added with invalid data
     */
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

    /**
     * Method to assert if user credentials are valid
     */
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

    /**
     * Method to assert if valid comrade details for Circle of Trust found
     */
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

    /**
     * Method to assert if valid updation of Comrade Details in Circle of Trust
     */
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
     * Method : assertUserInfoUpdatedWithValidData
     * Description : asserts for testing user data if it gets updated or not with valid data
     * @databaseMock MysqlDatabase : mock MysqlDatabase instance
     * @dataProvider mysqlMockProvider
     */
    private function assertUserInfoUpdatedWithValidData(
        MysqlDatabase $databaseMock,
        array $expectedUsers
    ) {
        $userCounter = 0;
        foreach ($expectedUsers as $user) {
            $userObj = new User($databaseMock, $user['email']);
            $this->assertInstanceOf(User::class, $userObj);
            $updatedResponse = $userObj->updateUserInfo($user);
            $this->assertTrue($updatedResponse['response']);
            $this->assertTrue($updatedResponse['reload']);
            $userCounter += 1;
        }

        $this->assertEquals(count($expectedUsers), $userCounter);
    }


    /**
     * Method : assertUserInfoUpdatedWithInvalidData
     * Description : asserts for testing user data if it gets updated or not with invalid data
     * @databaseMock MysqlDatabase : mock MysqlDatabase instance
     * @dataProvider mysqlMockProvider
     */
    private function assertUserInfoUpdatedWithInvalidData(
        MysqlDatabase $databaseMock,
        array $expectedUsers
    ) {
        $userCounter = 0;
        foreach ($expectedUsers as $user) {
            $userObj = new User($databaseMock, $user['email']);
            $this->assertInstanceOf(User::class, $userObj);
            $updatedResponse = $userObj->updateUserInfo($user);
            $this->assertFalse($updatedResponse['response']);
            $this->assertTrue($updatedResponse['reload']);
            $userCounter += 1;
        }

        $this->assertEquals(count($expectedUsers), $userCounter);
    }

    /**
     * Tests for multiple user objects with email
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
     * Tests for multiple user objects with invalid credentials
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
     * Tests for multiple user objects with user_id
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
     * Tests for multiple user objects with invalid user_id
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
     * Tests for users' post country validity for multiple user objects
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
     * Tests for add user functionality
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
     * Tests for add user functionality with invalid data
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
     * Tests for comrade details of circle of Trust functionality
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
     * Tests for Update circle of Trust functionality
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

    /**
     * Method : testUpdatedUserInfoWithValidData
     * Description : Method to test user information with valid credentials
     * @databaseMock MysqlDatabase : mock MysqlDatabase instance
     * @dataProvider mysqlMockProvider
     */
    public function testUpdatedUserInfoWithValidData($databaseMock)
    {
        $this->assertUserInfoUpdatedWithValidData(
            $databaseMock,
            array(
                array(
                    'email' => 'r@domain.com',
                    'name' => 'ragina',
                    'password' => 'newdummypassword',
                    'country' => 'ug'
                ),
                array(
                    'email' => 'ken@domain.com',
                    'name' => 'KenAdams',
                    'password' => 'newdummypassword',
                    'country' => 'in'
                )
            )
        );
    }

    /**
     * Method : testUpdatedUserInfoWithInalidData
     * Description : Method to test user information with invalid credentials
     * @databaseMock MysqlDatabase : mock MysqlDatabase instance
     * @dataProvider mysqlMockProvider
     */
    public function testUpdatedUserInfoWithInvalidData($databaseMock)
    {
        $this->assertUserInfoUpdatedWithInvalidData(
            $databaseMock,
            array(
                array(
                    'email' => 'ken@domain.com',
                    'password' => 'newdummypassword',
                    'country' => 'in'
                ),

                array(
                    'email' => 'r@domain.com',
                    'name' => 'ragina',
                    'country' => 'ug'
                ),
                array(
                    'email' => 'ken@domain.com',
                    'name' => 'KenAdams',
                    'password' => 'newdummypassword'
                )
            )
        );
    }

    /**
     * Mock MySQL Database queries and their responses for user module
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
            "SELECT `country` FROM `users` WHERE `email` = 'r@domain.com'" => array(
                'country' => 'in'
            ),
            "SELECT `country` FROM `users` WHERE `email` = 'ken@domain.com'" => array(
                'country' => 'ug'
            ),
            "INSERT INTO `users` (`email`, `name`, `password`, `country`) VALUES ('r@domain.com', 'Ragina', '7cc573c138bf8f6e731d39b14b8b0aa31ec161bb', 'in')" => array(
                'user_id' => 3
            ),
            "SELECT * FROM `comrades` WHERE `user_id` = 1" => array(
                'user_id' => 1,
                'comrade_details' => '919999999999, 918999999999'
            ),
            "SELECT * FROM `comrades` WHERE `user_id` = 2" => array(
                'user_id' => 1,
                'comrade_details' => '917999999999, 918899999999'
            ),
            "UPDATE `users` SET `name` = 'ragina', `country` = 'al', `password` = '7cc573c138bf8f6e731d39b14b8b0aa31ec161bb' WHERE `user_id` = 1" => array(
                'user_id' => 1
            ),
            "UPDATE `users` SET `name` = 'KenAdams', `country` = 'in', `password` = '7cc573c138bf8f6e731d39b14b8b0aa31ec161bb' WHERE `user_id` = 2" => array(
                'user_id' => 2
            )
        );

        $databaseMock = $this->getMysqlWrapperMock($mockData);

        return [
            [$databaseMock]
        ];
    }
}
