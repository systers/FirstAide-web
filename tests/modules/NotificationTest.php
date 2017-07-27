<?php
/**
 *
 * NotificationTest.php is unit test file for Notification module (modules/Notification.php).
 *
 */
namespace Tests\FirstAide;

require_once str_replace('tests/modules', '', dirname(__FILE__)).'/includes/settings.php';

/**
 * Importing required modules/wrappers
 */
use FirstAide\Notification;
use PHPUnit\Framework\TestCase;

class NotificationTest extends TestCase
{
    /**
     * Method : testSendSms
     * Description : test to check of the response for sending a sms is a success
     */
    public function testSendSms()
    {
        $notification = new Notification(Notification::USE_TEST_CREDENTIALS);
        $sendNotificationRespose = $notification->sendSms('+910000000000', 'Test message');
        $this->assertTrue($sendNotificationRespose['response']);
    }

    /**
     * Method : testSendMultipleSms
     * Description : tests for checking sms sent to multiple numbers
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
