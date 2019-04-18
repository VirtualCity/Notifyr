<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 8/5/14
 * Time: 5:48 PM
 */

class Autoreplies extends Admin_Controller{
    function __construct(){
        parent::__construct();

    }

    function index(){


        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Auto Reply SMS";
        $data['mainContent'] = 'logs/view_autoreply';
        $this->load->view('templates/template', $data);
    }

    function datatable(){

        $role = $this->session->userdata('role');
        $userfactory = $this->session->userdata('factory');
        if($role === "SUPER_USER"){
            $this->datatables->select("id,sent_to,recipient,message,created")
            ->unset_column('id')
            ->from('smsout')
			->where('message_type','AUTO_REPLY_SMS');
            echo $this->datatables->generate();
        }else{
            $this->datatables->select("id,sent_to,recipient,message,created")
            ->unset_column('id')
            ->from('smsout')
            ->where('factory_id', $userfactory)
			->where('message_type','AUTO_REPLY_SMS');
            echo $this->datatables->generate();
        }
    }


}