<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 8/5/14
 * Time: 5:48 PM
 */

class Replied extends MY_Controller{
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
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Messages Replied";
        $data['mainContent']='reports/view_Replied';
        $this->load->view('templates/template',$data);
    }

    function datatable(){
        $this->datatables->select('id,sent_to,name,reply,message,sent_by,created')
            ->unset_column('id')
            ->from('replies');

        echo $this->datatables->generate();
    }


}