<?php

class FCM
{
    // Google Firebase app api key (provided on firebase console setting)
    const API_KEY = "AIzaSyD8cMN8w1Km_0CGHXL3w67ljRYoUveBqqI";

    /**
     * Send FCM token
     * @param $registration_ids
     * @param $title
     * @param string $body
     * @param array $data
     * @return mixed
     */

    public function send($registration_ids, $title, $body = "", $data = [])
    {
        // convert string into array
        $registration_ids = is_array($registration_ids) ? $registration_ids : [$registration_ids];

        $api_key = self::API_KEY;

        $postData = array(
            "registration_ids" => $registration_ids,
            "notification" => array(
                "title" => $title,
                "body" => $body
            ),
            "data" => $data
        );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_POST, 1);

        $headers = array();
        $headers[] = "Authorization: key=$api_key";
        $headers[] = "Content-Type: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            $fcmError =  'Error:' . curl_error($ch);
            log_message('debug', $fcmError);
        }
        curl_close($ch);

        return $result;
    }
}