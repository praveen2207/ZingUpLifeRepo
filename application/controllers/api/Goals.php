<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Goals extends REST_Controller
{

    protected $current_user = null;
    public $timezone;
    function __construct()
    {
        parent::__construct();

        $this->load->model('user');

        $this->load->library('REST_Security');
        $this->current_user = $this->rest_security->getUser();

        $this->methods['index_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['index_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['index_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('Goalapi_model');
	    $this->load->helper('event_service_helper');
    	$this->timezone = date('Y-m-d\TH:i:s\Z', time());//new MongoDate(time());//date("Y-m-d\TH:i:s\Z");//2017-03-14T21:16:00Z
        $this->load->helper('functions');
    }

    public function index_get()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Goals - index_get() called');
        $this->GoalApi_model->goal_type = $this->get('type');
        $goals = $this->Goalapi_model->getGoals();
        if (!empty($goals)) {
            log_message('debug', 'Class: Goals - index_get() $response');
            $this->set_response($goals, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            log_message('debug', 'Class: Goals - index_get()  Goals could not be found');
            $this->set_response([
                'status' => FALSE,
                'message' => 'Goals could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Goals - index_get(). Total execution time: ' . $time_elapsed_secs);
    }

    //---------------------------------------------------------------------------------
    public function mydiary_get()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Goals - mydiary_get() called');
        $this->Goalapi_model->goal_type = $this->get('type');
        $goals = $this->Goalapi_model->getMyGoals();

        if (!empty($goals)) {
            log_message('debug', 'Class: Goals - mydiary_get() $response');
            $this->set_response($goals, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            log_message('debug', 'Class: Goals - mydiary_get() Goals could not be found');
            $this->set_response([
                'status' => FALSE,
                'message' => 'Goals could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Goals - mydiary_get(). Total execution time: ' . $time_elapsed_secs);
    }
    //---------------------------------------------------------------------------------
    //fetching user based on user.

    /*parameters of MyGoals  API
        
    */
    /* public function MyGoals_get()
     {
         $id =    $this->current_user->id;

                  $this->GoalApi_model->goal_type  = $this->get();
         $goals = $this->Goalapi_model->MyGoals($id);
         if (!empty($goals))
         {
                  $this->set_response($goals, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
         }else{
             $this->set_response([
                 'status' => FALSE,
                 'message' => 'Goals could not be found'
             ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
         }

     }*/
    /*---------------adding user goals to cart ---------------adding user goals to cart***/

    public function goal_adding_post()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Goals - goal_adding_post() called');
        if (empty($this->current_user)) {
            log_message('debug', 'Class: Goals - goal_adding_post() there is no user details');
            $this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
        } else {
            $id = $this->current_user->id;
            $post_data = $this->request->body;
            
            $shareable = $post_data["shareable"];
            $goal_id = isset($post_data['goal_id'])?$post_data['goal_id']:null;
            if(empty($goal_id)){
                log_message('debug', 'Class: Goals - goal_adding_post() Goal id is missing');
                $this->set_response([
                    'status' => false,
                    'message' => 'Goal id is missing!'
                ], REST_Controller::HTTP_OK);
            }
            
            
            
            $goals = $this->Goalapi_model->goal_adding($goal_id, $id, $shareable,$post_data);
            $user_diary = $this->Goalapi_model->get_user_diary_id($goal_id, $id);
            $user_diary_id = $user_diary[0]->user_diary_id;
            if($goals == TRUE){
                
                $goal_added_string = 'event_type=GOAL_ADDED,goalID='.$goal_id.',user_diary_id='.$user_diary_id.',timestamp='.$this->timezone.',userID='.$id;
                event_service($goal_added_string);
                log_message('debug', 'goal_adding_post() $response for USER ID :'.$id);
                $this->set_response([
                    'status' => TRUE,
                    'message' => 'Goal added successfully to user diary'
                ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
                
            }
            
            if($goals == FALSE){
                log_message('debug', 'goal_adding_post() Goal id is already added.');
                $this->set_response([
                    'status' => false,
                    'message' => 'This Goal id is already added.'
                ], REST_Controller::HTTP_OK);
            }
            
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Goals - goal_adding_post(). Total execution time: ' . $time_elapsed_secs);
    }

    /*----------------user goals-----------------*/
    public function my_goals_get()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Goals - my_goals_get() called');
        if (empty($this->current_user)) {
            log_message('debug', 'Class: Goals - my_goals_get() there is no user details');
            $this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
        } else {
            $con_user_id = $this->current_user->id;
            if (empty($con_user_id)) {
                log_message('debug', 'Class: Goals - my_goals_get() goal not added for USER ID:'.$con_user_id);
                $this->set_response([
                    'status' => FALSE,
                ], REST_Controller::HTTP_FORBIDDEN);
            } else {
                $response = $this->Goalapi_model->MyGoals($con_user_id);
                log_message('debug', 'Class: Goals - my_goals_get() $response for USER ID :'.$con_user_id);
                $this->set_response($response, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code

            }
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Goals - my_goals_get(). Total execution time: ' . $time_elapsed_secs);
    }

   
    /*----------------shared goals from my account-----------------*/
    public function my_shared_goals_get()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Goals - my_shared_goals_get() called');
        if (empty($this->current_user)) {
            log_message('debug', 'Class: Goals - my_shared_goals_get() there is no user details');
            $this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
        } else {
            $con_user_id = $this->current_user->id;
            if (empty($con_user_id)) {
                log_message('debug', 'Class: Goals - my_shared_goals_get() user_id is empty');
                $this->set_response([
                    'status' => FALSE,
                ], REST_Controller::HTTP_FORBIDDEN);
            } else {
                $response = $this->Goalapi_model->my_shared_goals_list($con_user_id);
                log_message('debug', 'Class: Goals - my_shared_goals_get() $response for USER ID :'.$con_user_id);
                $this->set_response($response, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Goals - my_shared_goals_get(). Total execution time: ' . $time_elapsed_secs);
    }

    /*----------------shared goals from friends-----------------*/
    public function goals_shared_with_me_get()
    {   
        $start = microtime(true);
        log_message('debug', 'Class: Goals - goals_shared_with_me_get() called');
        if (empty($this->current_user)) {
            log_message('debug', 'goals_shared_with_me_get() there is no user details');
            $this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
        } else {
            $con_user_id = $this->current_user->id;
            if (empty($con_user_id)) {
                log_message('debug', 'Class: Goals - goals_shared_with_me_get() user_id is empty');
                $this->set_response([
                    'status' => FALSE,
                ], REST_Controller::HTTP_FORBIDDEN);
            } else {
                $response = $this->Goalapi_model->goals_shared_with_me($con_user_id);
                log_message('debug', 'Class: Goals - goals_shared_with_me_get() $response for USER ID :'.$con_user_id);
                $this->set_response($response, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Goals - goals_shared_with_me_get(). Total execution time: ' . $time_elapsed_secs);
    }

    /*----------------search_food_item based on item-----------------*/
    public function search_food_item_get()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Goals - search_food_item_get() called');
        if (empty($this->current_user)) {
            log_message('debug', 'Class: Goals - search_food_item_get() there is no user details');
            $this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
        } else {
            $Item_Name = $this->query('term');
            if (empty($Item_Name)) {
                log_message('debug', 'Class: Goals - search_food_item_get() item_name is empty');
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'term missing!'
                ], REST_Controller::HTTP_OK);
            } else {
                $response = $this->Goalapi_model->search_food_item($Item_Name);
                log_message('debug', 'Class: Goals - search_food_item_get() $response');
                $this->set_response($response
                        , REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Goals - search_food_item_get(). Total execution time: ' . $time_elapsed_secs);
    }

    /*----------------selecting item from the list-----------------*/
    public function selecting_item_get()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Goals - selecting_item_get() called');
        if (empty($this->current_user)) {
            log_message('debug', 'selecting_item_get() there is no user details');
            $this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
        } else {
            $Item_id = $this->query('item_id');

            if (empty($Item_id)) {
                log_message('debug', 'Class: Goals - selecting_item_get() item_id is empty');
                $this->set_response([
                    'status' => false,
                    'message' => 'Item id is missing!'
                ], REST_Controller::HTTP_OK);
            } else {
                $response = $this->Goalapi_model->selecting_item($Item_id);
                log_message('debug', 'Class: Goals - selecting_item_get() $response');
                $this->set_response($response
                        , REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Goals - selecting_item_get(). Total execution time: ' . $time_elapsed_secs);
    }

    /*----------------search_ACTIVITY based on ACTIVITY-----------------*/
    public function search_activity_get()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Goals - search_activity_get() called');
        if (empty($this->current_user)) {
            log_message('debug', 'Class: Goals - search_activity_get() there is no user details');
            $this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
        } else {
            $Activity_Name = $this->query('term');
            if (empty($Activity_Name)) {
                log_message('debug', 'Class: Goals - search_activity_get() item_id is empty');
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'activity_name missing!'
                ], REST_Controller::HTTP_OK);
            } else {
                $response = $this->Goalapi_model->search_activity($Activity_Name);
                log_message('debug', 'Class: Goals - search_activity_get() $response');
                $this->set_response($response
                        , REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Goals - search_activity_get(). Total execution time: ' . $time_elapsed_secs);
    }

    /*----------------selecting activity from the list-----------------*/
    public function selecting_activity_get()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Goals - selecting_activity_get() called');
        if (empty($this->current_user)) {
            log_message('debug', 'Class: Goals - selecting_activity_get() there is no user details');
            $this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
        } else {

            $Activity_id = $this->query('activity_id');

            if (empty($Activity_id)) {
                log_message('debug', 'Class: Goals - selecting_activity_get() Activity_id is empty');
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'activity id missing!'
                ], REST_Controller::HTTP_OK);
            } else {
                $response = $this->Goalapi_model->selecting_activity($Activity_id);
                log_message('debug', 'Class: Goals - selecting_activity_get() $response');
                $this->set_response($response
                    , REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Goals - selecting_activity_get(). Total execution time: ' . $time_elapsed_secs);
    }

    /*----------------TRACKING FOOD INTAKE-----------------*/
    public function tracking_food_intake_post()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Goals - tracking_food_intake_post() called');
        if (empty($this->current_user)) {
            log_message('debug', 'Class: Goals - tracking_food_intake_post() there is no user details');
            $this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
        } else {
            $con_user_id = $this->current_user->id;

            $Item_id = $this->input->post('item_id');
            $Item_Name = $this->input->post('item_name');
            $Item_Calories = $this->input->post('item_calories');
            $Item_Quantity = $this->input->post('item_quantity');
            $Meal = $this->input->post('meal');

            if (empty($Item_id) || empty($Item_Name) || empty($Item_Calories) || empty($Item_Quantity) || empty(($Meal))) {
                log_message('debug', 'Class: Goals - tracking_food_intake_post() Food details missing');
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Food details missing!'
                ], REST_Controller::HTTP_OK);
            } else {
                $response = $this->Goalapi_model->tracking_food_intake($con_user_id, $Item_id, $Item_Name, $Item_Calories, $Item_Quantity, $Meal);
                if ($response == TRUE) {
                    log_message('debug', 'Class: Goals - tracking_food_intake_post() record inserted successfully for UserID :'.$con_user_id);
                    $this->set_response(null
                        , REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
                } else {
                    log_message('debug', 'Class: Goals - tracking_food_intake_post() Failed to add record for UserID :'.$con_user_id);
                    $this->set_response([
                        'status' => FALSE,
                        'message' => 'Failed to add record'
                    ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
                }
            }
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Goals - tracking_food_intake_post(). Total execution time: ' . $time_elapsed_secs);
    }

    /*----------------TRACKING ACTIVITY INTAKE-----------------*/
    public function tracking_activity_post()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Goals - tracking_activity_post() called');
        if (empty($this->current_user)) {
            log_message('debug', 'tracking_activity_post() there is no user details');
            $this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
        } else {
            $con_user_id = $this->current_user->id;
            $Activity_id = $this->input->post('activity_id');
            $Activity_Name = $this->input->post('activity_name');
            $Activity_Calories = $this->input->post('activity_calories');
            $Activity_Duration = $this->input->post('activity_duration');
            if (empty($Activity_id) || empty($Activity_Name) || empty($Activity_Calories) || empty($Activity_Duration)) {
                log_message('debug', 'Class: Goals - tracking_activity_post() Food details missing');
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Activity details missing!'
                ], REST_Controller::HTTP_OK);
            } else {
                $response = $this->Goalapi_model->tracking_activity($con_user_id, $Activity_id, $Activity_Name, $Activity_Calories, $Activity_Duration);
                if ($response == TRUE) {
                    log_message('debug', 'Class: Goals - tracking_activity_post() record inserted successfully for UserID :'.$con_user_id);
                    $this->set_response($response
                        , REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
                } else {
                    log_message('debug', 'Class: Goals - tracking_activity_post() Failed to add record for UserID :'.$con_user_id);
                    $this->set_response([
                        'status' => FALSE,
                        'message' => 'Failed to add record'
                    ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
                }
            }
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Goals - tracking_activity_post(). Total execution time: ' . $time_elapsed_secs);
    }

    /*----------------CALCULATING GOAL PROGRESS--------------*/
    public function goal_progress_calculate_get()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Goals - goal_progress_calculate_get() called');
        if (empty($this->current_user)) {
            log_message('debug', 'goal_progress_calculate_get() there is no user details');
            $this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
        } else {
            $user_id = $this->current_user->id;
            $user_diary_id = $this->get('user_diary_id');
            $goal_id = $this->get('goal_id');
            if($user_id != "" || $user_diary_id != "" || $goal_id != ""){
            //echo "Tracking...";
            $response = $this->Goalapi_model->goal_progress_calculate($user_diary_id, $user_id, $goal_id);
            log_message('debug', 'Class: Goals - goal_progress_calculate_get() $response for USER ID :'.$user_id);
            $this->set_response([
                'status' => TRUE,
                'result' => $response
            ], REST_Controller::HTTP_OK);
            }else{
                log_message('debug', 'Class: Goals - goal_progress_calculate_get() Input Values are an invalid.');
                $this->response([
                        'status' => FALSE,
                        'message' => 'Input Values are an invalid.'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Goals - goal_progress_calculate_get(). Total execution time: ' . $time_elapsed_secs);
    }


    /**
     *  User goal completed entry
     */
    public function update_user_daily_tracking_details_post()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Goals - update_user_daily_tracking_details_post() called');
        if (empty($this->current_user)) {
            log_message('debug', 'Class: Goals - update_user_daily_tracking_details_post() there is no user details');
            $this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
        } else {
            $data = [];

            $data = $this->request->body;
            $data['user_id'] = $this->current_user->id;

            if (empty($data['goal_id']) || empty($data['user_diary_id'])) {
                log_message('debug', 'Class: Goals - update_user_daily_tracking_details_post() Some post data missing!');
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Some post data missing!'
                ], REST_Controller::HTTP_OK);
            } else {
                $response = $this->Goalapi_model->update_user_daily_tracking_details($data);

//                $goalProgress = $this.userGoalProgressCalculator($data['user_dairy_id'], $data['user_id'], $data['goal_id'] );
//                $this->Goalapi_model->update_goal_progress($data['user_dairy_id'], $data['user_id'], $data['goal_id'], $goalProgress);
                
                if ($response == TRUE) {
                    log_message('debug', 'Class: Goals - update_user_daily_tracking_details_post() record inserted successfully for USER ID :'.$data['user_id']);
                    $this->set_response([
                        'status' => TRUE,
                        'message' => 'Record updated'
                    ], REST_Controller::HTTP_OK);
                } else {
                    log_message('debug', 'Class: Goals - update_user_daily_tracking_details_post() Failed to add record.');
                    $this->set_response([
                        'status' => FALSE,
                        'message' => 'Failed to add record'
                    ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
                }
            }
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Goals - update_user_daily_tracking_details_post(). Total execution time: ' . $time_elapsed_secs);
    }




    /**
     *  User goal update
     */
    public function update_removed_incomplete_post()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Goals - update_removed_incomplete_post() called');
        if (empty($this->current_user)) {
            log_message('debug', 'update_removed_incomplete_post() there is no user details');
            $this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
        } else {
            $data = [];

            $data = $this->request->body;
            $data['user_id'] = $this->current_user->id;

            if (empty($data['goal_id']) || empty($data['user_diary_id'])) {
                log_message('debug', 'Class: Goals - update_removed_incomplete_post() Some post data missing!');
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Some post data missing!'
                ], REST_Controller::HTTP_OK);
            } else {

                $removed_incomplete = (isset($data['removed_incomplete']))? intval($data['removed_incomplete']):0;
                $updated = $this->Goalapi_model->update_removed_incomplete($data['user_diary_id'], $data['user_id'], $data['goal_id'], $removed_incomplete);

                if ($updated == TRUE) {
                    log_message('debug', 'Class: Goals - update_removed_incomplete_post() record inserted successfully for USER ID :'.$data['user_id']);
                    $this->set_response([
                        'status' => TRUE,
                        'message' => 'Record updated'
                    ], REST_Controller::HTTP_OK);
                } else {
                    log_message('debug', 'Class: Goals - update_removed_incomplete_post() Failed to add record.');
                    $this->set_response([
                        'status' => FALSE,
                        'message' => 'Failed to add record'
                    ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
                }
            }
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Goals - update_removed_incomplete_post(). Total execution time: ' . $time_elapsed_secs);
    }
    /**
     *	Action of Share link
     */
    public function shareGoal_post()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Goals - shareGoal_post() called');
        if (empty($this->current_user)) {
            log_message('debug', 'Class: Goals - shareGoal_post() there is no user details');
            $this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
        } else {
            $data = [];
            $data = $this->request->body;
            $id   = $this->current_user->id;
            
            if(empty($data['sender_diary_id']) || empty($data['phone_number']) ||  empty($data['goal_id'])){
                log_message('debug', 'Class: Goals - shareGoal_post() Invalid Inputs');
                $this->set_response([
                    'status' => false,
                    'message' => 'Invalid Inputs'
                ], REST_Controller::HTTP_OK);
            }else{
                
                $response = $this->Goalapi_model->share($id, $data);
                log_message('debug', 'Class: Goals - shareGoal_post() $response for USER ID :'.$id);
                $this->set_response($response, REST_Controller::HTTP_OK);
                
            }

        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Goals - shareGoal_post(). Total execution time: ' . $time_elapsed_secs);
    }
    /**
     *  accepting shared goals
     */
    public function accept_shared_goals_post()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Goals - accept_shared_goals_post() called');
        if (empty($this->current_user)) {
            log_message('debug', 'Class: Goals - accept_shared_goals_post() there is no user details');
            $this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
        } else {
            $user_id = $this->current_user->id;
            $post_data = $this->request->body;
            $sender_user_id=$post_data["sender_user_id"];
            $goal_id=$post_data["goal_id"];
            $circle_id=$post_data["circle_id"];
                
            if(empty($sender_user_id)||empty($goal_id)||empty($circle_id)){
                log_message('debug', 'Class: Goals - accept_shared_goals_post() some post data missing!');
                $this->set_response([
                    'status' => false,
                    'message' => 'some post data missing!'
                ], REST_Controller::HTTP_OK);
            } else {
                //It is check goal to already added or not.
                $isGoalExists = $this->Goalapi_model->isAlreadyExistsGoal($goal_id,$user_id);
                if($isGoalExists){
                    $user_diary_id =  $isGoalExists->row()->user_diary_id;
                }
                else{
                    $user_diary_id = $this->Goalapi_model->store_new_goal_to_mydiary($goal_id,$user_id);
                }
               
                $accept_goal_status=$this->Goalapi_model->update_shared_goal_accept_status($circle_id,$user_diary_id);
                if($accept_goal_status==TRUE){
                    $shared_goal_accept_string = 'event_type=SHARED_GOAL_ACCEPTED,goalID='.$goal_id.',sender_user_id='.$sender_user_id.',user_diary_id='.$user_diary_id.',circle_id='.$circle_id.',timestamp='.$this->timezone.',userID='.$user_id;
                    event_service($shared_goal_accept_string);
                    log_message('debug', 'Class: Goals - accept_shared_goals_post() record updated successfully for USER ID :'.$user_id);
                    $this->set_response([
                        'status' => TRUE,
                        'message' => 'record updated successfully'
                    ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
                }else{
                    log_message('debug', 'Class: Goals - accept_shared_goals_post() record not updated successfully for USER ID :'.$user_id);
                    $this->set_response([
                        'status' => FALSE,
                        'message' => 'Failed to update record'
                    ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
                }
            }
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Goals - accept_shared_goals_post(). Total execution time: ' . $time_elapsed_secs);
    }
       
    /**
     *  accepting shared goals
     */
    public function reject_shared_goals_post()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Goals - reject_shared_goals_post() called');
        if (empty($this->current_user)) {
            log_message('debug', 'Class: Goals - reject_shared_goals_post() there is no user details');
            $this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
        } else {
            $post_data = $this->request->body;
            $circle_id=$post_data["circle_id"];
            if(empty($circle_id)){
                log_message('debug', 'Class: Goals - reject_shared_goals_post() some post data missing!');
                $this->set_response([
                    'status' => false,
                    'message' => 'some post data missing!'
                ], REST_Controller::HTTP_OK);
            } else {
                  $reject_goal_status=$this->Goalapi_model->reject_shared_goal($circle_id);
            }
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Goals - reject_shared_goals_post(). Total execution time: ' . $time_elapsed_secs);
    }
    /**
     *  display friends shareable goals
     */
    public function my_friends_shareable_goals_get()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Goals - my_friends_shareable_goals_get() called');
        if (empty($this->current_user)) {
            log_message('debug', 'Class: Goals - my_friends_shareable_goals_get() there is no user details');
            $this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
        } else {
            $friends_user_id = $this->get('friends_user_id');
            $user_id = $this->current_user->id;
            if(empty($friends_user_id)){
                log_message('debug', 'Class: Goals - my_friends_shareable_goals_get() some post data missing!');
                $this->set_response([
                    'status' => false,
                    'message' => 'some post data missing!'
                ], REST_Controller::HTTP_OK);
            }else{
                $response = $this->Goalapi_model->friends_shareable_goals_list($friends_user_id);
                log_message('debug', 'Class: Goals - my_friends_shareable_goals_get() $response for USER ID :'.$user_id);
                $this->set_response($response, REST_Controller::HTTP_OK);
            }
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Goals - my_friends_shareable_goals_get(). Total execution time: ' . $time_elapsed_secs);
    }
    
    /**
     *  display sme_list_for_goal
     */
    public function sme_list_for_goal_get()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Goals - sme_list_for_goal_get() called');
        if (empty($this->current_user)) {
            log_message('debug', 'Class: Goals - sme_list_for_goal_get() there is no user details');
            $this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
        } else {
            $user_id=$this->current_user->id;
            $goal_id = $this->get('goal_id');
            $response = $this->Goalapi_model->sme_list_for_goal($goal_id);
            if(!empty($response)){
                log_message('debug', 'Class: Goals - sme_list_for_goal_get() $response of sme user for Goal_id :'.$goal_id);
                $this->set_response($response, REST_Controller::HTTP_OK);
            }else{
                log_message('debug', 'Class: Goals - sme_list_for_goal_get() There is no sme user for this Goal_id:'.$goal_id);
                $this->set_response([
                    'status' =>false,
                    'message'=>'There is no sme user for this goal'
                ], REST_Controller::HTTP_OK);
            }
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Goals - sme_list_for_goal_get(). Total execution time: ' . $time_elapsed_secs);
    }
}
