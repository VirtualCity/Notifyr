<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 7/31/14
 * Time: 4:06 PM
 */
class Pendingbulksms extends Admin_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->library('sms/SmsSender.php');
        $this->load->model('sms_model');
        $this->load->helper('buttons_helper');
        $this->load->model('contacts_model');
        $this->load->model('groups_model');
        $this->load->model('sendsms_model');
        $this->load->model('template_model');
    }

    public function index()
    {
        $role = $this->session->userdata('role');
        if ($role === "USER") {
            // Display message
            $this->session->set_flashdata('appmsg', 'You are not allowed to access this function');
            $this->session->set_flashdata('alert_type', 'alert-info');
            redirect('dashboard');
        }
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Pending SMS";

        $data['mainContent']='sms/pendingbulksms';
        $this->load->view('templates/template',$data);
    }

    function datatable(){
        $this->datatables->select('pending_sms.id as id,groups.name as groupname,pending_sms.message as message,pending_sms.status as status, users.username as createdby')
        // $this->datatables->select('id,groups_id as group,status,created_by as createdby')
            ->unset_column('id')
            ->add_column('actions', get_pending_sms_buttons('$1'), 'id')
            ->join('groups','pending_sms.group_id = groups.id','left')
            ->join('users','pending_sms.created_by = users.id','left')
            ->from('pending_sms')
			->where('pending_sms.status',0);
        echo $this->datatables->generate();
    }

    function approvedbulk(){

        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Approved SMS";

        $data['mainContent']='sms/approvedbulksms';
        $this->load->view('templates/template',$data);
 
    }

    function datatable2(){
        $this->datatables->select('pending_sms.id as id,groups.name as groupname,pending_sms.message as message,pending_sms.status as status,users.username as approvedby')
        // $this->datatables->select('id,groups_id as group,status,created_by as createdby')
            ->unset_column('id')
            ->join('groups','pending_sms.group_id = groups.id','left')
            ->join('users','pending_sms.approved_by = users.id','left')
            ->from('pending_sms')
			->where('pending_sms.status',1);
        echo $this->datatables->generate();
    }

    //approve the bulk sms
    function approve($id=null){
        if(!empty($id)){
            //pull the sms to be approved
            $to_approve = $this->sms_model->get_pending_bulk_by_id($id);
            if ($to_approve != null) {

                $aprrovedBy = $this->session->userdata('id');
                //extract the required info
                $group_details = $this->groups_model->get_group_by_id($to_approve->group_id);
                $groupcontacts = $to_approve->contacts;
                $message = $to_approve->message;
                $approvedBy = $this->session->userdata('id');
                $grpContacts = explode('-',$groupcontacts);
                //initiate the send function
                
                $msg_sent= $this->sendsms_model->send_sms($grpContacts,$message);

                if ($msg_sent !== null) {

                    $success = 0;
                    $failed = 0;
                    
                    //loop through the result if it contains more than one object and save each response
                    foreach ($msg_sent as $key => $value) {
                        if ($value->status == 'Success') {
                            $success++;
                            $status = 'Sent';
                            $phoneNumber = substr($value->number, 1);
                            // $this -> sms_model -> save_sms($value->Number, "Individual", $message, $userid, $value->MessageId);
                            $this->sms_model->save_bulksms($phoneNumber, $group_details->name, $message, $this->session->userdata('id'),$value->messageId,$status);
                        }else{
                            $failed++;
                            log_message("info", "Sending status code: " . $value->Status);
                        }
                        
                    }

                    //call approve function
                    $approvalCheck = $this->sms_model->approve_pending_bulk($id,$aprrovedBy);
                
                    if($approvalCheck){
                        $this->session->set_flashdata('appmsg', $success . ' Message to ' . $group_details->name . ' sent successfully and ' . $failed . ' messages failed.'.' Approval is successfull ');
                        $this->session->set_flashdata('alert_type', 'alert-success');
                    }else{
                        $this->session->set_flashdata('appmsg', 'An Error Was Encountered! The bulk sms could not be approved ');
                        $this->session->set_flashdata('alert_type', 'alert-danger');
                    }
                }else{
                    $this->session->set_flashdata('appmsg', 'An Error Was Encountered! The bulk sms could not be sent ');
                    $this->session->set_flashdata('alert_type', 'alert-danger');
                }
           
            

            }else{
                // No contact id specified
                $this->session->set_flashdata('appmsg', 'An Error Was Encountered! No bulk SMS identifier provided ');
                $this->session->set_flashdata('alert_type', 'alert-danger');
            }

        }else{
            // No contact id specified
            $this->session->set_flashdata('appmsg', 'An Error Was Encountered! The record you are tryng to approve was found ');
            $this->session->set_flashdata('alert_type', 'alert-warning');
            // redirect('sms/pendingbulksms');
        }
        redirect('sms/pendingbulksms');
    }

    //cancel pending bulk 
    function cancel($id=null){
        if(!empty($id)){

            //pull the sms to be approved
            $to_remove = $this->sms_model->remove_pending_bulk($id);
            if ($to_remove) {
                $this->session->set_flashdata('appmsg', 'The bulk sms cancelled successfully ');
                $this->session->set_flashdata('alert_type', 'alert-success');
                // redirect('sms/pendingbulksms/approvedbulk');
            }else{
                $this->session->set_flashdata('appmsg', 'The bulk sms could not be cancelled ');
                $this->session->set_flashdata('alert_type', 'alert-warning');
            }
        }else{
            // No contact id specified
            $this->session->set_flashdata('appmsg', 'An Error Was Encountered! No bulk SMS identifier provided ');
            $this->session->set_flashdata('alert_type', 'alert-danger');
            // redirect('sms/pendingbulksms');
        }
        redirect('sms/pendingbulksms');
    }

    
}
