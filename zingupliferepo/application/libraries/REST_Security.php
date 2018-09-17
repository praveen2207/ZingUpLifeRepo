<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Security
 * RestFull API header Bearer authentication
 * Include security_token(varchar, 255), security_token_expire(datetime) column in user table
 */
class REST_Security
{
    const API_SECURITY_TOKEN = "201A78C1-46A2-E9BB-299D-17A9603B1DC4";
    private $CI;
    private $current_user;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('User');
        $this->current_user = null;
        $this->auth();
    }

    /**
     * Get hearder Authorization
     * */
    private function getAuthorizationHeader()
    {
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }

    /**
     * Get access token from header
     * */
    public function getToken()
    {
        $headers = $this->getAuthorizationHeader();
        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }

    public function auth()
    {

        $token = $this->getToken();

        if (empty($token)) {
            header("HTTP/1.1 401 Unauthorized");
            exit;
        }

        if ($token == self::API_SECURITY_TOKEN) {
            // valid API access but not an registered user
            return $this;
        } else {
            // Is registered authenticated user
            $user = $this->CI->User->get_user_by_security_token($token);
            if ($user) {
                // User with security token exist
                $security_token_expire = $user->security_token_expire;
                $now = new DateTime('now');
                $token_valid_datetime = new DateTime($security_token_expire);
                if ($now <= $token_valid_datetime) {
                    // Valid user
                    $this->current_user = $user;
                    return $user;
                } else {
                    header("HTTP/1.1 403 Forbidden");
                    exit;
                }
            } else {
                header("HTTP/1.1 401 Unauthorized");
                exit;
            }
        }

        header("HTTP/1.1 500");
        exit;
    }

    /**
     * Get current login user
     * @return mixed
     */
    public function getUser()
    {
        return $this->current_user;

    }

    /**
     * Get security token expire date time
     * @return string
     */
    public function getSecurityTokenExpire($days)
    {
        $currentDateObj = new \DateTime();
        return $currentDateObj->modify("+" . $days . " day")->format('Y-m-d H:i:s');
    }

    /**
     * Generate and Validates a generated token is unique for user.
     * @return string
     */
    public function generateSecurityToken()
    {
        $guidToken = $this->getGuidToken();

        // Verify if this token is unique across users.
        $user = $this->CI->User->get_user_by_security_token($guidToken);

        if ($user) {
            // Call self function recursively if generated token already assigned
            // to any other user.
            $this->getSecurityTokenExpire();
        }
        // Token is unique, return.
        return $guidToken;
    }


    /**
     *  Generates a Random Unique GUID token.
     * @param bool $opt
     * @return string
     */
    public function getGuidToken($opt = false)
    {
        if (function_exists('com_create_guid')) {
            if ($opt) {
                return com_create_guid();
            } else {
                return trim(com_create_guid(), '{}');
            }
        } else {
            mt_srand((double)microtime() * 10000);    // optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);    // "-"
            $left_curly = $opt ? chr(123) : "";     //  "{"
            $right_curly = $opt ? chr(125) : "";    //  "}"
            $uuid = $left_curly
                . substr($charid, 0, 8) . $hyphen
                . substr($charid, 8, 4) . $hyphen
                . substr($charid, 12, 4) . $hyphen
                . substr($charid, 16, 4) . $hyphen
                . substr($charid, 20, 12)
                . $right_curly;
            return $uuid;
        }
    }

    /**
     * Generates 4 digit OTP for user passwordtoken.
     * @param $field
     * @return int
     */
    public function generateOTPTokenForUser($field)
    {

        $otpToken = rand(1111, 9999);

        // Verify if this token is unique across users.
        $user = $this->CI->User->get_user_by_otp($otpToken, $field);

        if ($user) {
            // Call self function recursively if generated token already assigned
            // to any other user.
            $this->generateOTPTokenForUser();
        }

        // Token is unique, return.
        return $otpToken;
    }
}