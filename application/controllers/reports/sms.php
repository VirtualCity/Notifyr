<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 8/5/14
 * Time: 5:48 PM
 */

class Sms extends Reports_Controller{
    function __construct(){
        parent::__construct();

        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    function index(){

        $data['base']=$this->config->item('base_url');
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Single Alerts Sent";
        $this->load->view('templates/header', $data);
        $this->load->view('reports/sms',$data);
    }

    function datatable(){
        $this->datatables->select("smsout.id AS id, sent_to, recipient, message, CONCAT(users.fname,' ',users.surname,' ',users.oname) AS name, smsout.created AS created",FALSE)
            ->unset_column("id")
            ->from('smsout')
            ->where('message_type ','SINGLE_SMS')
            ->join('users','smsout.sent_by = users.id');

        echo $this->datatables->generate();
    }


}