<?php
namespace FirstAide;

namespace FirstAide;

use Twilio\Rest\Client;

class Notification
{
    private $account_sid;
    private $auth_token;
    private $from_number;

    public function __construct()
    {
        global $_settings;
        $this->account_sid = $_settings['twilio']['account_sid'];
        $this->auth_token = $_settings['twilio']['auth_token'];
        $this->from_number = $_settings['twilio']['number'];
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

            $var = $client->messages->create(
                $number,
                array(
                    // A Twilio phone number you purchased at twilio.com/console
                    'from' => $this->from_number,
                    // the body of the text message you'd like to send
                    'body' => $msg
                )
            );
            $r['response'] = true;
            $r['message'] = 'The sms has been sent.';
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
