<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 7/31/14
 * Time: 4:06 PM
 */

class Addblacklist extends Admin_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('blacklist_model');

        //Prevent caching and back button
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    public function index(){
        if(!$this->session->userdata('logged_in')){
            redirect('/login');
            //echo("You are NOT logged in");
        }

        // SET VALIDATION RULES
        $this->form_validation->set_rules('msisdn', 'Mobile Number', 'required|numeric|exact_length[12]|callback_checkmsisdn');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $appmsg="";
        $alert_type="";

        // has the form been submitted
        if($this->input->post()){
            //Does it have valid form info (not empty values)
            if($this->form_validation->run()){
                // get username and password
                $msisdn = $this->input->post('msisdn');

                $exists= $this->blacklist_model->check_contact($msisdn);

                if(!$exists){
                    $saved= $this->blacklist_model->blacklist($msisdn);

                    if($saved){
                        // Display success message
                        $this->session->set_flashdata('appmsg', 'Mobile Number '.$msisdn.' successfully added to blacklist.!');
                        $this->session->set_flashdata('alert_type', 'alert-success');
                        redirect('addblacklist');

                    }else{
                        // Display fail message
                        $this->session->set_flashdata('appmsg', 'Problem encountered while blacklisting number. Check logs');
                        $this->session->set_flashdata('alert_type', 'alert-warning');
                        redirect('addblacklist');
                    }

                }else{
                    // Display fail message
                    $this->session->set_flashdata('appmsg', 'This Mobile Number: '.$msisdn.' already exists in blacklist. ');
                    $this->session->set_flashdata('alert_type', 'alert-warning');
                    redirect('addblacklist');
                }

            }
        }


        $data['message']=array($appmsg,$alert_type);
        $data['base']=$this->config->item('base_url');
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "BlackList Number";
        $this->load->view('templates/header', $data);
        $this->load->view('blacklistnumber',$data);
    }

    function checkmsisdn($msisdn){
        if(substr($msisdn,0,3)==='254'){
            log_message('info','substring is: '.substr($msisdn,0,3));
            return true;
        }else{
            $this->form_validation->set_message('checkmsisdn', 'Mobile number need to start with "254"');
            return false;
        }
    }

}