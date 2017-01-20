<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 8/4/14
 * Time: 1:09 AM
 */

class Suspenduser extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('user_model');

        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");


    }

    function index($id){
        $current_user_id = $this->session->userdata('id');

        if($current_user_id==$id){
            $message= "You cannot suspend your own account";
        }else{
            $suspended = $this-> user_model -> suspend_user($id);
            if($suspended){
                $message= "You cannot susspend your own account";
            }else{
                $message= "Failed to suspend user!";
            }
        }


        //Get all active users
        $active_users = $this -> user_model->get_active_users();
        $data['active_users'] = $active_users;

        //Get all suspended users
        $suspended_users = $this -> user_model->get_suspended_users();
        $data['suspended_users'] = $suspended_users;

        $data['user_role'] = $this->session->userdata('role');
        $data['base']=$this->config->item('base_url');
        $data['title'] = "Users";
        $data['message'] = $message;
        $this->load->view('templates/header', $data);
        $this->load->view('users',$data);
    }
}