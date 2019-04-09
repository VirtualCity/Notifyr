<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 8/3/14
 * Time: 7:00 PM
 */

class Suspended extends Admin_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('buttons_helper');
        $this->load->model('user_model');
        $this->load->database();

    }

    function index(){
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Manage Suspended Users";

        $data['mainContent']='users/view_suspended';
        $this->load->view('templates/template',$data);
        
        
    }

    //return suspended users
    function datatable(){
        $role = $this->session->userdata('role');
        $userfactory = $this->session->userdata('factory');
        if($role === "SUPER_USER"){
            $this->datatables->select("users.id as id,users.username as username,CONCAT(users.fname,' ',users.surname,' ',users.oname) as name,users.mobile,users.email,factories.name as factory,users.role,users.created",false)
            ->unset_column('users.id')
            ->add_column('actions', get_active_users_buttons('$1'), 'users.id')
            ->from('users')
            ->join('factories','users.factory_id=factories.id')
            ->where('status','suspended');
            $result= $this->datatables->generate();
            echo $result;
        }else{
            $this->datatables->select("users.id as id,users.username as username,CONCAT(users.fname,' ',users.surname,' ',users.oname) as name,users.mobile,users.email,factories.name as factory,users.role,users.created",false)
            ->unset_column('users.id')
            ->add_column('actions', get_active_users_buttons('$1'), 'users.id')
            ->from('users')
            ->join('factories','users.factory_id=factories.id')
            ->where('users.factory_id',$userfactory)
            ->where('status','suspended');                
            $result= $this->datatables->generate();
            echo $result;
        }

    }


    function activate($id){
        if(!$this->session->userdata('logged_in')){
            redirect('login');
            //echo("You are NOT logged in");
        }

        $activated = $this->user_model->activate_user($id);
        if($activated){
            log_message('info', 'User account: '.$id.' has been activated');
            $this->session->set_flashdata('appmsg', 'User account successfully activated!');
            $this->session->set_flashdata('alert_type', 'alert-success');
        }else{
            log_message('info', 'User account: '.$id.' failed to activate');
            $this->session->set_flashdata('appmsg', 'Failed to activate user account! Check logs.');
            $this->session->set_flashdata('alert_type', 'alert-warning');
        }
        redirect("users/suspended");
    }



    function add(){


        // SET VALIDATION RULES
        $this->form_validation->set_rules('fname', 'First Name', 'required|max_length[30]');
        $this->form_validation->set_rules('sname', 'Surname', 'required|max_length[50]');
        $this->form_validation->set_rules('oname', 'Other Names', 'alpha|max_length[40]');
        $this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|min_length[6]|max_length[30]|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email Address', 'max_length[150]|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('mobile', 'Mobile', 'exact_length[12]||callback_mobile_check');
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
            log_message('info','submit');
            $fname = $this->input->post('fname');
            $sname = $this->input->post('sname');
            $oname = $this->input->post('oname');
            $username = trim($this->input->post('username'));
            $email = $this->input->post('email');
            $mobile = $this->input->post('mobile');
            $role = $this->input->post('role');
            $password = $this->input->post('password');

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
        $this->load->view('templates/header', $data);
        $this->load->view('users/add_user',$data);
    }




}