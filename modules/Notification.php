<?php

namespace FirstAide;

use Twilio\Rest\Client;

class Notification
{
    private $account_sid;
    private $auth_token;
    private $from_number;

    const USE_TEST_CREDENTIALS = 'test';

    public function __construct($credentials = '')
    {
        global $_settings;
        if ($credentials == self::USE_TEST_CREDENTIALS) {
            $this->account_sid = $_settings['twilio']['test_account_sid'];
            $this->auth_token = $_settings['twilio']['test_auth_token'];
            $this->from_number = $_settings['twilio']['test_number'];
        } else {
            $this->account_sid = $_settings['twilio']['account_sid'];
            $this->auth_token = $_settings['twilio']['auth_token'];
            $this->from_number = $_settings['twilio']['number'];
        }
    }

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
                    // A Twilio phone number you purchased at twilio.com/console
                    'from' => $this->from_number,
                    // the body of the text message you'd like to send
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
