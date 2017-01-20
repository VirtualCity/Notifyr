<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 12/1/2014
 * Time: 10:29 AM
 */

class Error_404 extends MY_Controller{
    public function __construct() {
        parent::__construct();
    }

    public function index(){
        $this->output->set_status_header('404');
        $data['base']=$this->config->item('base_url');
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Error 404";
        $this->load->view('templates/header', $data);
        $this->load->view('errors/404',$data);//loading in my template
    }
}