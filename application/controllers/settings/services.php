<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 10/6/2014
 * Time: 9:30 AM
 */

class Services extends MY_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('settings_m');

        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    function index(){
        $role = $this->session->userdata('role');
        $userfactory = $this->session->userdata('factory');
        // SET VALIDATION RULES
        $this->form_validation->set_rules('qservice', 'Agrimanagr Query Service url', 'required|max_length[150]');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $origin_qservice="";

        // has the form been submitted
        if($this->input->post()){

            $origin_qservice = $this->input->post('qservice');

            //Does it have valid form info (not empty values)
            if($this->form_validation->run()){

                //Save new product
                $saved = $this->settings_m->save_qservice($origin_qservice);

                if($saved){
                    // Display success message
                    $this->session->set_flashdata('appmsg', 'Service URL saved successfully!');
                    $this->session->set_flashdata('alert_type', 'alert-success');
                    $this->session->set_flashdata('alert_type_', 'success');
                    redirect('settings/services');

                }else{
                    // Display fail message
                    $this->session->set_flashdata('appmsg', 'Service URL Not saved! Check logs');
                    $this->session->set_flashdata('alert_type', 'alert-danger');
                    $this->session->set_flashdata('alert_type_', 'error');
                    redirect('settings/services');
                }
            }
        }else{
            // $retrievedData = $this->settings_m->get_qservice();
            $retrievedData = $this->settings_m->get_qservice($userfactory);
            if($retrievedData){
                $origin_qservice=$retrievedData->value1;
            }
        }

        $data['qservice']=$origin_qservice;
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Agrimanagr SMS Service";
        $data['mainContent'] = 'settings/services';
        $this->load->view('templates/template', $data);

    }

}
