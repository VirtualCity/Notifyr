<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 5/19/2015
 * Time: 2:58 PM
 */

class Subscribed extends Admin_Controller{
    function __construct(){
        parent::__construct();

    }

    function index(){


        $data['base']=$this->config->item('base_url');
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Subscribed Contacts";
        $data['mainContent'] = 'reports/subscribed';
        $this->load->view('templates/template', $data);
       
    }

    function datatable(){
        $this->datatables->select('group_contacts.id AS id,msisdn,name,group_contacts.created AS created')
            ->unset_column('id')
            ->from('group_contacts LEFT JOIN groups ON group_contacts.groupid = groups.id');

        echo $this->datatables->generate();

    }
} 