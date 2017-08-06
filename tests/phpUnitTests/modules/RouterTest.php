<?php
/**
 *
 * RouterTest.php is unit test file for Router module (modules/Router.php).
 *
 */
namespace Tests\FirstAide;

require_once str_replace('tests/phpUnitTests/modules', '', dirname(__FILE__)).'/includes/constants.php';

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
     * Method : assertIndexPage
     * Description : asserts for the contents in index page
     * @databaseMock MysqlDatabase : mock MysqlDatabase instance
     * @dataProvider mysqlMockProvider
     */
    private function assertIndexPage(
        MysqlDatabase $databaseMock,
        array $pageQueries
    ) {
        $counter = 0;
        $user_email = 'r@domain.com';
        $user = new User($databaseMock, $user_email);
        foreach ($pageQueries as $p) {
            $page_data = Router::getPage($user, $p['query']);

            $this->assertTrue(is_array($page_data));
            $this->assertArrayHasKey('found', $page_data);
            $this->assertArrayHasKey('javascripts', $page_data);
            $this->assertArrayHasKey('type', $page_data);
            $this->assertArrayHasKey('template', $page_data);

            $this->assertEquals($page_data['found'], $p['validity']);
            $this->assertTrue(is_array($page_data['javascripts']));
            $this->assertEquals($page_data['type'], 'index');
            $this->assertEquals($page_data['template'], Router::TEMPLATE_INDEX);
            $counter++;
        }

        $this->assertEquals(count($pageQueries), $counter);
    }

    /**
     * Method : testGetPageIndex
     * Description : tests for the index page
     * @databaseMock MysqlDatabase : mock MysqlDatabase instance
     * @dataProvider mysqlMockProvider
     */
    public function testGetPageIndex($databaseMock)
    {
        $this->assertIndexPage(
            $databaseMock,
            array(
                array(
                    'query' => Router::INDEX,
                    'validity' => true
                ),
                array(
                    'query' => 'randomNotExistingQuery',
                    'validity' => false
                )
            )
        );
    }

    /**
     * Method : testGetFullPage
     * Description : tests for the full card template content page
     * @databaseMock MysqlDatabase : mock MysqlDatabase instance
     * @dataProvider mysqlMockProvider
     */
    public function testGetFullPage($databaseMock)
    {
        $user_email = 'r@domain.com';
        $user = new User($databaseMock, $user_email);
        $page_data = Router::getPage($user, Router::HOME, Router::PAGE_SEEKING_STAFF_SUPPORT);

        $this->assertTrue(is_array($page_data));
        $this->assertArrayHasKey('found', $page_data);
        $this->assertArrayHasKey('javascripts', $page_data);
        $this->assertArrayHasKey('type', $page_data);
        $this->assertArrayHasKey('template', $page_data);
        $this->assertArrayHasKey('content', $page_data);

        $this->assertTrue($page_data['found']);
        $this->assertTrue(is_array($page_data['javascripts']));
        $this->assertEquals($page_data['type'], 'home');
        $this->assertEquals($page_data['content']['template'], Router::TEMPLATE_FULL_PAGE_CARD);
    }

    /**
     * Method : testGetMultiCardsPage
     * Description : tests for multi card template content page
     * @databaseMock MysqlDatabase : mock MysqlDatabase instance
     * @dataProvider mysqlMockProvider
     */
    public function testGetMultiCardsPage($databaseMock)
    {
        $user_email = 'r@domain.com';
        $user = new User($databaseMock, $user_email);
        $page_data = Router::getPage($user, Router::HOME, Router::PAGE_SEXUAL_PREDATORS);

        $this->assertTrue(is_array($page_data));
        $this->assertArrayHasKey('found', $page_data);
        $this->assertArrayHasKey('javascripts', $page_data);
        $this->assertArrayHasKey('type', $page_data);
        $this->assertArrayHasKey('template', $page_data);
        $this->assertArrayHasKey('content', $page_data);

        $this->assertTrue($page_data['found']);
        $this->assertTrue(is_array($page_data['javascripts']));
        $this->assertEquals($page_data['type'], 'home');
        $this->assertEquals($page_data['content']['template'], Router::TEMPLATE_MULTI_CARDS_PAGE);
    }

    /**
     * Method : testGetMultiSegmentPage
     * Description : tests for the multi segment template content page
     * @databaseMock MysqlDatabase : mock MysqlDatabase instance
     * @dataProvider mysqlMockProvider
     */
    public function testGetMultiSegmentPage($databaseMock)
    {
        $user_email = 'r@domain.com';
        $user = new User($databaseMock, $user_email);
        $page_data = Router::getPage($user, Router::HOME, Router::PAGE_COMMON_QUESTIONS);

        $this->assertTrue(is_array($page_data));
        $this->assertArrayHasKey('found', $page_data);
        $this->assertArrayHasKey('javascripts', $page_data);
        $this->assertArrayHasKey('type', $page_data);
        $this->assertArrayHasKey('template', $page_data);
        $this->assertArrayHasKey('content', $page_data);

        $this->assertTrue($page_data['found']);
        $this->assertTrue(is_array($page_data['javascripts']));
        $this->assertEquals($page_data['type'], 'home');
        $this->assertEquals($page_data['content']['template'], Router::TEMPLATE_MULTI_SEGMENT_PAGE);
    }

    /**
     * Method : testGetMultiSegmentVerticalPage
     * Description : tests for the multi segment vertical content page
     * @databaseMock MysqlDatabase : mock MysqlDatabase instance
     * @dataProvider mysqlMockProvider
     */
    public function testGetMultiSegmentVerticalPage($databaseMock)
    {
        $user_email = 'r@domain.com';
        $user = new User($databaseMock, $user_email);
        $page_data = Router::getPage($user, Router::HOME, Router::PAGE_MYTHBUSTERS);

        $this->assertTrue(is_array($page_data));
        $this->assertArrayHasKey('found', $page_data);
        $this->assertArrayHasKey('javascripts', $page_data);
        $this->assertArrayHasKey('type', $page_data);
        $this->assertArrayHasKey('template', $page_data);
        $this->assertArrayHasKey('content', $page_data);

        $this->assertTrue($page_data['found']);
        $this->assertTrue(is_array($page_data['javascripts']));
        $this->assertEquals($page_data['type'], 'home');
        $this->assertEquals($page_data['content']['template'], Router::TEMPLATE_MULTI_SELGMENT_VERTICAL);
    }

    /**
     * Method : testGetCircleOfTrustPage
     * Description : tests for the circle of trust template content page
     * @databaseMock MysqlDatabase : mock MysqlDatabase instance
     * @dataProvider mysqlMockProvider
     */
    public function testGetCircleOfTrustPage($databaseMock)
    {
        $user_email = 'r@domain.com';
        $user = new User($databaseMock, $user_email);
        $page_data = Router::getPage($user, Router::HOME, Router::PAGE_CIRCLE_OF_TRUST);

        $this->assertTrue(is_array($page_data));
        $this->assertArrayHasKey('found', $page_data);
        $this->assertArrayHasKey('javascripts', $page_data);
        $this->assertArrayHasKey('type', $page_data);
        $this->assertArrayHasKey('template', $page_data);
        $this->assertArrayHasKey('content', $page_data);

        $this->assertTrue($page_data['found']);
        $this->assertTrue(is_array($page_data['javascripts']));
        $this->assertEquals($page_data['type'], 'home');
        $this->assertEquals($page_data['content']['template'], Router::TEMPLATE_CIRCLE_OF_TRUST);
    }

    /**
     * Method : testGetHelpNowPage
     * Description : tests for the get help now template content page
     * @databaseMock MysqlDatabase : mock MysqlDatabase instance
     * @dataProvider mysqlMockProvider
     */
    public function testGetHelpNowPage($databaseMock)
    {
        $user_email = 'r@domain.com';
        $user = new User($databaseMock, $user_email);
        $page_data = Router::getPage($user, Router::HOME, Router::PAGE_GET_HELP_NOW);

        $this->assertTrue(is_array($page_data));
        $this->assertArrayHasKey('found', $page_data);
        $this->assertArrayHasKey('javascripts', $page_data);
        $this->assertArrayHasKey('type', $page_data);
        $this->assertArrayHasKey('template', $page_data);
        $this->assertArrayHasKey('content', $page_data);

        $this->assertTrue($page_data['found']);
        $this->assertTrue(is_array($page_data['javascripts']));
        $this->assertEquals($page_data['type'], 'home');
        $this->assertEquals($page_data['content']['template'], Router::TEMPLATE_PAGE);
    }

    /**
     * Method : testGetPageUrl
     * Description : tests for the page url generated by router
     * @databaseMock MysqlDatabase : mock MysqlDatabase instance
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
     * Method : mysqlMockProvider
     * Description : Method to mock MySQL queries
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
