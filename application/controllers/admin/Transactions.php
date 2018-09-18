<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This class for cutomer support section login and users actions/activities
 * @author Vikrant <vikrant@nuvodev.com>
 * Date:01-09-2015
 * */
class Transactions extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('Transaction');
    }

    /*
     *  Displaying login form 
     */

    public function customer_support_transactions() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['current_date'] = date("Y/m/d");
            $data['end_date'] = date('Y/m/d', strtotime('-30 days'));
            $end_date = $data['current_date'];
            $start_date = $data['end_date']; 
            $all_transactions = $this->Transaction->get_all_transactions($start_date, $end_date);
			//echo "<pre>";print_r($all_transactions);exit();
            $data['start_date'] = $end_date;
            $data['end_date'] = $start_date;
            $data['all_transactions'] = $all_transactions;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'customer_support/transactions';
            $data['title'] = 'Zingup Customer Support | Transactions';
            $data['main_content'] = 'admin/customer_support_transactions';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */

    /*
     *  Displaying login form 
     */

    public function customer_support_transactions_filter() {
        $post_data = $_POST;
        $data['current_date'] = $post_data['end_date'];
        $data['end_date'] = $post_data['start_date'];
        $end_date = $data['current_date'];
        $start_date = $data['end_date'];
        $all_transactions = $this->Transaction->get_all_transactions($start_date, $end_date);
        echo json_encode($all_transactions);
    }

    /* Above function ends here */

    /**
     * customer support transactions search
     */
    public function customer_support_transactions_search() {
        $data = $this->input->post();
        $search_results = $this->Transaction->get_transactions_search($data);
        echo json_encode($search_results);
    }

    /*
     *  Displaying login form 
     */

    public function admin_transactions() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['current_date'] = date("Y/m/d");
            $data['end_date'] = date('Y/m/d', strtotime('-30 days'));
            $end_date = $data['current_date'];
            $start_date = $data['end_date'];
            $all_transactions = $this->Transaction->get_all_transactions($start_date, $end_date);
            $data['start_date'] = $end_date;
            $data['end_date'] = $start_date;
            $data['all_transactions'] = $all_transactions;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/transactions';
            $data['title'] = 'Zingup Admin | Transactions';
            $data['main_content'] = 'admin/super_admin_transactions';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */

    /*
     *  Displaying login form 
     */

    public function admin_transactions_filter() {
        $post_data = $_POST;
        $data['current_date'] = $post_data['end_date'];
        $data['end_date'] = $post_data['start_date'];
        $end_date = $data['current_date'];
        $start_date = $data['end_date'];
        $all_transactions = $this->Transaction->get_all_transactions($start_date, $end_date);
        echo json_encode($all_transactions);
    }

    /* Above function ends here */

    /**
     * customer support transactions search
     */
    public function admin_transactions_search() {
        $data = $this->input->post();
        $search_results = $this->Transaction->get_transactions_search($data);
        echo json_encode($search_results);
    }

    /*
     *  Displaying login form 
     */

    public function finance_transactions() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['current_date'] = date("Y/m/d");

            $this->load->model('Services');
            $data['services'] = $this->Services->get_services_list();
            $this->load->model('Business');
            $data['vendors'] = $this->Business->get_all_business_providers();
            $all_transactions = $this->Transaction->get_all_transactions_for_finance($data['current_date']);
            $data['all_transactions'] = $all_transactions;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'finance/transactions';
            $data['title'] = 'Zingup Finance | Transactions';
            $data['main_content'] = 'admin/finance_transactions';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */


    /*
     *  confirming order 
     */

    public function confirm_order() {
        $value = $this->input->post('value');
        $ids = explode('-', $value);
        $booking_id = $ids[1];
        $confirm_order = $this->Transaction->confirm_order($booking_id);
        if ($confirm_order == 1) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    /* Above function ends here */


    /*
     *  confirming order 
     */

    public function admin_confirm_order() {
        $value = $this->input->post('value');
        $ids = explode('-', $value);
        $booking_id = $ids[1];
        $confirm_order = $this->Transaction->admin_confirm_order($booking_id);
        if ($confirm_order == 1) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    /* Above function ends here */

    /*
     * marking as attend 
     */

    public function mark_attend() {
        $value = $this->input->post('value');
        $ids = explode('-', $value);
        $user_id = $ids[0];
        $slot_id = $ids[2];
        $mark_attend = $this->Transaction->mark_as_attend($user_id, $slot_id);
        if ($mark_attend == 1) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    /* Above function ends here */

    /*
     * marking as attend 
     */

    public function admin_mark_attend() {
        $value = $this->input->post('value');
        $ids = explode('-', $value);
        $user_id = $ids[0];
        $slot_id = $ids[2];
        $mark_attend = $this->Transaction->admin_mark_as_attend($user_id, $slot_id);
        if ($mark_attend == 1) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    /* Above function ends here */


    /*
     *  remind customer
     */

    public function remind_customer() {
        $value = $this->input->post('value');
        $ids = explode('-', $value);
        $user_id = $ids[0];
        $booking_id = $ids[1];
        $slot_id = $ids[2];
        $remind_customer = $this->Transaction->remind_customer($user_id, $booking_id, $slot_id);
        if ($remind_customer == 1) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    /* Above function ends here */

    /*
     *  remind customer
     */

    public function admin_remind_customer() {
        $value = $this->input->post('value');
        $ids = explode('-', $value);
        $user_id = $ids[0];
        $booking_id = $ids[1];
        $slot_id = $ids[2];
        $remind_customer = $this->Transaction->admin_remind_customer($user_id, $booking_id, $slot_id);
        if ($remind_customer == 1) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    /* Above function ends here */

    /*
     *  view order details 
     */

    public function view_order_details() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $booking_id = $this->uri->segment(3);
            $data['order_details'] = $order_details = $this->Transaction->get_order_details($booking_id);
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'customer_support/transactions';
            $data['title'] = 'Zingup Customer Support | Order Details';
            $data['main_content'] = 'admin/order_details';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */


    /*
     *  view order details 
     */

    public function finance_order_details() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $booking_id = $this->uri->segment(3);
            $data['order_details'] = $order_details = $this->Transaction->get_order_details($booking_id);
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'finance/transactions';
            $data['title'] = 'Zingup Finance | Order Details';
            $data['main_content'] = 'admin/finance_order_details';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */


    /*
     *  view order details 
     */

    public function admin_order_details() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $booking_id = $this->uri->segment(3);
            $data['order_details'] = $order_details = $this->Transaction->get_order_details($booking_id);
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/transactions';
            $data['title'] = 'Zingup Admin | Order Details';
            $data['main_content'] = 'admin/admin_order_details';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */


    /*
     *  reschedule order details 
     */

    public function reschedule_order() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $booking_id = $this->uri->segment(3);
            $data['reschedule_details'] = $reschedule_details = $this->Transaction->get_order_details($booking_id);
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'customer_support/transactions';
            $data['title'] = 'Zingup Customer Support | Reschedule Order Details';
            $data['main_content'] = 'admin/reschedule_order';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */


    /*
     *  reschedule order details 
     */

    public function admin_reschedule_order() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $booking_id = $this->uri->segment(3);
            $data['reschedule_details'] = $reschedule_details = $this->Transaction->get_order_details($booking_id);
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/transactions';
            $data['title'] = 'Zingup Admin | Reschedule Order Details';
            $data['main_content'] = 'admin/admin_reschedule_order';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */

    /*
     *  reschedule order date details 
     */

    public function reschedule_date() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $booking_id = $this->uri->segment(3);
            $data['reschedule_details'] = $reschedule_details = $this->Transaction->get_order_details($booking_id);
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'customer_support/transactions';
            $data['title'] = 'Zingup Customer Support | Reschedule Date';
            $data['main_content'] = 'admin/reschedule_date';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */


    /*
     *  reschedule order date details 
     */

    public function admin_reschedule_date() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $booking_id = $this->uri->segment(3);
            $data['reschedule_details'] = $reschedule_details = $this->Transaction->get_order_details($booking_id);
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/transactions';
            $data['title'] = 'Zingup Admin | Reschedule Date';
            $data['main_content'] = 'admin/admin_reschedule_date';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */


    /*
     *  reschedule order time details 
     */

    public function reschedule_time() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');

        if ($logged_in_user_details->is_logged_in == 1) {
            $this->load->model('Bookings');

            $booking_id = $this->uri->segment(3);
            $data['reschedule_details'] = $reschedule_details = $this->Transaction->get_order_details($booking_id);
            $this->load->model('Business_offering');
            $data['business_services_slots'] = $business_services_slots = $this->Business_offering->get_business_services_slots($reschedule_details['transactions']->service_id, $reschedule_details['transactions']->date);

            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'customer_support/transactions';
            $data['title'] = 'Zingup Customer Support | Reschedule Time';
            $data['selected_date'] = $this->session->userdata('selected_date');
            $data['selected_time'] = $this->session->userdata('selected_time');
            if (empty($business_services_slots)) {
                $data['reschedule_message'] = 'No slots available for this date.Please select ' . anchor('customer_support/reschedule_date/' . $booking_id, 'other date', 'class="blue link-small"');
            }

            $data['main_content'] = 'admin/reschedule_time';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/login");
        }
    }

    /* Above function ends here */

    /*
     *  reschedule order time details 
     */

    public function admin_reschedule_time() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $this->load->model('Bookings');

            $booking_id = $this->uri->segment(3);
            $data['reschedule_details'] = $reschedule_details = $this->Transaction->get_order_details($booking_id);
            $this->load->model('Business_offering');
            $data['business_services_slots'] = $business_services_slots = $this->Business_offering->get_business_services_slots($reschedule_details['transactions']->service_id, $reschedule_details['transactions']->date);

            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/transactions';
            $data['title'] = 'Zingup Admin | Reschedule Time';
            $data['selected_date'] = $this->session->userdata('selected_date');
            $data['selected_time'] = $this->session->userdata('selected_time');
            if (empty($business_services_slots)) {
                $data['reschedule_message'] = 'No slots available for this date.Please select ' . anchor('admin/reschedule_date/' . $booking_id, 'other date', 'class="blue link-small"');
            }

            $data['main_content'] = 'admin/admin_reschedule_time';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */

    /*
     *  confirm reschedule order  details 
     */

    public function confirm_reschedule_date() {
        $data['booking_id'] = $booking_id = $this->input->post('booking_id');

        $this->load->model('Business_offering');
        $data['url'] = 'customer_support/transactions';
        $data['title'] = 'Zingup Customer Support | Confirm Reschedule Order';

        $post_data = $this->input->post();
        //echo "<pre>";print_r($post_data);exit();
        $data['change_date'] = 'change_date';
        if ($post_data['submit'] == 'Cancel') {
            redirect('customer_support/reschedule_order/' . $post_data['booking_id']);
        } else {
            $id = $data['booking_id'] = $post_data['booking_id'];
            $data['booking_date'] = $booking_date = $post_data['booking_date'];
            $data['reschedule_start_time'] = $start_time = $post_data['reschedule_start_time'];
            $data['reschedule_end_time'] = $end_time = $post_data['reschedule_end_time'];

            $this->load->model('Bookings');
            $data['reschedule_details'] = $reschedule_details = $this->Transaction->get_order_details($id);
            $data['business_services_slots'] = $this->Business_offering->get_business_services_slots($reschedule_details['transactions']->service_id, $booking_date);
            $data['slot_details'] = $this->Bookings->get_slot_id($reschedule_details['transactions']->service_id, $booking_date, $start_time, $end_time);
            if (!empty($data['slot_details'])) {
                $new_slot_id = $data['new_slot_id'] = $data['slot_details']->id;
            } else {
                $new_slot_id = '';
            }
            $logged_in_user_details = $this->session->userdata('logged_in_user_data');
            $data['logged_in_user_details'] = $logged_in_user_details;
            if ($logged_in_user_details->is_logged_in == 1) {
                if ($new_slot_id == '') {
                    $this->session->set_flashdata('reschedule_message', 'The date you selected has no slots available.Please select other date');
                    redirect('customer_support/reschedule_date/' . $id);
                } else {

                    $data['main_content'] = 'admin/confirm_reschedule_order';
                    $this->load->view('admin/includes/template', $data);
                }
            } else {
                $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
                redirect("/login");
            }
        }
    }

    /* Above function ends here */


    /*
     *  confirm reschedule order  details 
     */

    public function admin_confirm_reschedule_date() {
        $data['booking_id'] = $booking_id = $this->input->post('booking_id');

        $this->load->model('Business_offering');
        $data['url'] = 'admin/transactions';
        $data['title'] = 'Zingup Admin | Confirm Reschedule Order';

        $post_data = $this->input->post();
        //echo "<pre>";print_r($post_data);exit();
        $data['change_date'] = 'change_date';
        if ($post_data['submit'] == 'Cancel') {
            redirect('/admin/reschedule_order/' . $post_data['booking_id']);
        } else {
            $id = $data['booking_id'] = $post_data['booking_id'];
            $data['booking_date'] = $booking_date = $post_data['booking_date'];
            $data['reschedule_start_time'] = $start_time = $post_data['reschedule_start_time'];
            $data['reschedule_end_time'] = $end_time = $post_data['reschedule_end_time'];

            $this->load->model('Bookings');
            $data['reschedule_details'] = $reschedule_details = $this->Transaction->get_order_details($id);
            $data['business_services_slots'] = $this->Business_offering->get_business_services_slots($reschedule_details['transactions']->service_id, $booking_date);
            $data['slot_details'] = $this->Bookings->get_slot_id($reschedule_details['transactions']->service_id, $booking_date, $start_time, $end_time);
            if (!empty($data['slot_details'])) {
                $new_slot_id = $data['new_slot_id'] = $data['slot_details']->id;
            } else {
                $new_slot_id = '';
            }
            $logged_in_user_details = $this->session->userdata('logged_in_user_data');
            $data['logged_in_user_details'] = $logged_in_user_details;
            if ($logged_in_user_details->is_logged_in == 1) {
                if ($new_slot_id == '') {
                    $this->session->set_flashdata('reschedule_message', 'The date you selected has no slots available.Please select other date');
                    redirect('admin/reschedule_date/' . $id);
                } else {

                    $data['main_content'] = 'admin/admin_confirm_reschedule_order';
                    $this->load->view('admin/includes/template', $data);
                }
            } else {
                $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
                redirect("/admin");
            }
        }
    }

    /* Above function ends here */


    /*
     *  confirm reschedule order  details 
     */

    public function confirm_reschedule_time() {
        $post_data = $this->input->post();
        $data['url'] = 'customer_support/transactions';
        $data['title'] = 'Zingup Customer Support | Confirm Reschedule Time';
        $data['change_time'] = 'change_time';
        if ($post_data['submit'] == 'Cancel') {
            redirect('customer_support/reschedule_order/' . $post_data['booking_id']);
        } else {
            $id = $post_data['booking_id'];
            $data['booking_date'] = $booking_date = $post_data['booking_date'];
            $reschedule_time = $post_data['reschedule_time'];
            $time = explode('/', $reschedule_time);
            $new_slot_id = $data['new_slot_id'] = $time[0];

            $rescheduled_time = explode('-', $time[1]);
            $data['reschedule_start_time'] = $start_time = $rescheduled_time[0];
            $data['reschedule_end_time'] = $end_time = $rescheduled_time[1];
            $logged_in_user_details = $this->session->userdata('logged_in_user_data');
            $data['logged_in_user_details'] = $logged_in_user_details;
            if ($logged_in_user_details->is_logged_in == 1) {

                $this->load->model('Bookings');
                $data['reschedule_details'] = $reschedule_details = $this->Transaction->get_order_details($id);
                $this->load->model('Business_offering');
                $data['business_services_slots'] = $this->Business_offering->get_business_services_slots($reschedule_details['transactions']->service_id, $reschedule_details['transactions']->date);

                $data['reschedule_details'] = $reschedule_details;
                $is_mobile = '0';
                if ($is_mobile == '1') {
                    echo json_encode($data);
                } else {
                    $data['main_content'] = 'admin/confirm_reschedule_order';
                    $this->load->view('admin/includes/template', $data);
                }
            } else {
                $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
                redirect("/login");
            }
        }
    }

    /* Above function ends here */


    /*
     *  confirm reschedule order  details 
     */

    public function admin_confirm_reschedule_time() {
        $post_data = $this->input->post();
        $data['url'] = 'admin/transactions';
        $data['title'] = 'Zingup Admin | Confirm Reschedule Time';
        $data['change_time'] = 'change_time';
        if ($post_data['submit'] == 'Cancel') {
            redirect('admin/reschedule_order/' . $post_data['booking_id']);
        } else {
            $id = $post_data['booking_id'];
            $data['booking_date'] = $booking_date = $post_data['booking_date'];
            $reschedule_time = $post_data['reschedule_time'];
            $time = explode('/', $reschedule_time);
            $new_slot_id = $data['new_slot_id'] = $time[0];

            $rescheduled_time = explode('-', $time[1]);
            $data['reschedule_start_time'] = $start_time = $rescheduled_time[0];
            $data['reschedule_end_time'] = $end_time = $rescheduled_time[1];
            $logged_in_user_details = $this->session->userdata('logged_in_user_data');
            $data['logged_in_user_details'] = $logged_in_user_details;
            if ($logged_in_user_details->is_logged_in == 1) {

                $this->load->model('Bookings');
                $data['reschedule_details'] = $reschedule_details = $this->Transaction->get_order_details($id);
                $this->load->model('Business_offering');
                $data['business_services_slots'] = $this->Business_offering->get_business_services_slots($reschedule_details['transactions']->service_id, $reschedule_details['transactions']->date);

                $data['reschedule_details'] = $reschedule_details;
                $is_mobile = '0';
                if ($is_mobile == '1') {
                    echo json_encode($data);
                } else {
                    $data['main_content'] = 'admin/admin_confirm_reschedule_order';
                    $this->load->view('admin/includes/template', $data);
                }
            } else {
                $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
                redirect("/admin");
            }
        }
    }

    /* Above function ends here */


    /*
     *  Displaying Reschedule success page 
     */

    public function reschedule_success() {
        $this->User_activity->insert_user_activity();
        $post_data = $this->input->post();
        $data['url'] = 'customer_support/transactions';

        $data['title'] = 'Zingup Customer Support | Reschedule order Sucsess';
        if ($post_data['submit'] == 'Cancel') {
            if ($post_data['change_date'] != "") {
                redirect('customer_support/reschedule_date/' . $post_data['booking_id']);
            } else {
                redirect('customer_support/reschedule_time/' . $post_data['booking_id']);
            }
        } else {
            $data['logged_in_user_details'] = $logged_in_user_details = $this->session->userdata('logged_in_user_data');
            if ($logged_in_user_details->is_logged_in == 1) {
                $this->load->model('Bookings');
                $data['reschedule_message'] = $this->Transaction->update_order($post_data);
                $reschedule_details = $this->Transaction->get_order_details($post_data['booking_id']);
                $this->load->model('Business_offering');
                $data['business_services_slots'] = $this->Business_offering->get_business_services_slots($reschedule_details['transactions']->service_id, $reschedule_details['transactions']->booking_date);

                $data['reschedule_details'] = $reschedule_details;
                $email_content = $this->load->view('emails/order_success_email', $data, true);
                $to = $logged_in_user_details->username;
                $from = "Zingup";
                $subject = "Zingup Rescheduling order.";
                $message = $email_content;

                $this->Mailing->send_mail($to, $from, $subject, $message);
                if ($reschedule_details['transactions']->start_time >= 12) {
                    $meridian = 'PM';
                } else {
                    $meridian = 'AM';
                }
                $time = date('H:i', strtotime($reschedule_details['transactions']->start_time)) . ' ' . $meridian;
                $messgae_to = '+91' . $logged_in_user_details->phone;
                $sms_content = 'Congratulations! You have rescheduled ' . $reschedule_details['transactions']->services . ' Programme '
                        . 'at ' . $reschedule_details['vendor_details']->name . ', ' . $reschedule_details['vendor_details']->area_name . ' '
                        . 'on Date: ' . date("l, F j, Y", strtotime($reschedule_details['transactions']->date)) . ', '
                        . 'Time: ' . $time . ' Cost: ' . $reschedule_details['transactions']->amount . '. '
                        . 'Show this SMS at counter';
                $this->Mailing->send_sms($messgae_to, $sms_content);
                $is_mobile = '0';
                if ($is_mobile == '1') {
                    echo json_encode($data);
                } else {
                    $data['title'] = 'Zingup Customer Support | Confirm Reschedule';
                    $data['main_content'] = 'admin/reschedule_success';
                    $this->load->view('admin/includes/template', $data);
                }
            } else {
                $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
                redirect("/login");
            }
        }
    }

    /* Above function ends here */


    /*
     *  Displaying Reschedule success page 
     */

    public function admin_reschedule_success() {
        $this->User_activity->insert_user_activity();
        $post_data = $this->input->post();
        $data['url'] = 'admin/transactions';
        $data['title'] = 'Zingup Admin | Reschedule Order Success';
        if ($post_data['submit'] == 'Cancel') {
            if ($post_data['change_date'] != "") {
                redirect('admin/reschedule_date/' . $post_data['booking_id']);
            } else {
                redirect('admin/reschedule_time/' . $post_data['booking_id']);
            }
        } else {
            $data['logged_in_user_details'] = $logged_in_user_details = $this->session->userdata('logged_in_user_data');
            if ($logged_in_user_details->is_logged_in == 1) {
                $this->load->model('Bookings');
                $data['reschedule_message'] = $this->Transaction->update_order($post_data);
                $reschedule_details = $this->Transaction->get_order_details($post_data['booking_id']);
                $this->load->model('Business_offering');
                $data['business_services_slots'] = $this->Business_offering->get_business_services_slots($reschedule_details['transactions']->service_id, $reschedule_details['transactions']->booking_date);

                $data['reschedule_details'] = $reschedule_details;
                $email_content = $this->load->view('emails/order_success_email', $data, true);
                $to = $logged_in_user_details->username;
                $from = "Zingup";
                $subject = "Zingup Rescheduling order.";
                $message = $email_content;

                $this->Mailing->send_mail($to, $from, $subject, $message);
                if ($reschedule_details['transactions']->start_time >= 12) {
                    $meridian = 'PM';
                } else {
                    $meridian = 'AM';
                }
                $time = date('H:i', strtotime($reschedule_details['transactions']->start_time)) . ' ' . $meridian;
                $messgae_to = '+91' . $logged_in_user_details->phone;
                $sms_content = 'Congratulations! You have rescheduled ' . $reschedule_details['transactions']->services . ' Programme '
                        . 'at ' . $reschedule_details['vendor_details']->name . ', ' . $reschedule_details['vendor_details']->area_name . ' '
                        . 'on Date: ' . date("l, F j, Y", strtotime($reschedule_details['transactions']->date)) . ', '
                        . 'Time: ' . $time . ' Cost: ' . $reschedule_details['transactions']->amount . '. '
                        . 'Show this SMS at counter';
                $this->Mailing->send_sms($messgae_to, $sms_content);
                $is_mobile = '0';
                if ($is_mobile == '1') {
                    echo json_encode($data);
                } else {
                    $data['title'] = 'Zingup Admin | Confirm Reschedule';
                    $data['main_content'] = 'admin/admin_reschedule_success';
                    $this->load->view('admin/includes/template', $data);
                }
            } else {
                $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
                redirect("/admin");
            }
        }
    }

    /* Above function ends here */


    /*
     *  download html to pdf for transaction
     */

    public function customer_support_transactions_download() {
        $this->load->helper('pdf_helper');
        tcpdf();
        $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $obj_pdf->SetCreator(PDF_CREATOR);
        $title = "PDF Report";
        $obj_pdf->SetTitle($title);
        $obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
        $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $obj_pdf->SetDefaultMonospacedFont('helvetica');
        $obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $obj_pdf->SetFont('helvetica', '', 9);
        $obj_pdf->setFontSubsetting(false);
        $obj_pdf->AddPage();
        //ob_start();
        // we can have any view part here like HTML, PHP etc
        $data = $this->input->post();

        $content = $data['trans'];
        //ob_end_clean();
        $obj_pdf->writeHTML($content, true, false, true, false, '');
        $obj_pdf->Output('output.pdf', 'I');
    }

    /**
     * Finance transactions search
     */
    public function finance_transactions_listing_filter() {
        $search_data = $this->input->post();
        $search_results = $this->Transaction->finance_transactions_listing_filter($search_data);
        echo json_encode($search_results);
    }

    /**
     * Finance transactions sorting
     */
    public function finance_transactions_listing_sorting() {
        $search_data = $this->input->post();
        $search_results = $this->Transaction->get_all_transactions_for_finance($search_data['current_date']);
        echo json_encode($search_results);
    }

}
