<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 10/6/2014
 * Time: 9:30 AM
 */

class Email extends MY_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('settings_m');

        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }


    function index(){
        // SET VALIDATION RULES
        $this->form_validation->set_rules('email', 'Email', 'required|max_length[100]|valid_email');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $origin_email="";

        // has the form been submitted
        if($this->input->post()){

            $origin_email = $this->input->post('email');

            //Does it have valid form info (not empty values)
            if($this->form_validation->run()){

                //Save new product
                $saved = $this->settings_m->save_email($origin_email,null);

                if($saved){
                    // Display success message
                    $this->session->set_flashdata('appmsg', 'Email saved successfully!');
                    $this->session->set_flashdata('alert_type', 'alert-success');
                    $this->session->set_flashdata('alert_type_', 'success');
                    redirect('settings/email');

                }else{
                    // Display fail message
                    $this->session->set_flashdata('appmsg', 'Email Not saved! Check logs');
                    $this->session->set_flashdata('alert_type', 'alert-danger');
                    $this->session->set_flashdata('alert_type_', 'error');
                    redirect('settings/email');
                }
            }
        }else{
            $emailData = $this->settings_m->get_email();
            if($emailData){
                $origin_email=$emailData->value1;
            }
        }

        $data['email']=$origin_email;
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Email Settings";
        $this->load->view('templates/header', $data);
        $this->load->view('settings/email',$data);

    }

}
