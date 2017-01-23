<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 8/3/14
 * Time: 7:00 PM
 */

class Add extends Admin_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('user_model');
    }

    function index(){

        // SET VALIDATION RULES
        $this->form_validation->set_rules('fname', 'First Name', 'required|alpha|max_length[30]');
        $this->form_validation->set_rules('sname', 'Surname', 'required|alpha|max_length[30]');
        $this->form_validation->set_rules('oname', 'Other Names', 'alpha|max_length[40]');
        $this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|min_length[6]|max_length[30]|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email Address', 'max_length[150]|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('mobile', 'Mobile', 'exact_length[12]');
        $this->form_validation->set_rules('role', 'User Role', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[50]');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $fname ="";
        $sname ="";
        $oname ="";
        $username ="";
        $email ="";
        $mobile ="";
        $role ="";
        $password ="";


        // has the form been submitted
        if($this->input->post()){
            $fname = $this->input->post('fname');
            $sname = $this->input->post('sname');
            $oname = $this->input->post('oname');
            $username = trim($this->input->post('username'));
            $email = $this->input->post('email');
            $mobile = $this->input->post('mobile');
            $role = $this->input->post('role');
            $password = $this->input->post('password');

            log_message('INFO','fname:'.$fname.' sname'.$sname);

            //Does it have valid form info (not empty values)
            if($this->form_validation->run()){

                //Save new user
                $saved = $this->user_model->add_user($fname,$sname,$oname,$email,$mobile,$username,$role,$password,'Active');

                if($saved){
                    //   log_message('info','User Saved');
                    // Display success message
                    $this->session->set_flashdata('appmsg', 'User account added successfully!');
                    $this->session->set_flashdata('alert_type', 'alert-success');
                    redirect('users/add');

                }else{
                    //Display fail message
                    //log_message('info','User NOT Saved');
                    $this->session->set_flashdata('appmsg', 'User account NOT added! Check logs');
                    $this->session->set_flashdata('alert_type', 'alert-danger');
                    redirect('users/add');
                }
            }
        }

        $data['fname']=$fname;
        $data['sname']=$sname;
        $data['oname']=$oname;
        $data['username']=$username;
        $data['email']=$email;
        $data['mobile']=$mobile;
        $data['role']=$role;
        $data['password']=$password;

        $data['base']=$this->config->item('base_url');
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Add User";

  $data['mainContent']='users/add_user';
        $this->load->view('templates/template',$data);

     
    }

    public function mobile_check($str){
        if(trim($str)!==""){
            if (substr($str, 0, 3 ) !== "254"){
                $this->form_validation->set_message('mobile_check', 'Mobile Number has to begin with 254!');
                return FALSE;
            }
            else{
                return TRUE;
            }
        }else{
            return false;
        }

    }
}