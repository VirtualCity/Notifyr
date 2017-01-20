<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 7/31/14
 * Time: 4:06 PM
 */

class Newsms extends Admin_Controller{
    function __construct(){
        parent::__construct();
        $this->load->library('sms/SmsSender.php');
        $this->load->model('sms_model');
        $this->load->model('sendsms_model');


    }

    public function index(){
		//check if user and redirect to dashboard
		$role = $this->session->userdata('role');
        if($role==="USER"){
			// Display message
            $this->session->set_flashdata('appmsg', 'You are not allowed to access this function');
            $this->session->set_flashdata('alert_type', 'alert-info');
			redirect('dashboard');
		}

        // SET VALIDATION RULES
        $this->form_validation->set_rules('msisdn', 'Mobile Number', 'required|numeric|exact_length[12]|callback_msisdn_check');
        $this->form_validation->set_rules('message', 'Message', 'required|max_length[160]');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $msisdn="";
        $message="";

        // has the form been submitted
        if($this->input->post()){
            $msisdn = $this->input->post('msisdn');
            $message = $this->input->post('message');

            //Does it have valid form info (not empty values)
            if($this->form_validation->run()){
                //Send message
                $recipients= array('tel:'.$msisdn);
                $msg_sent= $this->sendsms_model->send_sms($recipients,$message);

                log_message("info","Sending status: ".$msg_sent);

                if($msg_sent=='success'){
                    // Display success message
                    $this->session->set_flashdata('appmsg', 'Message to '.$msisdn.' sent successfully!');
                    $this->session->set_flashdata('alert_type', 'alert-success');

                    //save sms
                    $userid = $this->session->userdata('id');
                    $this->sms_model->save_sms($msisdn,"Individual",$message,$userid);

                    redirect('sms/newsms');
                }else{
                    // Display fail message
                    $this->session->set_flashdata('appmsg', 'Message to '.$msisdn.' failed.');
                    $this->session->set_flashdata('alert_type', 'alert-danger');
                    redirect('sms/newsms');
                }


            }
        }

        $data['msisdn']=$msisdn;
        $data['message']=$message;


        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "New SMS";
        $this->load->view('templates/header', $data);
        $this->load->view('sms/newsms',$data);
    }

    function msisdn_check($str){
        $pos = strpos($str,'254');

        if ($pos !== 0){
            //Number does not have 254
            $this->form_validation->set_message('msisdn_check', 'Mobile number has to start with 254 prefix, eg 25472xxxxxxx');
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

}