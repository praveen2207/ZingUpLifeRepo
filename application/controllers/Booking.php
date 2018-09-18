<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This class doing booking process and payment for booking
 * 
 * @author Vikrant <vikrant@nuvodev.com>
 * 
 * Date:20-08-2015
 * 
 * */
class Booking extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('Business_offering');
        $this->load->model('Business');
        $this->load->model('Bookings');
        $this->load->model('User');
    }

    /*
     * Function to choose booking date
     */

    public function choose_booking_date() {
        $current_time = date('H:i:s');
        $booking_time = date('H:i:s', strtotime('' . $current_time . '+ 10 minutes'));

        $booking_duration = $this->session->userdata('booking_duration');

        if (isset($booking_duration)) {
            if (strtotime($booking_duration) < strtotime($current_time)) {
                $this->session->set_userdata("booking_duration", $booking_time);
                $booking_time_duration = round(abs(strtotime($booking_time) - strtotime($current_time)) / 60, 2);
                $booking_time_duration_length = $booking_time_duration . 'm';
            } else {
                $this->session->set_userdata("booking_duration", $booking_duration);
                $booking_time_duration_length = $this->Bookings->time_difference($booking_duration, $current_time);
            }
        } else {
            $this->session->set_userdata("booking_duration", $booking_time);
            $booking_time_duration = round(abs(strtotime($booking_time) - strtotime($current_time)) / 60, 2);
            $booking_time_duration_length = $booking_time_duration . 'm';
        }

        $this->User_activity->insert_user_activity();
        $business_provider_id = $this->session->userdata('business_provider_id');
        $business_service_id = $this->session->userdata('business_service_id');
        $data['business_provider_details'] = $this->Business->get_business_provider_details($business_provider_id);
        $data['get_offering_service_details'] = $this->Business_offering->get_business_offering_service_details($business_service_id);
        $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
        $data['booking_time_duration_length'] = $booking_time_duration_length;
        $available_dates_array = array();
        foreach ($data['get_offering_service_details']['slots'] as $key => $value) {
            $available_dates_array[] = $value->date;
        }
        $all_dates = array();
        for ($i = 0; $i <= 365; $i++) {
            $all_dates[] = date('Y-m-d', strtotime("+$i days"));
        }
        foreach ($all_dates as $key => $value) {
            if (in_array($value, $available_dates_array, true)) {
                unset($all_dates[$key]);
            }
        }
        $available_dates = implode(',', $all_dates);
        $data['available_dates'] = $available_dates;

        $data['main_content'] = 'choose_booking_date';
        $this->load->view('includes/template', $data);
    }

    /* Above function ends here */

    /*
     * Function to get bookimg slots for selected service and choosed date
     */

    public function choose_booking_time() {
        $this->User_activity->insert_user_activity();

        $business_provider_id = $this->session->userdata('business_provider_id');
        $business_service_id = $this->session->userdata('business_service_id');

        $current_time = date('H:i:s');
        $booking_duration = $this->session->userdata('booking_duration');
        $booking_time_duration_length = $this->Bookings->time_difference($booking_duration, $current_time);


        $post_data = $_POST;
        if (!empty($post_data)) {
            if ($post_data['submit'] == 'Continue') {
                $choosed_booking_date = $post_data['booking_date'];
                $this->session->set_userdata("choosed_booking_date", $choosed_booking_date);
            } else {
                redirect('/offeringServiceDetails/' . $business_service_id . '');
            }
        }
        $booking_date = $post_data['booking_date'];

        $data['business_provider_details'] = $this->Business->get_business_provider_details($business_provider_id);
        $data['get_offering_service_details'] = $this->Business_offering->get_business_offering_service_details($business_service_id);
        $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
        $data['choosed_booking_date'] = $booking_date;
        $data['business_services_slots'] = $this->Business_offering->get_business_services_slots($business_service_id, $booking_date);
        if (!empty($data['business_services_slots'])) {
            $data['booking_time_duration_length'] = $booking_time_duration_length;
            $data['main_content'] = 'choose_booking_time';
            $this->load->view('includes/template', $data);
        } else {
            $this->session->set_flashdata('slot_message', 'No Slots Available For Selected Date !!!.');
            redirect("/chooseBookingDate");
        }
    }

    /* Above function ends here */

    public function review_booking_details() {
        $booking_time = $this->session->userdata('booking_time');
        if ($booking_time != '') {
            $this->User_activity->insert_user_activity();

            $booking_timings = explode('/', $booking_time);
            $choosed_booking_time = $booking_timings[0];
            $choosed_booking_timings = $booking_timings[1];

            $current_time = date('H:i:s');
            $booking_duration = $this->session->userdata('booking_duration');
            $booking_time_duration_length = $this->Bookings->time_difference($booking_duration, $current_time);

            $choosed_booking_date = $this->session->userdata('choosed_booking_date');
            $business_provider_id = $this->session->userdata('business_provider_id');
            $business_service_id = $this->session->userdata('business_service_id');

            $logged_in_user_data = $this->session->userdata('logged_in_user_data');
            $username = $logged_in_user_data->username;
            $user_details = $this->User->get_user_details_by_username($username);
            $user_details->is_logged_in = 1;
            $data['logged_in_user_details'] = $user_details;
            $data['business_provider_details'] = $this->Business->get_business_provider_details($business_provider_id);
            $data['get_offering_service_details'] = $this->Business_offering->get_business_offering_service_details($business_service_id);
            $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
            $data['service_image_path'] = base_url() . $this->config->item('business_services_gallery_path');
            $data['choosed_booking_date'] = $choosed_booking_date;
            $data['choosed_booking_time'] = $choosed_booking_time;
            $data['choosed_booking_timings'] = $choosed_booking_timings;
            $data['booking_time_duration_length'] = $booking_time_duration_length;
            if ($data['get_offering_service_details']['details']->discount != '') {
                $discount_start_date = $data['get_offering_service_details']['details']->discount_start_date;
                $discount_end_date = $data['get_offering_service_details']['details']->discount_end_date;
                $data['discount'] = self::check_in_range($discount_start_date, $discount_end_date, $choosed_booking_date);
            }
            $data['main_content'] = 'booking_edit';
            $this->load->view('includes/template', $data);
        } else {
            $this->session->set_flashdata('slot_error_message', 'Please try again !!!.');
            redirect("/chooseBookingDate");
        }
    }

    public function contact_to_vendor() {
        $this->User_activity->insert_user_activity();
        $business_provider_id = $this->uri->segment(2);

        $data['business_provider_details'] = $this->Business->get_business_provider_details($business_provider_id);
        $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
        $data['main_content'] = 'vendor_support';
        $this->load->view('includes/template', $data);
    }

    /*
     *  Displaying users trnsactions list
     */

    public function my_bookings() {
        $this->User_activity->insert_user_activity();
        $logged_in_user_data = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_data->is_logged_in == 1) {
            $this->load->model('Bookings');
            $transactions = $this->Bookings->get_transactions_list_by_user_id($logged_in_user_data->user_id);
            $data['transactions'] = $transactions;
            $is_mobile = '0';
            if ($is_mobile == '1') {
                echo json_encode($data);
            } else {
                $data['main_content'] = 'transactions';
                $this->load->view('includes/template', $data);
            }
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/login");
        }
    }

    /* Above function ends here */

    /*
     *  Displaying users trnsactions list
     */

    public function my_upcoming_bookings() {
        $this->User_activity->insert_user_activity();
        $logged_in_user_data = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_data->is_logged_in == 1) {
            $this->load->model('Bookings');
            $transactions = $this->Bookings->my_upcoming_bookings($logged_in_user_data->user_id);
            $data['transactions'] = $transactions;
            $is_mobile = '0';
            if ($is_mobile == '1') {
                echo json_encode($data);
            } else {
                $data['main_content'] = 'transactions';
                $this->load->view('includes/template', $data);
            }
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/login");
        }
    }

    /* Above function ends here */

    /*
     *  Displaying users trnsactions list
     */

    public function my_past_bookings() {
        $this->User_activity->insert_user_activity();
        $logged_in_user_data = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_data->is_logged_in == 1) {
            $this->load->model('Bookings');
            $transactions = $this->Bookings->my_past_bookings($logged_in_user_data->user_id);
            $data['transactions'] = $transactions;
            $is_mobile = '0';
            if ($is_mobile == '1') {
                echo json_encode($data);
            } else {
                $data['main_content'] = 'transactions';
                $this->load->view('includes/template', $data);
            }
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/login");
        }
    }

    /* Above function ends here */
    /*
     *  Displaying users trnsactions details
     */

    public function transaction_details() {
        $this->User_activity->insert_user_activity();
        $id = $this->uri->segment(2);
        $logged_in_user_data = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_data->is_logged_in == 1) {
            $this->load->model('Bookings');
            $transaction_details = $this->Bookings->get_transactions_details_by_transaction_id($id);
            $transaction_details->provider_id;
            $data['business_provider_details'] = $this->Business->get_business_provider_details($transaction_details->provider_id);
            $data['business_details'] = $this->Bookings->get_business_details($transaction_details->provider_id);
            $data['transaction_details'] = $transaction_details;
            $data['logged_in_user_data'] = $logged_in_user_data;
//            echo "<pre>";
//            print_r($transaction_details);
//            exit();
            $data['main_content'] = 'transaction_details';
            $this->load->view('includes/transaction_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/login");
        }
    }

    /* Above function ends here */


    /*
     *  Displaying users bookings list 
     */

    public function order_details() {
        $this->User_activity->insert_user_activity();
        $id = $this->uri->segment(2);
        $logged_in_user_data = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_data->is_logged_in == 1) {
            $this->load->model('Bookings');
            $order_details = $this->Bookings->get_order_details($id);

            $data['user_details'] = $this->Bookings->get_user_details($order_details->user_id);
            $data['business_provider_details'] = $this->Business->get_business_provider_details($order_details->provider_id);
            $data['business_details'] = $this->Bookings->get_business_details($order_details->provider_id);
            $data['order_details'] = $order_details;

            $is_mobile = '0';
            if ($is_mobile == '1') {
                echo json_encode($data);
            } else {
                $data['main_content'] = 'order_details';
                $this->load->view('includes/template', $data);
            }
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/login");
        }
    }

    /* Above function ends here */


    /*
     *  Displaying Reschedule page for order 
     */

    public function reschedule_order() {
        $this->User_activity->insert_user_activity();
        $id = $this->uri->segment(2);
        $this->session->unset_userdata('selected_date');
        $this->session->unset_userdata('selected_time');
        $logged_in_user_data = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_data->is_logged_in == 1) {
            $this->load->model('Bookings');
            $reschedule_details = $this->Bookings->get_order_details($id);
            $data['business_provider_details'] = $this->Business->get_business_provider_details($reschedule_details->provider_id);
            $data['business_details'] = $this->Bookings->get_business_details($reschedule_details->provider_id);
            $data['transaction_details'] = $reschedule_details;
            $data['logged_in_user_data'] = $logged_in_user_data;
//            echo "<pre>";
//            print_r($reschedule_details);
//            exit();
//                $data['main_content'] = 'reschedule';
//                $this->load->view('includes/template', $data);
            $data['main_content'] = 'reschedule';
            $this->load->view('includes/transaction_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/login");
        }
    }

    /* Above function ends here */


    /*
     *  Displaying Reschedule time page 
     */

    public function reschedule_order_time() {
        $this->User_activity->insert_user_activity();
        $id = $this->uri->segment(2);
        $logged_in_user_data = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_data->is_logged_in == 1) {
            $this->load->model('Bookings');
            $reschedule_details = $this->Bookings->get_order_details($id);
            $data['business_services_slots'] = $business_services_slots = $this->Business_offering->get_business_services_slots($reschedule_details->service_id, $reschedule_details->date);

            $data['business_provider_details'] = $this->Business->get_business_provider_details($reschedule_details->provider_id);
            $data['transaction_details'] = $reschedule_details;
            $data['selected_date'] = $this->session->userdata('selected_date');
            $data['selected_time'] = $this->session->userdata('selected_time');
            if (empty($business_services_slots)) {
                $data['reschedule_message'] = 'No slots available for this date.Please select ' . anchor('reschedule_date/' . $id, 'other date', 'class="blue link-small"');
            }
            $data['logged_in_user_data'] = $logged_in_user_data;
//            $data['main_content'] = 'reschedule_time';
//            $this->load->view('includes/template', $data);
            $data['main_content'] = 'reschedule_time';
            $this->load->view('includes/transaction_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/login");
        }
    }

    /* Above function ends here */



    /*
     *  Displaying Reschedule time page 
     */

    public function reschedule_order_date() {
        $this->User_activity->insert_user_activity();
        $id = $this->uri->segment(2);
        $logged_in_user_data = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_data->is_logged_in == 1) {
            $this->load->model('Bookings');
            $reschedule_details = $this->Bookings->get_order_details($id);
            $data['business_services_slots'] = $this->Business_offering->get_business_services_slots($reschedule_details->service_id, $reschedule_details->booking_date);

            $data['business_provider_details'] = $this->Business->get_business_provider_details($reschedule_details->provider_id);
            $data['transaction_details'] = $reschedule_details;
            $data['selected_date'] = $this->session->userdata('selected_date');
            $data['selected_time'] = $this->session->userdata('selected_time');
            $data['logged_in_user_data'] = $logged_in_user_data;

//            $data['main_content'] = 'reschedule_date';
//            $this->load->view('includes/template', $data);
            $data['main_content'] = 'reschedule_date';
            $this->load->view('includes/transaction_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/login");
        }
    }

    /* Above function ends here */



    /*
     *  Displaying Reschedule time page 
     */

    public function confirm_rescheduling_time() {
        $this->User_activity->insert_user_activity();
        $post_data = $this->input->post();
        $data['change_time'] = 'change_time';
        if ($post_data['submit'] == 'Cancel') {
            redirect('reschedule/' . $post_data['booking_id']);
        } else {
            $id = $post_data['booking_id'];
            $data['booking_date'] = $booking_date = $post_data['booking_date'];
            $reschedule_time = $post_data['reschedule_time'];
            $time = explode('/', $reschedule_time);
            $new_slot_id = $data['new_slot_id'] = $time[0];

            $rescheduled_time = explode('-', $time[1]);
            $data['reschedule_start_time'] = $start_time = $rescheduled_time[0];
            $data['reschedule_end_time'] = $end_time = $rescheduled_time[1];
            $logged_in_user_data = $this->session->userdata('logged_in_user_data');
            if ($logged_in_user_data->is_logged_in == 1) {

                $this->load->model('Bookings');
                $reschedule_details = $this->Bookings->get_order_details($id);
                $data['business_services_slots'] = $this->Business_offering->get_business_services_slots($reschedule_details->service_id, $reschedule_details->date);


                $data['business_provider_details'] = $this->Business->get_business_provider_details($reschedule_details->provider_id);
                $data['reschedule_details'] = $reschedule_details;
                $data['user_details'] = $logged_in_user_data;
                $is_mobile = '0';
                if ($is_mobile == '1') {
                    echo json_encode($data);
                } else {
                    $data['main_content'] = 'reschedule_confirm';
                    $this->load->view('includes/template', $data);
                }
            } else {
                $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
                redirect("/login");
            }
        }
    }

    /* Above function ends here */


    /*
     *  Displaying Reschedule date page 
     */

    public function confirm_rescheduling_date() {
        $this->User_activity->insert_user_activity();
        $post_data = $this->input->post();
//        echo "<pre>";
//        print_r($post_data);
//        exit();
        $logged_in_user_data = $this->session->userdata('logged_in_user_data');
        $data['change_date'] = 'change_date';
        if ($post_data['submit'] == 'Cancel') {
            redirect('reschedule/' . $post_data['booking_id']);
        } else {
            $id = $data['booking_id'] = $post_data['booking_id'];
            $data['booking_date'] = $booking_date = $post_data['booking_date'];
            $data['reschedule_start_time'] = $start_time = $post_data['reschedule_start_time'];
            $data['reschedule_end_time'] = $end_time = $post_data['reschedule_end_time'];

            $this->load->model('Bookings');
            $data['reschedule_details'] = $reschedule_details = $this->Bookings->get_order_details($id);
            $data['business_provider_details'] = $this->Business->get_business_provider_details($reschedule_details->provider_id);
            $data['business_services_slots'] = $this->Business_offering->get_business_services_slots($reschedule_details->service_id, $booking_date);
            $data['slot_details'] = $this->Bookings->get_slot_id($reschedule_details->service_id, $booking_date, $start_time, $end_time);
            $data['user_details'] = $logged_in_user_data;
            if (!empty($data['slot_details'])) {
                $new_slot_id = $data['new_slot_id'] = $data['slot_details']->id;
            } else {
                $new_slot_id = '';
            }
            $logged_in_user_data = $this->session->userdata('logged_in_user_data');
            if ($logged_in_user_data->is_logged_in == 1) {
                if ($new_slot_id == '') {
                    $this->session->set_flashdata('reschedule_message', 'The date you selected has no slots available.Please select other date');
                    redirect('reschedule_date/' . $id);
                } else {

                    $data['main_content'] = 'reschedule_confirm';
                    $this->load->view('includes/template', $data);
                }
            } else {
                $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
                redirect("/login");
            }
        }
    }

    /* Above function ends here */


    /*
     *  Displaying Reschedule time page 
     */

    public function rescheduling_success() {
        $this->User_activity->insert_user_activity();
        $post_data = $this->input->post();
        if ($post_data['submit'] == 'Cancel') {
            if ($post_data['change_date'] != "") {
                redirect('reschedule_date/' . $post_data['booking_id']);
            } else {
                redirect('reschedule_time/' . $post_data['booking_id']);
            }
        } else {
            $data['logged_in_user_data'] = $logged_in_user_data = $this->session->userdata('logged_in_user_data');
            if ($logged_in_user_data->is_logged_in == 1) {
                $this->load->model('Bookings');
                $data['reschedule_message'] = $this->Bookings->update_order($post_data);
                $reschedule_details = $this->Bookings->get_order_details($post_data['booking_id']);
                $data['business_services_slots'] = $this->Business_offering->get_business_services_slots($reschedule_details->service_id, $reschedule_details->booking_date);

                $data['business_provider_details'] = $this->Business->get_business_provider_details($reschedule_details->provider_id);
                $data['reschedule_details'] = $reschedule_details;
                $data['business_details'] = $business_details = $this->Bookings->get_business_details($reschedule_details->provider_id);
                $data['user_details'] = $data['logged_in_user_data'];
                if ($business_details->email != '') {

                    $booking_email_content_vendor = $this->load->view('emails/booking_vendor', $data, true);

                    $to = $business_details->email;
                    //$to = 'divya@nuvodev.com';
                    $from = "Zingup<orders@zinguplife.com>";

                    $booking_mail_subject = "Booking Done Sucessfully - Zinguplife";
                    $booking_message = $booking_email_content_vendor;


                    $this->Mailing->send_mail($to, $from, $booking_mail_subject, $booking_message);

//Send another email to admin also

                    $to = "Zingup<info@zinguplife.com>";
                    $from = "Zingup<orders@zinguplife.com>";

                    $booking_mail_subject = "Booking Done Sucessfully - Zinguplife";
                    $booking_message = $booking_email_content_vendor;

                    $this->Mailing->send_mail($to, $from, $booking_mail_subject, $booking_message);
                }


                $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
                $email_content = $this->load->view('emails/order_success_email', $data, true);
                $to = $logged_in_user_data->username;
                $from = "Zingup";
                $subject = "Zingup Rescheduling order.";
                $message = $email_content;

                $this->Mailing->send_mail($to, $from, $subject, $message);
                if ($reschedule_details->start_time >= 12) {
                    $meridian = 'PM';
                } else {
                    $meridian = 'AM';
                }
                $time = date('H:i', strtotime($reschedule_details->start_time)) . ' ' . $meridian;

                if ($business_details->phone != '') {
                    $vendor_phone = explode('/', $business_details->phone);
                    $vendorphone = $vendor_phone[0];

                    $messgae_to = '+91' . $vendorphone;
                    // $messgae_to = '+919902956083';

                    $sms_content = $data['logged_in_user_details']->name . ',' . $data['logged_in_user_details']->phone . ' Booked ' . $data['get_offering_service_details']['details']->services . ' Programme '
                            . 'at ' . $data['business_provider_details']['details']->name . ', ' . $data['business_provider_details']['details']->area_name . ' '
                            . 'on Date: ' . date("l, F j, Y", strtotime($choosed_booking_date)) . ', '
                            . 'Time: ' . $time . ' Cost: ' . $data['get_offering_service_details']['details']->price . '.';


                    $this->Mailing->send_sms($messgae_to, $sms_content);
                }

                $messgae_to = '+91' . $logged_in_user_data->phone;
                // $messgae_to = '+919902956083';
                $sms_content = 'Congratulations! You have rescheduled ' . $reschedule_details->services . ' Programme '
                        . 'at ' . $data['business_provider_details']['details']->name . ', ' . $data['business_provider_details']['details']->area_name . ' '
                        . 'on Date: ' . date("l, F j, Y", strtotime($reschedule_details->date)) . ', '
                        . 'Time: ' . $time . ' Cost: ' . $reschedule_details->price . '. '
                        . 'Show this SMS at counter';
                $this->Mailing->send_sms($messgae_to, $sms_content);
                $is_mobile = '0';
                if ($is_mobile == '1') {
                    echo json_encode($data);
                } else {
                    $data['main_content'] = 'reschedule_success';
                    $this->load->view('includes/template', $data);
                }
            } else {
                $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
                redirect("/login");
            }
        }
    }

    /* Above function ends here */

    /*
     * Function to choose booking date
     */

    public function choose_membership_booking_date() {

        $post_data = $_POST;

        if (!empty($post_data)) {
            $membership_plan_id = $post_data['membership_plan_id'];
            $this->session->set_userdata("membership_plan_id", $post_data['membership_plan_id']);
        }
        $membership_plan_id = $this->session->userdata('membership_plan_id');
        $current_time = date('H:i:s');
        $booking_time = date('H:i:s', strtotime('' . $current_time . '+ 10 minutes'));

        $booking_duration = $this->session->userdata('booking_duration');

        if (isset($booking_duration)) {
            if (strtotime($booking_duration) < strtotime($current_time)) {
                $this->session->set_userdata("booking_duration", $booking_time);
                $booking_time_duration = round(abs(strtotime($booking_time) - strtotime($current_time)) / 60, 2);
                $booking_time_duration_length = $booking_time_duration . 'm';
            } else {
                $this->session->set_userdata("booking_duration", $booking_duration);
                $booking_time_duration_length = $this->Bookings->time_difference($booking_duration, $current_time);
            }
        } else {
            $this->session->set_userdata("booking_duration", $booking_time);
            $booking_time_duration = round(abs(strtotime($booking_time) - strtotime($current_time)) / 60, 2);
            $booking_time_duration_length = $booking_time_duration . 'm';
        }

        $this->User_activity->insert_user_activity();
        $business_provider_id = $this->session->userdata('business_provider_id');
        $business_service_id = $this->session->userdata('business_service_id');

        $data['business_provider_details'] = $this->Business->get_business_provider_details($business_provider_id);
        $data['get_offering_service_details'] = $this->Business_offering->get_business_offering_service_details($business_service_id);
        $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
        $data['booking_time_duration_length'] = $booking_time_duration_length;
        $data['membership_details'] = $this->Business_offering->get_membership_details($membership_plan_id);
        $data['main_content'] = 'choose_membership_booking_date';
        $this->load->view('includes/template', $data);
    }

    /* Above function ends here */

    /* Above function ends here */

    public function review_membership_details() {

        $this->User_activity->insert_user_activity();
        $membership_plan_id = $this->session->userdata('membership_plan_id');

        $current_time = date('H:i:s');
        $booking_duration = $this->session->userdata('booking_duration');
        $booking_time_duration_length = $this->Bookings->time_difference($booking_duration, $current_time);

        $choosed_booking_date = $this->session->userdata('choosed_booking_date');
        $business_provider_id = $this->session->userdata('business_provider_id');
        $business_service_id = $this->session->userdata('business_service_id');
        $data['logged_in_user_details'] = $this->session->userdata('logged_in_user_data');
        $data['business_provider_details'] = $this->Business->get_business_provider_details($business_provider_id);
        $data['get_offering_service_details'] = $this->Business_offering->get_business_offering_service_details($business_service_id);
        $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
        $data['membership_details'] = $this->Business_offering->get_membership_details($membership_plan_id);
        $data['choosed_booking_date'] = $choosed_booking_date;
        $data['service_image_path'] = base_url() . $this->config->item('business_services_gallery_path');

        if ($data['get_offering_service_details']['details']->discount != '') {
            $discount_start_date = $data['get_offering_service_details']['details']->discount_start_date;
            $discount_end_date = $data['get_offering_service_details']['details']->discount_end_date;
            $data['discount'] = self::check_in_range($discount_start_date, $discount_end_date, $choosed_booking_date);
        }

        $data['booking_time_duration_length'] = $booking_time_duration_length;
        $data['main_content'] = 'membership_booking_edit';
        $this->load->view('includes/template', $data);
    }

    public function membership_payment() {
        $this->User_activity->insert_user_activity();
        $data['logged_in_user_details'] = $this->session->userdata('logged_in_user_data');
        $post_data = $this->input->post();
        $this->session->set_userdata("payment_mode", $post_data['payment_mode']);



        $membership_plan_id = $this->session->userdata('membership_plan_id');
        $choosed_booking_date = $this->session->userdata('choosed_booking_date');
        $business_provider_id = $this->session->userdata('business_provider_id');
        $business_service_id = $this->session->userdata('business_service_id');
        $data['logged_in_user_details'] = $this->session->userdata('logged_in_user_data');
        $data['business_provider_details'] = $this->Business->get_business_provider_details($business_provider_id);
        $data['get_offering_service_details'] = $this->Business_offering->get_business_offering_service_details($business_service_id);
        $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
        $data['membership_details'] = $this->Business_offering->get_membership_details($membership_plan_id);
        $data['choosed_booking_date'] = $choosed_booking_date;
        $data['membership_plan_id'] = $membership_plan_id;
        $data['comments'] = $post_data['comments'];
        $data['total_price'] = $post_data['total_price'];
        $data['business_provider_id'] = $this->session->userdata('business_provider_id');
        $data['business_service_id'] = $this->session->userdata('business_service_id');

        $order_details = $this->Bookings->generate_membership_order($data);
        $order_details_array = explode('-', $order_details);
        $order_id = $order_details_array[1];
        $booking_id = $order_details_array[0];

        $this->session->set_userdata("order_id", $order_id);
        $this->session->set_userdata("booking_id", $booking_id);
        $this->session->set_userdata("total_price", $post_data['total_price']);

        if ($post_data['payment_mode'] == 'Pay at venue') {
            redirect("/membership_payment_success");
        } else {
            $data['order_id'] = $this->session->userdata('order_id');
            $data['price'] = $post_data['total_price'];
            $data['main_content'] = 'membership_payment';
            $this->load->view('includes/template', $data);
        }
    }

    public function membership_payment_process() {

        $app_path = APPPATH;
        include($app_path . 'payment/Crypto.php');
        $data['main_content'] = 'membership_payment_process';
        $this->load->view('includes/template', $data);
    }

    public function membership_payment_success() {
        $app_path = APPPATH;
        include($app_path . 'payment/Crypto.php');
        $workingKey = '3C095C0C179A18E2823E067C3D17CE98';  //Working Key should be provided here.
        $encResponse = $_POST["encResp"];   //This is the response sent by the CCAvenue Server
        $rcvdString = decrypt($encResponse, $workingKey);  //Crypto Decryption used as per the specified working key.

        $order_status = "";
        $decryptValues = explode('&', $rcvdString);
        $dataSize = sizeof($decryptValues);

        for ($i = 0; $i < $dataSize; $i++) {
            $information = explode('=', $decryptValues[$i]);
            if ($i == 3) {
                $order_status = $information[1];
            }
        }
        $membership_plan_id = $this->session->userdata('membership_plan_id');

        $this->User_activity->insert_user_activity();

        $payment_mode = $this->session->userdata('payment_mode');

        $choosed_booking_date = $this->session->userdata('choosed_booking_date');
        $business_provider_id = $this->session->userdata('business_provider_id');
        $business_service_id = $this->session->userdata('business_service_id');
        $data['choosed_booking_date'] = $choosed_booking_date;
        $data['logged_in_user_details'] = $this->session->userdata('logged_in_user_data');
        $data['business_provider_details'] = $this->Business->get_business_provider_details($business_provider_id);
        $data['get_offering_service_details'] = $this->Business_offering->get_business_offering_service_details($business_service_id);
        if ($data['get_offering_service_details']['details']->discount != '') {
            $discount_start_date = $data['get_offering_service_details']['details']->discount_start_date;
            $discount_end_date = $data['get_offering_service_details']['details']->discount_end_date;
            $data['discount'] = self::check_in_range($discount_start_date, $discount_end_date, $choosed_booking_date);
        }



        $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');

        $data['service_image_path'] = base_url() . $this->config->item('business_services_gallery_path');

        $data['membership_plan_id'] = $membership_plan_id;
        $data['membership_details'] = $this->Business_offering->get_membership_details($membership_plan_id);
        $data['transaction_response'] = $decryptValues;
        if ($payment_mode == 'Pay at venue') {
            $order_status = "Success";
            $data['other_information'] = 'Other Information';
        } else {
            $order_status = $order_status;
            $data['other_information'] = $rcvdString;
        }
        $data['order_status'] = $order_status;

        $transaction_id_array = explode('=', $decryptValues[1]);
        if ($payment_mode == 'Pay at venue') {
            $transaction_id = time();
        } else {
            $transaction_id = $transaction_id_array[1];
        }
        $data['transaction_id'] = $transaction_id;

        $data['payment_mode'] = $payment_mode;
        $data['service_type'] = $post_data['service_type'];
        $data['order_id'] = $this->session->userdata('order_id');
        $data['booking_id'] = $this->session->userdata('booking_id');
        $data['total_amount'] = $this->session->userdata('total_price');

        $booking = $this->Bookings->insert_membership_booking_details($data);
        /* if ($business_details->email != '') {

          $booking_email_content_vendor = $this->load->view('emails/booking_vendor', $data, true);

          //$to = $business_details->email;
          $to = 'vikrant@nuvodev.com';
          $from = "Zinguplife<orders@zinguplife.com>";

          $booking_mail_subject = "Booking Done Sucessfully - Zinguplife";
          $booking_message = $booking_email_content_vendor;

          //Send copy of the email to admin also.
          $this->Mailing->send_mail($to, $from, $booking_mail_subject, $booking_message);

          $to = "vikrant@nuvodev.com";
          $from = "Zingup<orders@zinguplife.com>";

          $booking_mail_subject = "Booking Done Sucessfully - Zinguplife";
          $booking_message = $booking_email_content_vendor;


          $this->Mailing->send_mail($to, $from, $booking_mail_subject, $booking_message);
          } */

        $booking_email_content = $this->load->view('emails/booking', $data, true);


        $to = $data['logged_in_user_details']->username;
        //$to = "vikrant.trivedi13@gmail.com";
        $from = "Zingup<orders@zinguplife.com>";

        $booking_mail_subject = "Your booking done sucessfully !!!";
        $booking_message = $booking_email_content;


        $this->Mailing->send_mail($to, $from, $booking_mail_subject, $booking_message);
        $data['main_content'] = 'membership_booking_success';
        $this->load->view('includes/template', $data);
    }

    public function membership_payment_failure() {
        $this->User_activity->insert_user_activity();
        $choosed_booking_date = $this->session->userdata('choosed_booking_date');
        $business_provider_id = $this->session->userdata('business_provider_id');
        $business_service_id = $this->session->userdata('business_service_id');
        $membership_plan_id = $this->session->userdata('membership_plan_id');
        $data['membership_plan_id'] = $membership_plan_id;
        $data['membership_details'] = $this->Business_offering->get_membership_details($membership_plan_id);
        $data['business_provider_details'] = $this->Business->get_business_provider_details($business_provider_id);
        $data['get_offering_service_details'] = $this->Business_offering->get_business_offering_service_details($business_service_id);
        $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
        $data['choosed_booking_date'] = $choosed_booking_date;
        $data['main_content'] = 'booking_failure';
        $this->load->view('includes/template', $data);
    }

    /*
     *  Displaying Reschedule time page 
     */

    public function reschedule_membership_date() {
        $this->User_activity->insert_user_activity();
        $id = $this->uri->segment(2);
        $logged_in_user_data = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_data->is_logged_in == 1) {
            $this->load->model('Bookings');
            $reschedule_details = $this->Bookings->get_order_details($id);
            $data['business_provider_details'] = $this->Business->get_business_provider_details($reschedule_details->provider_id);
            $data['reschedule_details'] = $reschedule_details;
            $data['selected_date'] = $this->session->userdata('selected_date');
            $data['selected_time'] = $this->session->userdata('selected_time');
            $is_mobile = '0';
            if ($is_mobile == '1') {
                echo json_encode($data);
            } else {
                $data['main_content'] = 'reschedule_membership_booking_date';
                $this->load->view('includes/template', $data);
            }
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/login");
        }
    }

    /* Above function ends here */

    /*
     *  Displaying Reschedule time page 
     */

    public function membership_rescheduling_success() {
        $this->User_activity->insert_user_activity();
        $post_data = $this->input->post();


        if ($post_data['submit'] == 'Cancel') {
            redirect('reschedule/' . $post_data['booking_id']);
        } else {
            $data['logged_in_user_data'] = $logged_in_user_data = $this->session->userdata('logged_in_user_data');
            if ($logged_in_user_data->is_logged_in == 1) {
                $this->load->model('Bookings');
                $data['reschedule_message'] = $this->Bookings->update_membership_order($post_data);
                $reschedule_details = $this->Bookings->get_order_details($post_data['booking_id']);
                $data['business_services_slots'] = $this->Business_offering->get_business_services_slots($reschedule_details->service_id, $reschedule_details->booking_date);

                $data['business_provider_details'] = $this->Business->get_business_provider_details($reschedule_details->provider_id);
                $data['reschedule_details'] = $reschedule_details;
                $data['business_details'] = $business_details = $this->Bookings->get_business_details($reschedule_details->provider_id);

                $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');

                $is_mobile = '0';
                if ($is_mobile == '1') {
                    echo json_encode($data);
                } else {
                    $data['main_content'] = 'membership_reschedule_success';
                    $this->load->view('includes/template', $data);
                }
            } else {
                $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
                redirect("/login");
            }
        }
    }

    /* Above function ends here */

    public function payment_canceled() {
        $this->User_activity->insert_user_activity();
        $data['main_content'] = 'booking_cancle';
        $this->load->view('includes/menu_template', $data);
    }

    /*
     *  Displaying users trnsactions details
     */

    public function cancel_order() {
        $this->User_activity->insert_user_activity();
        $id = $this->uri->segment(2);

        $logged_in_user_data = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_data->is_logged_in == 1) {
            $this->load->model('Bookings');
            $transaction_details = $this->Bookings->get_transactions_details_by_transaction_id($id);

            $data['transaction_details'] = $transaction_details;
            $booking_date_time = $transaction_details->date . ' ' . $transaction_details->start_time;
            $today = date('Y-m-d H:i:s');
            $timediff = strtotime($booking_date_time) - strtotime($today);
            if ($transaction_details->membership_type == 0) {
                if ($timediff > 86400) {
                    $cancel_booking = $this->Bookings->cancel_booking($id);
                    $data['message'] = '';
                    $data['main_content'] = 'booking_cancel';
                    $this->load->view('includes/menu_template', $data);
                } else {
                    $data['message'] = 'Sorry, you can not cancel this booking !!!';
                    $data['main_content'] = 'booking_cancel';
                    $this->load->view('includes/menu_template', $data);
                }
            } else {

                $cancel_booking = $this->Bookings->cancel_booking($id);
                $data['message'] = '';
                $data['main_content'] = 'booking_cancel';
                $this->load->view('includes/menu_template', $data);
            }
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/login");
        }
    }

    function check_in_range($start_date, $end_date, $date_from_user) {
        // Convert to timestamp
        $start_ts = strtotime($start_date);
        $end_ts = strtotime($end_date);
        $user_ts = strtotime($date_from_user);

        // Check that user date is between start & end
        return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
    }

    /* Above function ends here */

    public function checkout() {
        $logged_in_user_data = $this->session->userdata('logged_in_user_data');
        $membership_plan_id = $this->session->userdata('membership_plan_id');

        $business_provider_id = $this->session->userdata('business_provider_id');
        $business_service_id = $this->session->userdata('business_service_id');
        $data['membership_plan_id'] = $membership_plan_id;
        $data['business_provider_id'] = $business_provider_id;
        $data['business_service_id'] = $business_service_id;
        $data['business_provider_details'] = $this->Business->get_business_provider_details($business_provider_id);
        $data['get_offering_service_details'] = $this->Business_offering->get_business_offering_service_details($business_service_id);
        $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
        $data['logged_in_user_data'] = $logged_in_user_data;
        $data['membership_details'] = $this->Business_offering->get_membership_details($membership_plan_id);
        if ($data['get_offering_service_details']['details']->discount != '') {
            $choosed_booking_date = date('Y-m-d');
            $discount_start_date = $data['get_offering_service_details']['details']->discount_start_date;
            $discount_end_date = $data['get_offering_service_details']['details']->discount_end_date;
            $data['discount'] = self::check_in_range($discount_start_date, $discount_end_date, $choosed_booking_date);
        }
        $slots_array = array();
        foreach ($data['get_offering_service_details']['slots'] as $key => $value) {
            if ($value->date > date('Y-m-d')) {
                $slots_array[] = $value->date;
            }
        }
        $slots_dates_array = implode(',', $slots_array);

        $data['slots_date_array'] = array_unique($slots_array);
        $data['slots_dates'] = $slots_dates_array;
        $data['tax'] = $this->config->item('service_tax');
        $data['service_type'] = $data['get_offering_service_details']['details']->service_type;
//        echo "<pre>";
//        print_r($data);
//        exit();

        $data['title'] = "ZingUpLife | Checkout";
        $data['main_content'] = 'checkout';

        $this->load->view('includes/menu_template', $data);
    }

    public function payment() {

        $this->User_activity->insert_user_activity();
        $data['logged_in_user_details'] = $this->session->userdata('logged_in_user_data');
        $post_data = $this->input->post();


        if ($post_data['membership_type'] == 0 && $post_data['slot_id'] == '') {
            $this->session->set_flashdata('payment_mode_erros', 'Please choose a date, available time slot and payment mode to complete your booking !!!.');
            redirect("/checkout");
        }


        $this->session->set_userdata("payment_data", $post_data);
        $this->session->set_userdata("payment_mode", $post_data['payment_mode']);

        $order_details = $this->Bookings->generate_order($post_data);


        $order_details_array = explode('-', $order_details);
        $order_id = $order_details_array[1];
        $booking_id = $order_details_array[0];

        $this->session->set_userdata("order_id", $order_id);
        $this->session->set_userdata("booking_id", $booking_id);
        $this->session->set_userdata("total_price", $post_data['total_price']);

        if ($post_data['payment_mode'] == 'Pay at venue') {
            redirect("/pay_at_venue");
        } elseif ($post_data['payment_mode'] == 'Pay online') {
            $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
            $data['order_id'] = $this->session->userdata('order_id');
            $data['price'] = $post_data['total_price'];
            $data['main_content'] = 'payment';
            $this->load->view('includes/menu_template', $data);
        } else {
            $this->session->set_flashdata('payment_mode_erros', 'Please choose a payment option to continue !!!.');
            redirect("/checkout");
        }
    }

    public function payment_process() {
        $app_path = APPPATH;
        include($app_path . 'payment/Crypto.php');
        $data['main_content'] = 'payment_process';
        $this->load->view('includes/menu_template', $data);
    }

    public function payment_success() {
        $app_path = APPPATH;
        include($app_path . 'payment/Crypto.php');
        $workingKey = '3C095C0C179A18E2823E067C3D17CE98';  //Working Key should be provided here.
        $encResponse = $_POST["encResp"];   //This is the response sent by the CCAvenue Server
        $rcvdString = decrypt($encResponse, $workingKey);  //Crypto Decryption used as per the specified working key.

        $order_status = "";
        $decryptValues = explode('&', $rcvdString);
        $dataSize = sizeof($decryptValues);

        for ($i = 0; $i < $dataSize; $i++) {
            $information = explode('=', $decryptValues[$i]);
            if ($i == 3) {
                $order_status = $information[1];
            }
        }
        $payment_data = $this->session->userdata('payment_data');
//        echo "<pre>";
//        print_r($payment_data);
//        exit();
        $this->User_activity->insert_user_activity();
        $logged_in_user_data = $this->session->userdata('logged_in_user_data');
        $data['logged_in_user_data'] = $logged_in_user_data;

        $membership_plan_id = $this->session->userdata('membership_plan_id');

        $business_provider_id = $this->session->userdata('business_provider_id');
        $business_service_id = $this->session->userdata('business_service_id');

        if ($membership_plan_id != '') {
            $service_type = 'Monthly';
        } else {
            $service_type = 'Hourly';
        }

        if ($payment_data['payment_mode'] == 'Pay at venue') {
            $data['other_information'] = 'Other Information';
        } else {
            $order_status = $order_status;
            $data['other_information'] = $rcvdString;
        }
        $data['order_status'] = $order_status;
        $data['payment_data'] = $payment_data;
        $data['service_type'] = $service_type;
        $data['membership_plan_id'] = $membership_plan_id;
        $data['business_provider_id'] = $business_provider_id;
        $data['business_service_id'] = $business_service_id;

        $transaction_id_array = explode('=', $decryptValues[1]);
        $transaction_id = $transaction_id_array[1];

        $data['transaction_id'] = $transaction_id;
        $this->session->set_userdata('transaction_id', $transaction_id);
        $data['order_id'] = $this->session->userdata('order_id');
        $data['booking_id'] = $this->session->userdata('booking_id');
        $data['membership_details'] = $this->Business_offering->get_membership_details($membership_plan_id);
//        echo "<pre>";
//        print_r($data);
//        exit();




        $this->Bookings->insert_transaction_details($data);
        redirect("/payment_success");
    }

    public function payment_failure() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $booking_time = $this->session->userdata('booking_time');
        $booking_timings = explode('/', $booking_time);
        $choosed_booking_time = $booking_timings[1];
        $choosed_booking_date = $this->session->userdata('choosed_booking_date');
        $business_provider_id = $this->session->userdata('business_provider_id');
        $business_service_id = $this->session->userdata('business_service_id');
        $data['business_provider_details'] = $this->Business->get_business_provider_details($business_provider_id);
        $data['get_offering_service_details'] = $this->Business_offering->get_business_offering_service_details($business_service_id);
        $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
        $data['choosed_booking_date'] = $choosed_booking_date;
        $data['choosed_booking_time'] = $choosed_booking_time;
        $data['title'] = "ZingUpLife | Booking Failure";
        $data['main_content'] = 'booking_failure';
        $this->load->view('includes/template', $data);
    }

    public function add_to_calendar() {
        $app_path = APPPATH;
        include($app_path . 'add-to-calendar/addToCalendar.php');
    }

    public function pay_at_venue() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();

        $membership_plan_id = $this->session->userdata('membership_plan_id');

        $business_provider_id = $this->session->userdata('business_provider_id');
        $business_service_id = $this->session->userdata('business_service_id');
        $payment_data = $this->session->userdata('payment_data');
        if ($membership_plan_id != '') {
            $service_type = 'Monthly';
        } else {
            $service_type = 'Hourly';
        }
        $order_status = "Success";
        $data['other_information'] = 'Other Information';
        $data['order_status'] = $order_status;
        $data['payment_data'] = $payment_data;
        $data['service_type'] = $service_type;
        $data['membership_plan_id'] = $membership_plan_id;
        $data['business_provider_id'] = $business_provider_id;
        $data['business_service_id'] = $business_service_id;
        $transaction_id = time();
        $data['transaction_id'] = $transaction_id;
        $this->session->set_userdata('transaction_id', $transaction_id);
        $data['order_id'] = $this->session->userdata('order_id');
        $data['booking_id'] = $this->session->userdata('booking_id');
        $data['membership_details'] = $this->Business_offering->get_membership_details($membership_plan_id);
        $this->Bookings->insert_transaction_details($data);
        redirect("/payment_success");
    }

    public function booking_success() {
        $this->User_activity->insert_user_activity();
        $logged_in_user_data = $this->session->userdata('logged_in_user_data');
        $membership_plan_id = $this->session->userdata('membership_plan_id');

        $business_provider_id = $this->session->userdata('business_provider_id');
        $business_service_id = $this->session->userdata('business_service_id');
        $payment_data = $this->session->userdata('payment_data');

        $data['payment_data'] = $payment_data;
        $data['logged_in_user_data'] = $logged_in_user_data;

        $data['membership_plan_id'] = $membership_plan_id;
        $data['business_provider_id'] = $business_provider_id;
        $data['business_service_id'] = $business_service_id;

        $data['transaction_id'] = $this->session->userdata('transaction_id');

        $data['order_id'] = $this->session->userdata('order_id');
        $data['booking_id'] = $this->session->userdata('booking_id');
        $data['business_provider_details'] = $this->Business->get_business_provider_details($business_provider_id);
        $data['get_offering_service_details'] = $this->Business_offering->get_business_offering_service_details($business_service_id);
        $data['slot_details'] = $this->Bookings->get_slot_details($payment_data['slot_id']);
        $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
        $data['service_image_path'] = base_url() . $this->config->item('business_services_gallery_path');
        $data['tax'] = $this->config->item('service_tax');
        $order_status = 'success';
        $data['order_status'] = $order_status;
        if (strtolower($order_status) == "success") {
            if ($data['get_offering_service_details']['details']->discount != '') {
                $choosed_booking_date = $payment_data['date'];
                $discount_start_date = $data['get_offering_service_details']['details']->discount_start_date;
                $discount_end_date = $data['get_offering_service_details']['details']->discount_end_date;
                $data['discount'] = self::check_in_range($discount_start_date, $discount_end_date, $choosed_booking_date);
            }
            $data['membership_details'] = $this->Business_offering->get_membership_details($membership_plan_id);
            $data['title'] = "ZingUpLife | Booking Success";

            $data['main_content'] = 'checkout_success';
            $this->load->view('includes/menu_template', $data);
        } else {
            redirect("/paymentFailure");
        }
    }

    public function get_available_slots_by_date() {
        $data = $this->input->post();
        $slots = $this->Business_offering->get_slots_by_date($data);
        $slots_array = array();
        foreach ($slots as $key => $value) {
            $slots_array[$key]->id = $value->id;
            $slots_array[$key]->service_id = $value->service_id;
            $slots_array[$key]->date = $value->date;
            $slots_array[$key]->start_time = date('H:i', strtotime($value->start_time));
            $slots_array[$key]->end_time = date('H:i', strtotime($value->end_time));
            $slots_array[$key]->number_of_slots = $value->number_of_slots;
            $slots_array[$key]->service_type = $value->service_type;
            $slots_array[$key]->active = $value->active;
        }
        if (!empty($slots_array)) {
            echo json_encode($slots_array);
        } else {
            echo json_encode("no slots");
        }
    }
	
	public function call_reschedule_order() {
		$this->load->model('Expert');
        $this->User_activity->insert_user_activity();
        $id = $this->uri->segment(2);
        $logged_in_user_data = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_data->is_logged_in == 1) {
			$smeuserid = $this->Expert->getSMEuserid($id);
			$data['added_slots'] = $this->Expert->getaddedslots($smeuserid);
			$data['blocked_slots'] = $this->Expert->getblockedslots($smeuserid);
            $data['booked_id'] = $id;
			$data['sme_userid'] = $smeuserid;
			$data['call_details'] = $this->Expert->getCalldetails($id);
            $data['logged_in_user_data'] = $logged_in_user_data;
            $data['main_content'] = 'call_reschedule';
			$data['title'] = "ZingUpLife | Reschedule";
            $this->load->view('includes/call_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/login");
        }
    }

}
