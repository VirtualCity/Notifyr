<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 5/19/2015
 * Time: 2:58 PM
 */

class Subscriptions extends Admin_Controller{
    function __construct(){
        parent::__construct();

    }

    function index(){
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "SMS Subscriptions";
        $data['mainContent']='reports/subscriptions';
        $this->load->view('templates/template',$data);

    }

    function datatable(){
        $this->datatables->select('id,msisdn,message,message_type,sms_received.group as groupname,created')
            ->unset_column('id')
            ->from('sms_received')
            ->where('message_type','UNSUBSCRIPTION')
            ->or_where('message_type','SUBSCRIPTION');

        echo $this->datatables->generate();

    }
} 