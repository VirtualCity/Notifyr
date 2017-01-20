<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 8/1/14
 * Time: 1:56 AM
 */

class Blacklist extends Admin_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('blacklist_model');
        $this->load->helper('buttons_helper');
        $this->load->database();

        //Prevent caching and back button
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    function index(){
        if(!$this->session->userdata('logged_in')){
            redirect('login');
            //echo("You are NOT logged in");
        }


        $data['base']=$this->config->item('base_url');
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Blacklisted Numbers";
        $this->load->view('templates/header', $data);
        $this->load->view('blacklist',$data);
    }

    function datatable(){
        $this->datatables->select('id,msisdn,created')
            ->unset_column('id')
            ->add_column('actions', get_blacklist_buttons('$1'), 'id')
            ->from('blacklist');

        echo $this->datatables->generate();
    }


    function remove($id){

        if(!empty($id)){
            //retrieve the msisdn for the recipient
            $this->blacklist_model->remove_contact($id);
            redirect('blacklist');

        }
    }
}