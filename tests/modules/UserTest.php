<?php

namespace Tests\FirstAide;

use FirstAide\User;
use FirstAide\MysqlDatabase;
use PHPUnit\Framework\TestCase;
use Tests\MysqlWrapperMockTrait;

class UserTest extends TestCase
{
    use MysqlWrapperMockTrait;
    /**
     * @dataProvider mysqlMockProvider
     */
    public function testMultipleUsersWithEmail($databaseMock)
    {
        $this->assertUsersFound(
            $databaseMock,
            ['r@domain.com', 'ken@domain.com']
        );
    }

    private function assertUsersFound(
        MysqlDatabase $databaseMock,
        array $expectedUsers
    ) {
        // Arrange
        $userCounter = 0;
        foreach ($expectedUsers as $user_email) {
            $this->expectOutputString('');
            $user = new User($databaseMock, $user_email);
            $this->assertInstanceOf(User::class, $user);

            //$expectedUsers[$userCounter++];
            $this->assertEquals(
                $expectedUsers[$userCounter++],
                $user->getEmailAddress()
            );
        }

        $this->assertEquals(count($expectedUsers), $userCounter);
    }

    public function mysqlMockProvider(): array
    {
        $mockData = [
            "SELECT * FROM `users` WHERE `email` = 'r@domain.com'" => [
                ['user_id' => 1],
                ['name' => 'Ragina'],
                ['country' => 'India'],
                ['email' => 'r@domain.com']
            ],
            "SELECT * FROM `users` WHERE `email` = 'ken@domain.com'" => [
                ['user_id' => 2],
                ['name' => 'Ken'],
                ['country' => 'India'],
                ['email' => 'ken@domain.com']
            ]
        ];

        $databaseMock = $this->getMysqlWrapperMock($mockData);

        return [
            [$databaseMock]
        ];
    }
}
