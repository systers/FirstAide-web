<?php

namespace FirstAide;

use Twilio\Rest\Client;

class Notification
{
    private $account_sid;
    private $auth_token;
    private $from_number;

    const USE_TEST_CREDENTIALS = 'test';

    public static $messages = array(
        'come_get_me' => 'Come and get me.I need help getting home safely.',
        'need_interruption' => 'Call and pretend you need me. I need an interruption.',
        'need_to_talk' => 'I need to talk.'
    );

    /**
     * Method : __construct
     * Description : constructor for initialising credentials
     * @useCredentials string : defines which credentials to be used (test or live)
     */
    public function __construct($useCredentials = '')
    {
        global $_settings;
        if ($useCredentials == self::USE_TEST_CREDENTIALS) {
            $this->account_sid = $_settings['twilio']['test_account_sid'];
            $this->auth_token = $_settings['twilio']['test_auth_token'];
            $this->from_number = $_settings['twilio']['test_number'];
        } else {
            $this->account_sid = $_settings['twilio']['account_sid'];
            $this->auth_token = $_settings['twilio']['auth_token'];
            $this->from_number = $_settings['twilio']['number'];
        }
    }

    /**
     * Method : sendSms
     * Description : sends sms to comrade numbers with the desired message
     * @number string : The numbers to which the message needs to sent
     * @msg string : The message that needs to be sent in the sms
     */
    public function sendSms($number, $msg)
    {
        $r = array(
            'response' => false,
            'message' => ''
        );
        if (empty($number)) {
            $r['message'] = 'Please provide a valid number to send message.';
        } elseif (empty($msg)) {
            $r['message'] = 'Please provide a valid message.';
        } else {
            $client = new Client($this->account_sid, $this->auth_token);

            $twilioResponse = $client->messages->create(
                $number,
                array(
                    // A Twilio phone number purchased by the user at twilio.com/console
                    'from' => $this->from_number,
                    // The body of the text message, the logged in user would send to other comrades.
                    'body' => $msg
                )
            );
            if ($twilioResponse->status == 'queued' && empty($twilioResponse->errorCode)) {
                $r['response'] = true;
                $r['message'] = 'The sms has been sent.';
            }
        }
        return $r;
    }

    /**
     * Method : sendMultipleSms
     * Description : sends sms to multiple numbers with the desired message
     * @number string : The numbers to which the message needs to sent
     * @msg string : The message that needs to be sent in the sms
     */
    public function sendMultipleSms($numbers, $msg)
    {
        $r = array(
            'response' => false,
            'message' => ''
        );
        if (!is_array($numbers)) {
            $r['message'] = 'Please provide valid numbers to send message.';
        } elseif (empty($msg)) {
            $r['message'] = 'Please provide a valid message.';
        } else {
            foreach ($numbers as $n) {
                $smsStatus = $this->sendSms($n, $msg);
                if (!$smsStatus['response']) {
                    return $smsStatus;
                }
            }
            $r['response'] = true;
            $r['message'] = 'The sms have been sent.';
        }
        return $r;
    }
}
