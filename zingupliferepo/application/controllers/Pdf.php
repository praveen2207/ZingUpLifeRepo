<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf extends CI_Controller {

    public function index() {

        $this->load->model('Bookings');
        $this->load->model('Business');
        $this->load->model('Business_offering');
        $id = $this->uri->segment(2);
        $order_details = $data['order_details'] = $this->Bookings->get_order_details($id);
        $data['business_provider_details'] = $this->Business->get_business_provider_details($order_details->provider_id);
        $data['get_transaction_details'] = $this->Business_offering->get_transaction_details($id);
        $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
        $data['logged_in_user_details'] = $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        $data['business_details'] = $this->Bookings->get_business_details($order_details->provider_id);
        if ($logged_in_user_details->is_logged_in == 1) {
            $html = $this->load->view('pdf', $data, true);
            require_once('./html2pdf/html2pdf.class.php');
            $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8');
            $html2pdf->pdf->SetDisplayMode('fullpage');
            header("Content-type:application/pdf");
            $html2pdf->WriteHTML($html);
            $html2pdf->Output("order_details.pdf", 'D');
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/login");
        }
    }

}

?>
