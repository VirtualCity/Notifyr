<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 5/19/2015
 * Time: 2:58 PM
 */

class Cummulative extends MY_Controller{
    function __construct(){
        parent::__construct();

    }

    function index(){

        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Cummulative Queries";
        $this->load->view('templates/header', $data);
        $this->load->view('reports/cummulative',$data);

    }

    function datatable(){
        $this->datatables->select('id,msisdn,message,created')
            ->unset_column('id')
            ->from('sms_received')
            ->where('message_type','TOTAL');

        echo $this->datatables->generate();

    }
} 