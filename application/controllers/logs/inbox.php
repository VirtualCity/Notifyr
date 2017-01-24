<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 8/5/14
 * Time: 5:48 PM
 */

class Inbox extends Admin_Controller{
    function __construct(){
        parent::__construct();
        $this->load->library('sms/SmsSender.php');
        $this->load->model('sendsms_model');
        $this->load->model('reports_m');

        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    function index(){

        $data['base']=$this->config->item('base_url');
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "SMS Inbox";
        $data['mainContent'] = 'logs/view_inbox';
        $this->load->view('templates/template', $data);
 
    }

    function datatable(){
        $this->datatables->select('sms_received.id AS id, sms_received.group as groupname, name,sms_received.msisdn AS msisdn, message,message_type, sms_received.status As status, sms_received.created AS created')
            ->unset_column('id')
            ->add_column('actions', get_received_messages_buttons('$1'), 'id')
            ->from('sms_received LEFT JOIN contacts USING (msisdn)');

        echo $this->datatables->generate();
    }


}