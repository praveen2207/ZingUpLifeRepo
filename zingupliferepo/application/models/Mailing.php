<?php

/**
 * This class for sending mail and sms
 * 
 * @author vikrant <vikrant@nuvodev.com>
 * 
 * Date:04-08-2015
 * 
 * */
class Mailing extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    /*
     * Function to send all mails 
     */

    public function send_mail($to, $from, $subject, $message) {
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;

        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");
        $this->email->from($from, 'Zinguplife');
        $this->email->to($to);
        //$this->email->to('vikrant@nuvodev.com');
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
    }

    /* Above function ends here */

    /*
     * Function to send all mails 
     */

    public function send_sms($to, $sms_content) {
        // Authorisation details.
        $this->config->load('message');
        $username = $this->config->item('username');
        $hash = $this->config->item('hash');

        // Configuration variables. Consult http://api.textlocal.in/docs for more info.
        $test = "0";

        // Data for text message. This is the text message data.
        $sender = "ZINGUP"; // This is who the message appears to be from.
        $numbers = $to; // A single number or a comma-seperated list of numbers
        //$numbers = "9066295418";
        // $sender = urlencode($sender); 
        $message = $sms_content;
        // 612 chars or less
        // A single number or a comma-seperated list of numbers
        $message = urlencode($message);
        $data = "username=" . $username . "&hash=" . $hash . "&message=" . $message . "&sender=" . $sender . "&numbers=" . $numbers . "&test=" . $test;
        $ch = curl_init('http://api.textlocal.in/send/?');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch); // This is the result from the API
        curl_close($ch);
        //echo $result;
        // Process your response here
    }

    /* Above function ends here */
}
