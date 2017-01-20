<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 8/5/14
 * Time: 5:48 PM
 */

class Sent extends Reports_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('reports_m');
        $this->load->model('sms_model');

        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    function index(){

        $data['base']=$this->config->item('base_url');
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "SMS Sent";
        $this->load->view('templates/header', $data);
        $this->load->view('sms/view_sent',$data);
    }

    function datatable(){
        $this->datatables->select("smsout.id,smsout.sent_to,smsout.recipient,smsout.message,smsout.message_type,CONCAT(users.fname,' ',users.surname,' ',users.oname) AS name,smsout.created",FALSE)
            ->unset_column('smsout.id')
            ->from('smsout')
			->join('users','smsout.sent_by = users.id');

        echo $this->datatables->generate();
    }


}