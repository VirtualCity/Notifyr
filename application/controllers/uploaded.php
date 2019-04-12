<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 11/17/2014
 * Time: 2:05 PM
 */

class Uploaded extends CI_Controller{
    function __construct(){
        parent::__construct();

    }


    function index(){

        /*try{
            if($this->input->post()){
                log_message("info","This is Post");
                $this->load->library("upload/uploader");
                $this->uploader->do_upload();
               // redirect('dashboard');
            }
           // return $this->view();

        }catch(Exception $err){
            log_message("error",$err->getMessage());
            return show_error($err->getMessage());
        }*/


        $data['base']=$this->config->item('base_url');
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Upload File";
        $this->load->view('templates/header', $data);
        $this->load->view('upload_file',$data);
    }

    function do_upload(){
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xls|sxls';
        $config['max_size']	= '1000';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload()){
            $error = array('error' => $this->upload->display_errors());

            log_message('error','Error: File not imported. '.$error);
            // Display fail message
            $this->session->set_flashdata('appmsg', $error['error']);
            $this->session->set_flashdata('alert_type', 'alert-danger');
            $this->session->set_flashdata('alert_type_', 'error');
            redirect('uploaded');
        }else{
            $data = array('upload_data' => $this->upload->data());

            //$this->load->view('upload_success', $data);

            // Display success message
            $this->session->set_flashdata('appmsg', 'upload_success!');
            $this->session->set_flashdata('alert_type', 'alert-success');
            $this->session->set_flashdata('alert_type_', 'success');
            redirect('uploaded');
        }
    }

}