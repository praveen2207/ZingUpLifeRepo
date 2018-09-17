<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Text Local SMS gateway
 */
class SMSGateway
{

    private $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    /**
     * Send SMS
     * @param $to
     * @param $sms_content
     * @return mixed
     */
    public function send_sms($to, $sms_content)
    {
        // Authorisation details.
        $this->CI->config->load('message');
        $username =  $this->CI->config->item('username');
        $hash =  $this->CI->config->item('hash');

        // Configuration variables. Consult http://api.textlocal.in/docs for more info.
        $test = "0";

        // Data for text message. This is the text message data.
        $sender = "ZINGUP"; // This is who the message appears to be from.
        $numbers = $to; // A single number or a comma-seperated list of numbers
        $message = $sms_content; // 612 chars or less
        $message = urlencode($message);
        $data = "username=" . $username . "&hash=" . $hash . "&message=" . $message . "&sender=" . $sender . "&numbers=" . $numbers . "&test=" . $test;

        $ch = curl_init('http://api.textlocal.in/send/?');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch); // This is the result from the API
        curl_close($ch);

        return $result;
    }

}