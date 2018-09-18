<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

/**
 * Keys Controller
 * This is a basic Key Management REST controller to make and delete keys
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Key extends REST_Controller {

    protected $methods = [
            'index_put' => ['level' => 10, 'limit' => 10],
            'index_delete' => ['level' => 10],
            'level_post' => ['level' => 10],
            'regenerate_post' => ['level' => 10],
        ];

    /**
     * Insert a key into the database
     *
     * @access public
     * @return void
     */
    public function index_put()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Key - index_put() called');
        // Build a new key
        $key = $this->_generate_key();

        // If no key level provided, provide a generic key
        $level = $this->put('level') ? $this->put('level') : 1;
        $ignore_limits = ctype_digit($this->put('ignore_limits')) ? (int) $this->put('ignore_limits') : 1;

        // Insert the new key
        if ($this->_insert_key($key, ['level' => $level, 'ignore_limits' => $ignore_limits]))
        {
            log_message('debug', 'Class: Key - index_put() new key inserted!');
            $this->response([
                'status' => TRUE,
                'key' => $key
            ], REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
        }
        else
        {
            log_message('debug', 'Class: Key - index_put() Could not save the key');
            $this->response([
                'status' => FALSE,
                'message' => 'Could not save the key'
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR); // INTERNAL_SERVER_ERROR (500) being the HTTP response code
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Key - index_put(). Total execution time: ' . $time_elapsed_secs);
    }

    /**
     * Remove a key from the database to stop it working
     *
     * @access public
     * @return void
     */
    public function index_delete()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Key - index_delete() called');
        $key = $this->delete('key');

        // Does this key exist?
        if (!$this->_key_exists($key))
        {
            // It doesn't appear the key exists
            log_message('debug', 'Class: Key - index_delete() Invalid API key');
            $this->response([
                'status' => FALSE,
                'message' => 'Invalid API key'
            ], REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // Destroy it
        $this->_delete_key($key);

        // Respond that the key was destroyed
        log_message('debug', 'Class: Key - index_delete() API key was deleted');
        $this->response([
            'status' => TRUE,
            'message' => 'API key was deleted'
            ], REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
            $time_elapsed_secs = microtime(true) - $start;
            log_message('debug', 'Class: Key - index_delete(). Total execution time: ' . $time_elapsed_secs);
    }

    /**
     * Change the level
     *
     * @access public
     * @return void
     */
    public function level_post()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Key - level_post() called');
        $key = $this->post('key');
        $new_level = $this->post('level');

        // Does this key exist?
        if (!$this->_key_exists($key))
        {
            // It doesn't appear the key exists
            log_message('debug', 'Class: Key - level_post() Invalid API key');
            $this->response([
                'status' => FALSE,
                'message' => 'Invalid API key'
            ], REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // Update the key level
        if ($this->_update_key($key, ['level' => $new_level]))
        {
            log_message('debug', 'Class: Key - level_post() API key was updated');
            $this->response([
                'status' => TRUE,
                'message' => 'API key was updated'
            ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            log_message('debug', 'Class: Key - level_post() Could not update the key level');
            $this->response([
                'status' => FALSE,
                'message' => 'Could not update the key level'
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR); // INTERNAL_SERVER_ERROR (500) being the HTTP response code
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Key - level_post(). Total execution time: ' . $time_elapsed_secs);
    }

    /**
     * Suspend a key
     *
     * @access public
     * @return void
     */
    public function suspend_post()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Key - suspend_post() called');
        $key = $this->post('key');

        // Does this key exist?
        if (!$this->_key_exists($key))
        {
            // It doesn't appear the key exists
            log_message('debug', 'Class: Key - suspend_post() Invalid API key');
            $this->response([
                'status' => FALSE,
                'message' => 'Invalid API key'
            ], REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // Update the key level
        if ($this->_update_key($key, ['level' => 0]))
        {
            log_message('debug', 'Class: Key - suspend_post() Key was suspended');
            $this->response([
                'status' => TRUE,
                'message' => 'Key was suspended'
            ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            log_message('debug', 'Class: Key - suspend_post() Could not suspend the user');
            $this->response([
                'status' => FALSE,
                'message' => 'Could not suspend the user'
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR); // INTERNAL_SERVER_ERROR (500) being the HTTP response code
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Key - suspend_post(). Total execution time: ' . $time_elapsed_secs);
    }

    /**
     * Regenerate a key
     *
     * @access public
     * @return void
     */
    public function regenerate_post()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Key - regenerate_post() called');
        $old_key = $this->post('key');
        $key_details = $this->_get_key($old_key);

        // Does this key exist?
        if (!$key_details)
        {
            // It doesn't appear the key exists
            log_message('debug', 'Class: Key - regenerate_post() Invalid API key');
            $this->response([
                'status' => FALSE,
                'message' => 'Invalid API key'
            ], REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // Build a new key
        $new_key = $this->_generate_key();

        // Insert the new key
        if ($this->_insert_key($new_key, ['level' => $key_details->level, 'ignore_limits' => $key_details->ignore_limits]))
        {
            // Suspend old key
            $this->_update_key($old_key, ['level' => 0]);
            log_message('debug', 'Class: Key - regenerate_post() new key generated');
            $this->response([
                'status' => TRUE,
                'key' => $new_key
            ], REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
        }
        else
        {
            log_message('debug', 'Class: Key - regenerate_post() Could not save the key');
            $this->response([
                'status' => FALSE,
                'message' => 'Could not save the key'
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR); // INTERNAL_SERVER_ERROR (500) being the HTTP response code
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Key - regenerate_post(). Total execution time: ' . $time_elapsed_secs);
    }

    /* Helper Methods */

    private function _generate_key()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Key - _generate_key() called');
        do
        {
            // Generate a random salt
            $salt = base_convert(bin2hex($this->security->get_random_bytes(64)), 16, 36);

            // If an error occurred, then fall back to the previous method
            if ($salt === FALSE)
            {
                $salt = hash('sha256', time() . mt_rand());
            }

            $new_key = substr($salt, 0, config_item('rest_key_length'));
        }
        while ($this->_key_exists($new_key));
        
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Key - _generate_key(). Total execution time: ' . $time_elapsed_secs); 
        
        return $new_key;
   }

    /* Private Data Methods */

    private function _get_key($key)
    {
        $start = microtime(true);
        log_message('debug', 'Class: Key - _get_key() called');
        return $this->rest->db
            ->where(config_item('rest_key_column'), $key)
            ->get(config_item('rest_keys_table'))
            ->row();
            $time_elapsed_secs = microtime(true) - $start;
            log_message('debug', 'Class: Key - _get_key(). Total execution time: ' . $time_elapsed_secs);
    }

    private function _key_exists($key)
    {
        $start = microtime(true);
        log_message('debug', 'Class: Key - _key_exists() called');
        return $this->rest->db
            ->where(config_item('rest_key_column'), $key)
            ->count_all_results(config_item('rest_keys_table')) > 0;
            $time_elapsed_secs = microtime(true) - $start;
            log_message('debug', 'Class: Key - _key_exists(). Total execution time: ' . $time_elapsed_secs);
    }

    private function _insert_key($key, $data)
    {
        $start = microtime(true);
        log_message('debug', 'Class: Key - _insert_key() called');
        $data[config_item('rest_key_column')] = $key;
        $data['date_created'] = function_exists('now') ? now() : time();

        return $this->rest->db
            ->set($data)
            ->insert(config_item('rest_keys_table'));
            $time_elapsed_secs = microtime(true) - $start;
            log_message('debug', 'Class: Key - _insert_key(). Total execution time: ' . $time_elapsed_secs);
    }

    private function _update_key($key, $data)
    {
        $start = microtime(true);
        log_message('debug', 'Class: Key - _update_key() called');
        return $this->rest->db
            ->where(config_item('rest_key_column'), $key)
            ->update(config_item('rest_keys_table'), $data);
            $time_elapsed_secs = microtime(true) - $start;
            log_message('debug', 'Class: Key - _update_key(). Total execution time: ' . $time_elapsed_secs);
    }

    private function _delete_key($key)
    {
        $start = microtime(true);
        log_message('debug', 'Class: Key - _delete_key() called');
        return $this->rest->db
            ->where(config_item('rest_key_column'), $key)
            ->delete(config_item('rest_keys_table'));
            $time_elapsed_secs = microtime(true) - $start;
            log_message('debug', 'Class: Key - _delete_key(). Total execution time: ' . $time_elapsed_secs);
    }

}
