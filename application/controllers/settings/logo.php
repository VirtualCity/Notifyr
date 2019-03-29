<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 10/6/2014
 * Time: 9:30 AM
 */

class Logo extends MY_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('settings_m');
        $this->load->library('upload');
        $this->load->helper(array('form','url'));

        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    function index(){
        $role = $this->session->userdata('role');

        // SET VALIDATION RULES
        $this->form_validation->set_rules('logo', 'Logo Upload', 'required');

        // has the form been submitted
        if($this->input->post()){
            if($this->form_validation->run()){

            $logoImage = $this->input->post('logo');
            $config = array(
                'upload_path' => "./uploads/",//"./assets/v2/img/",//./uploads/
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'overwrite' => TRUE,
                'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "54",
                'max_width' => "230"
                );
                $this->load->library('upload', $config);
                
                if($this->upload->do_upload())
                {
                    
                    $data = array('upload_data' => $this->upload->data());
                    // Display success message
                    print_r($data);
                    return;
                    $this->session->set_flashdata('appmsg', 'Logo uploaded successfully! ' + $data);
                    $this->session->set_flashdata('alert_type', 'alert-success');
                    redirect('settings/logo');
                }
                else
                {
                    $error = array('error' => $this->upload->display_errors());
                    // Display fail message
                    print_r($error);
                    return;
                    $this->session->set_flashdata('appmsg', 'Logo Failed to upload: ');
                    $this->session->set_flashdata('alert_type', 'alert-danger');
                    redirect('settings/logo');
                } 
            
            }else{
                $this->session->set_flashdata('appmsg', 'You did not select any file');
                $this->session->set_flashdata('alert_type', 'alert-warning');
                redirect('settings/logo');
            }
            }

        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Logo Upload";
        $data['mainContent'] = 'settings/logo_view';
        $this->load->view('templates/template', $data);
        
    }


    function doUpload(){
        // SET VALIDATION RULES
        $this->form_validation->set_rules('logo', 'Logo Upload', 'required');
        // print_r($_FILES['logo']);
        // print($_FILES['logo']['name']);
        // print_r(explode('.',$_FILES['logo']['name']));
        $explodedName = explode('.',$_FILES['logo']['name']);
        $len = count($explodedName);
        // print_r($explodedName);
        $oFilename = $explodedName[($len-2)];
        $ext = $explodedName[($len-1)]='png';
        $explodedName[($len-2)] = 'vc-logo';
        $fFilename = implode('.',$explodedName);
        $_FILES['logo']['name'] = $fFilename;
        // print_r($_FILES['logo']);
        // return;
        // has the form been submitted
        if($this->input->post()){

            $config = array(
                'upload_path' => "./assets/v2/img",
                'allowed_types' => "png",
                'overwrite' => TRUE,
                'max_size' => "2048000" // Can be set to particular file size , here it is 2 MB(2048 Kb)
                // 'max_height' => "54",
                // 'max_width' => "230",
                // 'min_height' => "50",
                // 'min_width' => "225"
                );
                // $this->upload->initialize($config)
                $this->load->library('image_lib');
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('logo'))
                {
                    $this->session->set_flashdata('appmsg', 'Logo Failed to upload: '. $this->upload->display_errors());
                    $this->session->set_flashdata('alert_type', 'alert-danger');
                    redirect('settings/logo');                    
                }
                else
                {

                    $image_data =   $this->upload->data();

                    $configer =  array(
                    'image_library'   => 'gd2',
                    'source_image'    =>  $image_data['full_path'],
                    'maintain_ratio'  =>  TRUE,
                    'width'           =>  230,
                    'height'          =>  54,
                    );
                    $this->image_lib->clear();
                    $this->image_lib->initialize($configer);
                    $this->image_lib->resize();

                    // $data = array('upload_data' => $this->upload->data());
                    print_r($image_data);
                    return;
                    // Display success message
                    $this->session->set_flashdata('appmsg', 'Logo uploaded successfully! ');
                    $this->session->set_flashdata('alert_type', 'alert-success');
                    redirect('settings/logo');

                
                }   
            }
        }
}
