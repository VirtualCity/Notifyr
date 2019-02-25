<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 7/31/14
 * Time: 4:06 PM
 */

class Newsms extends Admin_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> library('sms/SmsSender.php');
		$this -> load -> model('sms_model');
		$this -> load -> model('sendsms_model');
		$this -> load -> model('template_model');
		 $this->load->helper('buttons_helper');
	}

	public function index() {
		//check if user and redirect to dashboard
		$role = $this -> session -> userdata('role');
		if ($role === "USER") {
			// Display message
			$this -> session -> set_flashdata('appmsg', 'You are not allowed to access this function');
			$this -> session -> set_flashdata('alert_type', 'alert-info');
			redirect('dashboard');
		}

		// SET VALIDATION RULES
		$this -> form_validation -> set_rules('msisdn', 'Mobile Number', 'required|numeric|exact_length[12]|callback_msisdn_check');
		$this -> form_validation -> set_rules('message', 'Message', 'required|max_length[480]');
		$this -> form_validation -> set_error_delimiters('<div class="error">', '</div>');

		$msisdn = "";
		$message = "";

		// has the form been submitted
		if ($this -> input -> post()) {
			$msisdn = $this -> input -> post('msisdn');
			$message = $this -> input -> post('message');

			//Does it have valid form info (not empty values)
			if ($this -> form_validation -> run()) {
				//Send message
				//$recipients = array('tel:' . $msisdn);
				$recipients = array($msisdn);
				$msg_sent = $this -> sendsms_model -> send_sms($recipients, $message);

				log_message("info", "Sending status: " . $msg_sent);

				if ($msg_sent == 'success') {
					// Display success message
					$this -> session -> set_flashdata('appmsg', 'Message to ' . $msisdn . ' sent successfully!');
					$this -> session -> set_flashdata('alert_type', 'alert-success');

					//save sms
					$userid = $this -> session -> userdata('id');
					$this -> sms_model -> save_sms($msisdn, "Individual", $message, $userid);

					redirect('sms/newsms');
				} else {
					// Display fail message
					$this -> session -> set_flashdata('appmsg', 'Message to ' . $msisdn . ' failed.');
					$this -> session -> set_flashdata('alert_type', 'alert-danger');
					redirect('sms/newsms');
				}

			}
		}

		$data['msisdn'] = $msisdn;
		$data['message'] = $message;

		$data['user_role'] = $this -> session -> userdata('role');
		$data['title'] = "New SMS";
		$data['mainContent'] = 'sms/newsms';

		$this -> load -> view('templates/template', $data); 

	}

	function msisdn_check($str) {
		$pos = strpos($str, '254');

		if ($pos !== 0) {
			//Number does not have 254
			$this -> form_validation -> set_message('msisdn_check', 'Mobile number has to start with 254 prefix, eg 25472xxxxxxx');
			return FALSE;
		} else {
			return TRUE;
		}
	}

  function datatable(){
        $this->datatables->select('id,title,template,type,modified')
            ->unset_column('id')
            ->add_column('actions', get_view_templates_buttons('$1'), 'id')
            ->from('sms_templates');
        echo $this->datatables->generate();
    }

public function templates()
{
	 $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "SMS Templates";
         $data['mainContent']='sms/view_templates';
        $this->load->view('templates/template', $data);
}
	public function smstemplate() {

		$data['type'] = "";
		$data['template'] = "";
		$data['title_'] = '';
		$data['id'] = "";
		$data['user_role'] = $this -> session -> userdata('role');
		$data['title'] = "New SMS Template";
		$data['is_edit']=false;
		
		$data['mainContent'] = 'sms/smstemplate';

		$this -> load -> view('templates/template', $data);
	}

	function edittemplate($id = null) {

		if (!empty($id)) {
			//retrieve template to edit
			$to_edit = $this -> template_model -> get_template(trim($id));
 
			$data['id'] = $id;
			$data['title_'] = $to_edit -> title;
			$data['template'] = $to_edit -> template;
			$data['type'] = $to_edit -> type;

			$data['user_role'] = $this -> session -> userdata('role');
			$data['title'] = "Edit SMS Template";
			$data['mainContent'] = 'sms/smstemplate';
			$data['is_edit']=true;
			$this -> load -> view('templates/template', $data);

		} else {
			// No template id specified
			$this -> session -> set_flashdata('appmsg', 'An Error Was Encountered! No identifier provided ');
			$this -> session -> set_flashdata('alert_type', 'alert-danger');
			redirect('newsms/templates');
		}
	}

	function savetemplate() {

		// SET VALIDATION RULES
		$this -> form_validation -> set_rules('title_', 'Title', 'required|max_length[140]|is_unique[sms_templates.title]');
		$this -> form_validation -> set_rules('template', 'Template Name', '|max_length[200]|is_unique[sms_templates.template]');
		$this -> form_validation -> set_rules('type', 'Type', 'required');
		$this -> form_validation -> set_error_delimiters('<div class="error">', '</div>');

		if ($this -> input -> post()) {
			$title = $this -> input -> post('title_');
			$template = $this -> input -> post('template');
			$type = $this -> input -> post('type');

			//Does it have valid form info (not empty values)
			if ($this -> form_validation -> run()) {

				$saved = $this -> template_model -> create_template($title, $template, $type);
				log_message("info", "saving template: " . $title);

				if ($saved) {
					// Display success message
					$this -> session -> set_flashdata('appmsg', 'Template ' . $title . ' saved successfully!');
					$this -> session -> set_flashdata('alert_type', 'alert-success');

					redirect('sms/newsms/smstemplate');
				} else {
					// Display fail message
					$this -> session -> set_flashdata('appmsg', 'Saving template ' . $title . ' failed.');
					$this -> session -> set_flashdata('alert_type', 'alert-danger');
					redirect('sms/newsms/smstemplate');
				}

			}
		}
	}function updatetemplate() {

		// SET VALIDATION RULES
		$this -> form_validation -> set_rules('title_', 'Title', 'required|max_length[140]');
		$this -> form_validation -> set_rules('template', 'Template Name', '|max_length[200]');
		$this -> form_validation -> set_rules('type', 'Type', 'required');
		$this -> form_validation -> set_rules('id', 'id', 'required|integer');
		$this -> form_validation -> set_error_delimiters('<div class="error">', '</div>');

		if ($this -> input -> post()) {
			$title = $this -> input -> post('title_');
			$template = $this -> input -> post('template');
			$type = $this -> input -> post('type');
			$id= $this -> input -> post('id');

			//Does it have valid form info (not empty values)
			if ($this -> form_validation -> run()) {

				$saved = $this -> template_model ->  update_template($id, $title, $template, $type);
				log_message("info", "updating template: " . $title);

				if ($saved) {
					// Display success message
					$this -> session -> set_flashdata('appmsg', 'Template ' . $title . ' updated successfully!');
					$this -> session -> set_flashdata('alert_type', 'alert-success');

					redirect('sms/newsms/smstemplate');
				} else {
					// Display fail message
					$this -> session -> set_flashdata('appmsg', 'Updating template ' . $title . ' failed.');
					$this -> session -> set_flashdata('alert_type', 'alert-danger');
					redirect('sms/newsms/smstemplate');
				}

			}
		}
	}

}
