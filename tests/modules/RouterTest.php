<?php
/**
 *
 * RouterTest.php is unit test file for Router module (modules/Router.php).
 *
 */
namespace Tests\FirstAide;

require_once str_replace('tests/modules', '', dirname(__FILE__)).'/includes/constants.php';

/**
 * Importing required modules/wrappers
 */
use FirstAide\User;
use FirstAide\Router;
use FirstAide\MysqlDatabase;
use PHPUnit\Framework\TestCase;
use Tests\MysqlWrapperMockTrait;

class RouterTest extends TestCase
{
    /**
     * Importing mock MySQL wrapper
     */
    use MysqlWrapperMockTrait;

    /**
     * @dataProvider mysqlMockProvider
     */
    public function testGetPage($databaseMock)
    {
        $user_email = 'r@domain.com';
        $user = new User($databaseMock, $user_email);
        $page_data = Router::getPage($user, Router::INDEX);

        $this->assertTrue(is_array($page_data));
        $this->assertArrayHasKey('found', $page_data);
        $this->assertArrayHasKey('javascripts', $page_data);
        $this->assertArrayHasKey('type', $page_data);
        $this->assertArrayHasKey('template', $page_data);

        $this->assertTrue($page_data['found']);
        $this->assertTrue(is_array($page_data['javascripts']));
        $this->assertEquals($page_data['type'] , 'index');
        $this->assertEquals($page_data['template'] , 'index.html');
    }

    /**
     * @dataProvider mysqlMockProvider
    */
    public function testGetPageUrl($databaseMock)
    {
        $page_url = Router::getPageUrl(
            Router::HOME,
            Router::PAGE_ADDED_SOON
        );
        $correct_page_url = HOST
            .'?'.Router::PAGE_REQUEST_PARAM.'='.Router::HOME
            .'&'.Router::PAGE_CONTENT.'='.Router::PAGE_ADDED_SOON;

        $this->assertEquals(
            $page_url,
            $correct_page_url
        );
    }

    /**
     * Mock MySQL Database query and its response
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
            ) 
        );

        $databaseMock = $this->getMysqlWrapperMock($mockData);

        return [
            [$databaseMock]
        ];
    }
}
