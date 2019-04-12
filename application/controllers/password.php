<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 8/19/14
 * Time: 12:05 PM
 */

class Password extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('user_model');

        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    function index(){


        // SET VALIDATION RULES
        $this->form_validation->set_rules('password', 'Current Password', 'required');
        $this->form_validation->set_rules('npassword', 'New Password', 'required|min_length[6]');
        $this->form_validation->set_rules('cnpassword', 'Confirm New Password', 'required|matches[npassword]');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $appmsg="";
        $alert_type="";

        // has the form been submitted+
        if($this->input->post()){
            //Does it have valid form info (not empty values)
            if($this->form_validation->run()){
                $userid = $this->session->userdata('id');
                $password = $this->input->post('password');
                $npassword = $this->input->post('npassword');

                $pass_matches = $this->user_model->checkPassword($userid, $password);

                if($pass_matches){
                    //Current password matches save new password
                    $saved = $this->user_model->save_password($userid,$npassword);
                    if($saved){
                        // Display success message
                        $this->session->set_flashdata('appmsg', 'Password updated successfully!');
                        $this->session->set_flashdata('alert_type', 'alert-success');
                        $this->session->set_flashdata('alert_type_', 'success');
                        redirect('password');
                    }else{
                        // Display fail message
                        $this->session->set_flashdata('appmsg', 'Failed to change password. Check log file');
                        $this->session->set_flashdata('alert_type', 'alert-danger');
                        $this->session->set_flashdata('alert_type_', 'danger');
                        redirect('password');
                    }

                }else{
                    // Display fail message
                    $this->session->set_flashdata('appmsg', 'The provided Current Password is incorrect');
                    $this->session->set_flashdata('alert_type', 'alert-warning');
                    $this->session->set_flashdata('alert_type_', 'warning');
                    redirect('password');
                }

            }
        }


        //page title
        $data['message']=array($appmsg,$alert_type);
        $data['title'] = 'Change Password';
        $data['user_role'] = $this->session->userdata('role');
        $data['mainContent']='password';
        $this->load->view('templates/template',$data); 

    }
}