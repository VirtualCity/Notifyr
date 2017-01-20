<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 5/19/2015
 * Time: 2:58 PM
 */

class Bulksms extends MY_Controller{
    function __construct(){
        parent::__construct();

    }

    function index(){

        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Bulk Alerts Sent";
        $this->load->view('templates/header', $data);
        $this->load->view('reports/bulksms',$data);

    }


    function datatable(){

        $this->datatables->select("smsout.id AS id, recipient, message, CONCAT(users.fname,' ',users.surname,' ',users.oname) AS name, smsout.created AS created",FALSE)
            ->unset_column("id")
            ->from('smsout')
            ->where('message_type ','BULK_SMS')
            ->join('users','smsout.sent_by = users.id');


        echo $this->datatables->generate();

    }




} 