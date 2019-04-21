<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 7/30/14
 * Time: 2:53 PM
 */

class Login extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('user_model');
        // $this->load->model('sendsms_model');

        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

    }

    public function index(){
        
        // SET VALIDATION RULES
        $this->form_validation->set_rules('userName', 'Username', 'required|max_length[20]|xss_clean');
        $this->form_validation->set_rules('userPassword', 'Password', 'required|max_length[20]|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $appmsg="";
        $alert_type="";

        // has the form been submitted
        if($this->input->post()){
            //  echo("Form submited");
            //Does it have valid form info (not empty values)
            if($this->form_validation->run()){
                // get username and password
                $uname = $this->input->post('userName');
                $pwd = $this->input->post('userPassword');
                // echo("Username: ".$uname." Password: ".$pwd);

                // read user's credentials from db, through Login Model
                //query the database for username
                $username_exist = $this->user_model->check_username($uname);

                // If the username exists
                if($username_exist){
                     // echo("Username Found");
					 
					$user_active = $this->user_model->check_user_status($uname); 
					
					if($user_active){
						//compare passwords
						$retrieved_user = $this->user_model->compare_password($uname,$pwd);
						if(is_array($retrieved_user) && count($retrieved_user)==9){
							// echo("Login success");

							// echo $retrieved_user['oname'];
							$this->session->set_userdata($retrieved_user);
							redirect('dashboard');
						   // $role = $this->session->userdata('role');

						}
					}else{
						//login unsuccessful
						$this->session->set_flashdata('appmsg', 'Login unsuccessful! Your account has been suspended, contact the admin.');
                        $this->session->set_flashdata('alert_type', 'alert-info');
                        $this->session->set_flashdata('alert_type_', 'warning');
						redirect('login');
					
					}
                    
                }
                //login unsuccessful
                $this->session->set_flashdata('appmsg', 'Login unsuccessful! Username or Password is invalid.');
                $this->session->set_flashdata('alert_type', 'alert-danger');
                $this->session->set_flashdata('alert_type_', 'error');
                redirect('login');

            }
        }

        $data['base']=$this->config->item('base_url');
        $data['title'] = "Login";

        $this->load->view('templates/header', $data);
        $this->load->view('login');
    }


    public function passwordreset(){
        $this->load->library('sms/SmsSender.php');
        $this->load->model('sms_model');
        $this->load->model('sendsms_model');
        // $this->load->model('sendsms_model');
        
        $this->form_validation->set_rules('userName', 'Username', 'required|max_length[20]|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $appmsg="";
        $alert_type="";

        // has the form been submitted
        if($this->input->post()){
            //  echo("Form submited");
            //Does it have valid form info (not empty values)
            if($this->form_validation->run()){
                // get username and password
                $uname = $this->input->post('userName');

                // read user's credentials from db, through Login Model
                //query the database for username
                $username_exist = $this->user_model->check_username($uname);

                // If the username exists
                if($username_exist){
                     // echo("Username Found");
					 
                    $user_active = $this->user_model->check_user_status($uname); 
                    
					
					if($user_active){

                        // generate a random password
                        $newpassword = '12345678#';
                        $message = 'Your new password is '.$newpassword;
                        //check first id there is a phone number in the account
                        $phone = $this->user_model->get_phone_number($uname);
                        $factory = $this->user_model->get_user_factory($uname);

                        if ($phone && $factory) {

                            
                            //call save password function with the generated password and username
                            $updated = $this->user_model->reset_password($uname, $newpassword);
                            // print($updated);
                            
                            //if the process succeeds, send the new password to the phone nummber associated with username and redirect to login page
                            if($updated){
                                $resp = $this->sendsms_model->send_new_password_sms($phone[0]->mobile, $message, $factory->factory_id);
                                // $resp = true;
                                if ($resp !== 'fail' || $resp !== null) {
                                    //send the new password
                                    $this->session->set_flashdata('appmsg', 'A new password has been sent to your phone number.');
                                    $this->session->set_flashdata('alert_type', 'alert-success');
                                    $this->session->set_flashdata('alert_type_', 'success');
                                    redirect('login');
                                } else {
                                    //send the new password
                                    $this->session->set_flashdata('appmsg', 'Communication Error Occured, Please Try Again.');
                                    $this->session->set_flashdata('alert_type', 'alert-danger');
                                    $this->session->set_flashdata('alert_type_', 'error');
                                    redirect('login');
                                }
                                
                                
                                
                                
                                
                            }else{
                            // if it fails, notify the user to try again
                            $this->session->set_flashdata('appmsg', 'An error occured while resetting your password. Kindly try again');
                            $this->session->set_flashdata('alert_type', 'alert-warning');
                            $this->session->set_flashdata('alert_type_', 'error');
                            redirect('login/passwordreset');

                            }
                            
                        } else {
                            $this->session->set_flashdata('appmsg', 'The username has no associated mobile number.');
                            $this->session->set_flashdata('alert_type', 'alert-warning');
                            $this->session->set_flashdata('alert_type_', 'warning');
                            redirect('login/passwordreset');
                        }

					}else{
						//login unsuccessful
						$this->session->set_flashdata('appmsg', 'Login unsuccessful! Your account has been suspended, contact the admin.');
                        $this->session->set_flashdata('alert_type', 'alert-info');
                        $this->session->set_flashdata('alert_type_', 'warning');
						redirect('login');
					
					}
                    
                }
                //login unsuccessful
                $this->session->set_flashdata('appmsg', 'Login unsuccessful! Username or Password is invalid.');
                $this->session->set_flashdata('alert_type', 'alert-danger');
                $this->session->set_flashdata('alert_type_', 'error');
                redirect('login');

            }
        }

        $data['base']=$this->config->item('base_url');
        $data['title'] = "Password Reset";

        $this->load->view('templates/header', $data);
        $this->load->view('reset_password');
    }
}