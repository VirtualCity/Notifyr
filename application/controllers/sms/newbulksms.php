<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 7/31/14
 * Time: 4:06 PM
 */

class Newbulksms extends Admin_Controller{
    function __construct(){
        parent::__construct();
        $this->load->library('sms/SmsSender.php');
        $this->load->model('sms_model');
        $this->load->model('contacts_model');
        $this->load->model('groups_model');
        $this->load->model('sendsms_model');


    }

    public function index(){
		//check if user and redirect to dashboard
		$role = $this->session->userdata('role');
        if($role==="USER"){
			// Display message
            $this->session->set_flashdata('appmsg', 'You are not allowed to access this function');
            $this->session->set_flashdata('alert_type', 'alert-info');
			redirect('dashboard');
		}

        // SET VALIDATION RULES
        $this->form_validation->set_rules('group', 'SMS Group', 'required|max_length[50]');
        $this->form_validation->set_rules('message', 'Message', 'required|max_length[160]');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $group_id="";
        $message=""; 

        // has the form been submitted
        if($this->input->post()){
            $group_id = $this->input->post('group');
            $message = $this->input->post('message');
            $groupcontacts = $this->input->post('groupcontacts');
            

            //Does it have valid form info (not empty values)
            if($this->form_validation->run()){
                //Get groupname
                $group_details = $this->groups_model->get_group_by_id($group_id);

                //Retrieve group contacts if group exists and put in an array
               // $addresses = $this->contacts_model->get_group_contacts($group_id);

                if(count($groupcontacts) > 0){
                    // $recipients= array();
                    // //Create an array with recipients
                    // foreach($addresses as $address){
                    //     $recipients[]='tel:'.$address->msisdn;
                    // }

                    //Send message to group
                    $msg_sent= $this->sendsms_model->send_sms($groupcontacts,$message);

                    log_message("info","Sending status: ".$msg_sent);

                    if($msg_sent=='success'){
                        // Display success message
                        $this->session->set_flashdata('appmsg', 'Message to '.$group_details->name.' sent successfully!');
                        $this->session->set_flashdata('alert_type', 'alert-success');


                        //save bulk sms
                        $this->sms_model->save_bulksms($group_details->name,$group_details->name,$message,$this->session->userdata('id'));
                        redirect('sms/newbulksms');
                    }else{
                        // Display fail message
                        $this->session->set_flashdata('appmsg', 'Message to '.$group_details->name.' failed.');
                        $this->session->set_flashdata('alert_type', 'alert-warning');
                        redirect('sms/newbulksms');

                    }


                }else{
                    log_message("info","No addresses exist for group ".$group_details->name);
                    // Display fail message
                    $this->session->set_flashdata('appmsg', 'This group'.$group_details->name.' has no contacts subscribed.');
                    $this->session->set_flashdata('alert_type', 'alert-warning');
                    redirect('sms/newbulksms');
                }

            }
        }
        //Retrieve groups
        $groups = $this->groups_model->get_all_groups();
        $data['groups'] = $groups;
        $data['group_id']=$group_id;
        $data['message']=$message;


        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "New Bulk SMS";
        $data['mainContent']='sms/newbulksms';
        $this->load->view('templates/template', $data);
        
    }


    //pull subgroups based on groupid
    public function subgroups($id) { 
        $groupContacts = $this->contacts_model->get_subgroup_contacts($id);
        echo json_encode($groupContacts);
    }



}