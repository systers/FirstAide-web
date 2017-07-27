<?php
/**
 *
 * NotificationTest.php is unit test file for Notification module (modules/Notification.php).
 *
 */
namespace Tests\FirstAide;
$APPLICATION_DIR = str_replace('tests/modules', '', dirname(__FILE__));
require_once $APPLICATION_DIR.'/includes/settings.php';

/**
 * Importing required modules/wrappers
 */
use FirstAide\Notification;
use PHPUnit\Framework\TestCase;

class NotificationTest extends TestCase
{
    /**
     * Method : testGetFullPage
     * Description : tests for the full card template content page
     */
    public function testSendSms()
    {
        $notification = new Notification(Notification::USE_TEST_CREDENTIALS);
        $sendNotificationRespose = $notification->sendSms('+910000000000', 'Test message');
        $this->assertTrue($sendNotificationRespose['response']);
    }

    /**
     * Method : testGetFullPage
     * Description : tests for the full card template content page
     */
    public function testSendMultipleSms()
    {
        $arrayOfTestNumbers = array(
            '+910000000000',
            '+15005550006'
        );
        $notification = new Notification(Notification::USE_TEST_CREDENTIALS);
        $sendNotificationRespose = $notification->sendMultipleSms($arrayOfTestNumbers, 'Test message');
        $this->assertTrue($sendNotificationRespose['response']);
    }
}
