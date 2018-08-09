<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 10/6/2014
 * Time: 9:30 AM
 */

class Configuration extends Admin_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('settings_m');
        $this->load->model('groups_model');
    }


    function index(){
        // SET VALIDATION RULES
        $this->form_validation->set_rules('appid', 'Application ID', 'required|exact_length[10]|alpha_dash');
        $this->form_validation->set_rules('password', 'Application Password', 'required|max_length[150]|alpha_numeric');
        $this->form_validation->set_rules('shortcode', 'SMS Short Code', 'required|max_length[20]|alpha_dash');
        $this->form_validation->set_rules('keyword', 'SMS Keyword', 'required|max_length[20]|alpha_numeric');
        $this->form_validation->set_rules('shortcodeName', 'Source Address', 'required|max_length[60]|alpha_numeric');
        $this->form_validation->set_rules('subscription', 'Subscription Keyword', 'required|max_length[20]|alpha_numeric');
        $this->form_validation->set_rules('unsubscription', 'Un-subscription Keyword', 'required|max_length[20]|alpha_numeric');
        $this->form_validation->set_rules('groups', 'Products linked Group', 'numeric');
        $this->form_validation->set_rules('smsurl', 'SMS SDP Server URL', 'required|max_length[150]');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $origin_appid="";
        $origin_password="";
        $origin_shortcode="";
        $origin_shortcodeName="";
        $origin_keyword="";
        $origin_smsurl="";
        $subscription_word="";
        $unsubscription_word="";
        $productsgroupid="";

        // has the form been submitted
        if($this->input->post()){

            $origin_appid = $this->input->post('appid');
            $origin_password = $this->input->post('password');
            $origin_shortcode = $this->input->post('shortcode');
            $origin_shortcodeName = $this->input->post('shortcodeName');
            $origin_keyword = $this->input->post('keyword');
            $origin_smsurl = $this->input->post('smsurl');
            $subscription_word = $this->input->post('subscription');
            $unsubscription_word = $this->input->post('unsubscription');
            $productsgroupid = $this->input->post('groups');

            //Does it have valid form info (not empty values)
            if($this->form_validation->run()){

                //Save new product
                $saved = $this->settings_m->save_app_configuration($origin_appid,$origin_password,$origin_shortcode,$origin_keyword,$origin_smsurl,$subscription_word,$unsubscription_word,$productsgroupid,$origin_shortcodeName);

                if($saved){
                    // Display success message
                    $this->session->set_flashdata('appmsg', 'Configuration settings saved successfully!');
                    $this->session->set_flashdata('alert_type', 'alert-success');
                    redirect('settings/configuration');

                }else{
                    // Display fail message
                    $this->session->set_flashdata('appmsg', 'Configuration settings Not saved! Check logs');
                    $this->session->set_flashdata('alert_type', 'alert-danger');
                    redirect('settings/configuration');
                }
            }
        }else{
            $configurationData = $this->settings_m->get_configuration();
            if($configurationData){
                $origin_appid = $configurationData->value1;
                $origin_password = $configurationData->value2;
                $origin_shortcode = $configurationData->value3;
                $origin_keyword = $configurationData->value4;
                $origin_smsurl = $configurationData->value5;
                $subscription_word = $configurationData->value6;
                $unsubscription_word = $configurationData->value7;
                $productsgroupid = $configurationData->value8;
                $origin_shortcodeName = $configurationData->value9;
            }
        }
        $groups = $this->groups_model->get_all_groups();

        $data['groups']=$groups;
        $data['appid']=$origin_appid;
        $data['password']=$origin_password;
        $data['shortcode']=$origin_shortcode;
        $data['keyword']=$origin_keyword;
        $data['smsurl']=$origin_smsurl;
        $data['subscription']=$subscription_word;
        $data['unsubscription']=$unsubscription_word;
        $data['productsgroupid']=$productsgroupid;
        $data['shortcodeName']=$origin_shortcodeName;

        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Configuration Settings";
        $data['mainContent'] = 'settings/app_config';
        $this->load->view('templates/template', $data);
    }

}
