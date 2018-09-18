<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This class for cutomer support section login and users actions/activities
 * @author Vikrant <vikrant@nuvodev.com>
 * Date:01-09-2015
 * */

require APPPATH . 'third_party/PHPMailer/PHPMailerAutoload.php';

class Org_access_code extends CI_Controller {

	public function __construct() {
		parent:: __construct();
		$this->load->model('Org_access_code_model');
	}

	public function index(){
		$logged_in_user_details = $this->session->userdata('logged_in_user_data');
		if ($logged_in_user_details->is_logged_in == 1) {

		if($this->session->flashdata("error_message")=="success"){
			$data["message"]="Mail has been sent to organization/company with access code!";
		}elseif($this->session->flashdata("error_message")=="failed"){
			$data["error_message"]="Mail hasn't been sent to organization";
		}
		$data['logged_in_user_details'] = $logged_in_user_details;
		$data['url']="admin/Org_access_code";
		$data['title'] = 'Zingup org access code | Manage access code';
		$data['main_content'] = 'admin/org_access_code';
		$this->load->view('admin/includes/template',$data);
		} else {
			$this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
			redirect("/admin");
		}

	}

	public function add_access_code(){
		$post_data=$_POST;
		$company_name=$post_data["company_name"];
		$no_of_access_code=$post_data["no_of_access_code"];//$post_data["no_of_access_code"];
		$org_email_id=$post_data["company_email_id"];
		for($i=0;$i<$no_of_access_code;$i++){
			$access_code=rand(100000,999999);
			$status=$this->Org_access_code_model->check_availability_of_access_code($access_code);
			if($status==false){
				$access_code_list[]=$access_code;
			}else{
				$no_of_access_code++;
			}
		}

		$insert_status=$this->Org_access_code_model->add_access_code($access_code_list,$company_name);
		$this->load->library("Excel");
		$object = new PHPExcel();

		$object->setActiveSheetIndex(0);

		$table_columns = array("Sr. No.", "Access Code");

		$column = 0;

		foreach($table_columns as $field)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
			$column++;
		}

		$excel_row = 2;
		$count=1;
		$i=0;

		foreach($access_code_list as $row)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $count);
			$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row);
			$excel_row++;
			$count++;
			$i++;
		}

		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		ob_start();
		$object_writer->save('php://output');
		$excelOutput = ob_get_clean();
		ob_end_clean();

		$mail = new PHPMailer();

		//$mail->SMTPDebug = 3;                               // Enable verbose debug output
        /*
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'systems@zinguplife.com';                 // SMTP username
		$mail->Password = 'zinguplife01$';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to
        */
		$mail->setFrom('systems@zinguplife.com', 'Zinguplife');
		$mail->addAddress($org_email_id);     // Add a recipient
		//$mail->addAddress('ellen@example.com');               // Name is optional
		$mail->addReplyTo('systems@zinguplife.com','Accesscode reply');
		$mail->addCC('systems@zinguplife.com');
		//$mail->addBCC('bcc@example.com');

		$mail->AddStringAttachment($excelOutput,'Employee_Acess_Code.xls');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Employee Access Code';
		$mail->Body    = 'Employee\'s Access codes are in attachment';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
			$this->session->set_flashdata('error_message',"failed");
			//'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			$this->session->set_flashdata('error_message',"success");
		}
		redirect("/admin/Org_access_code");
	}
}