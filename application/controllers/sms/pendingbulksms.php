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
        // if ($role === "SUPER_USER" || $role === "ADMIN") {
        //     // Display message
        //     $this->session->set_flashdata('appmsg', 'You are not allowed to access this function');
        //     $this->session->set_flashdata('alert_type', 'alert-info');
        // $this->session->set_flashdata('alert_type_', 'info');
        //     redirect('dashboard');
        // }
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Pending SMS";

        $data['mainContent']='sms/pendingbulksms';
        $this->load->view('templates/template',$data);
    }

    

    //load ui for approved
    function approvedbulk()
    {
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Approved SMS";
        $data['mainContent']='sms/approvedbulksms';
        $this->load->view('templates/template',$data);
    }

    //load ui for cancelled
    function cancelledbulk()
    {
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Cancelled SMS";
        $data['mainContent']='sms/cancelledbulksms';
        $this->load->view('templates/template',$data);
    }

    //load ui for rejected
    function rejectedbulk()
    {
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Rejected SMS";
        $data['mainContent']='sms/rejectedbulksms';
        $this->load->view('templates/template',$data);
    }


    //PENDING BULK
    function pending()
    {
        $userid = $this->session->userdata('id');
        $role = $this->session->userdata('role');
        $userfactory = $this->session->userdata('factory');
        if ($role === "USER") {
            $this->datatables->select('pending_sms.id as id,groups.name as groupname, pending_sms.contacts as contacts,pending_sms.message as message,pending_sms.status as status, users.username as createdby, pending_sms.created as datecreated')
            ->unset_column('id')
            ->add_column('actions', get_pending_sms_buttons('$1'), 'pending_sms.id')
            ->join('users','pending_sms.created_by = users.id','left')
            ->join('groups','pending_sms.group_id = groups.id','left')
            ->from('pending_sms')
            ->where('pending_sms.status',0)
            ->where('pending_sms.created_by',$userid)
            ->where('pending_sms.factory_id',$userfactory);
            echo $this->datatables->generate();
        }else{
            $this->datatables->select('pending_sms.id as id,groups.name as groupname, pending_sms.contacts as contacts,pending_sms.message as message,pending_sms.status as status, users.username as createdby, pending_sms.created as datecreated')
            ->unset_column('id')
            ->add_column('actions', get_pending_sms_buttons('$1'), 'id')
            ->join('users','pending_sms.created_by = users.id','left')
            ->join('groups','pending_sms.group_id = groups.id','left')
            ->from('pending_sms')
            ->where('pending_sms.status',0)
            ->where('pending_sms.factory_id',$userfactory);
            echo $this->datatables->generate();
        }
    }
    //APPROVED BULK
    function approved(){
        $id = $this->session->userdata('id');
        $role = $this->session->userdata('role');
        $userfactory = $this->session->userdata('factory');

        if ($role === "USER") {
            $this->datatables->select('pending_sms.id as id,groups.name as groupname, pending_sms.contacts as contacts,pending_sms.message as message,pending_sms.status as status,users.username as approvedby, pending_sms.created as datecreated, pending_sms.updated as dateapproved')
            ->unset_column('id')
            ->join('groups','pending_sms.group_id = groups.id','left')
            ->join('users','pending_sms.approved_by = users.id','left')
            ->from('pending_sms')
            ->where('pending_sms.status',1)
            ->where('pending_sms.created_by',$id)
            ->where('pending_sms.factory_id',$userfactory);
            echo $this->datatables->generate();
        }else{
            $this->datatables->select('pending_sms.id as id,groups.name as groupname, pending_sms.contacts as contacts,pending_sms.message as message,pending_sms.status as status,users.username as approvedby, pending_sms.created as datecreated, , pending_sms.updated as dateapproved')
            ->unset_column('id')
            ->join('groups','pending_sms.group_id = groups.id','left')
            ->join('users','pending_sms.approved_by = users.id','left')
            ->from('pending_sms')
            ->where('pending_sms.status',1)
            ->where('pending_sms.factory_id',$userfactory);
            echo $this->datatables->generate();
        }
    }

    //CANCELLED BULK
    function cancelled()
    {
        $id = $this->session->userdata('id');
        $role = $this->session->userdata('role');
        $userfactory = $this->session->userdata('factory');

        if ($role === "USER") {
            $this->datatables->select('pending_sms.id as id,groups.name as groupname, pending_sms.contacts as contacts,pending_sms.message as message,pending_sms.status as status,users.username as cancelledby, pending_sms.created as datecreated, pending_sms.updated as datecancelled')
            ->unset_column('id')
            ->join('groups','pending_sms.group_id = groups.id','left')
            ->join('users','pending_sms.approved_by = users.id','left')
            ->from('pending_sms')
            ->where('pending_sms.status',2)
            ->where('pending_sms.created_by',$id)
            ->where('pending_sms.factory_id',$userfactory);
            echo $this->datatables->generate();
        }else{
            $this->datatables->select('pending_sms.id as id,groups.name as groupname, pending_sms.contacts as contacts,pending_sms.message as message,pending_sms.status as status,users.username as cancelledby, pending_sms.created as datecreated, , pending_sms.updated as datecancelled')
            ->unset_column('id')
            ->join('groups','pending_sms.group_id = groups.id','left')
            ->join('users','pending_sms.approved_by = users.id','left')
            ->from('pending_sms')
            ->where('pending_sms.factory_id',$userfactory)
            ->where('pending_sms.status',2);

            echo $this->datatables->generate();
        }
    }


    //REJECTED BULK
    function rejected()
    {
        $id = $this->session->userdata('id');
        $role = $this->session->userdata('role');
        $userfactory = $this->session->userdata('factory');

        if ($role === "USER") {
            $this->datatables->select('pending_sms.id as id,groups.name as groupname, pending_sms.contacts as contacts,pending_sms.message as message,pending_sms.status as status,users.username as approvedby, pending_sms.created as datecreated, pending_sms.updated as dateapproved')
            ->unset_column('id')
            ->join('groups','pending_sms.group_id = groups.id','left')
            ->join('users','pending_sms.approved_by = users.id','left')
            ->from('pending_sms')
            ->where('pending_sms.status',3)
            ->where('pending_sms.created_by',$id)
            ->where('pending_sms.factory_id',$userfactory);
            echo $this->datatables->generate();
        }else{
            $this->datatables->select('pending_sms.id as id,groups.name as groupname, pending_sms.contacts as contacts,pending_sms.message as message,pending_sms.status as status,users.username as approvedby, pending_sms.created as datecreated, , pending_sms.updated as dateapproved')
            ->unset_column('id')
            ->join('groups','pending_sms.group_id = groups.id','left')
            ->join('users','pending_sms.approved_by = users.id','left')
            ->from('pending_sms')
            ->where('pending_sms.factory_id',$userfactory)
            ->where('pending_sms.status',3);
            echo $this->datatables->generate();
        }
    }

    //approve the bulk sms
    function approve($id=null)
    {
        // $userid = $this->session->userdata('id');
        $role = $this->session->userdata('role');
        $userfactory = $this->session->userdata('factory');
        $groupName = "";
        if(!empty($id)){
            //pull the sms to be approved
            $to_approve = $this->sms_model->get_pending_bulk_by_id($id);
            if ($to_approve !== null) {

                $aprrovedBy = $this->session->userdata('id');
                //extract the required info
                $group_details = $this->groups_model->get_group_by_id($to_approve->group_id);
                if(!$group_details){
                    $groupName = "Indivudual";
                }else{
                    $groupName = $group_details->name;
                }
                $groupcontacts = $to_approve->contacts;
                $message = $to_approve->message;
                $approvedBy = $this->session->userdata('id');
                $grpContacts = explode('-',$groupcontacts);
                //initiate the send function

                //check if the message body is a template
                $hasOSBracket = strpos($message, '[') !== false;
                $hasCSBracket = strpos($message, ']') !== false;

                if($hasCSBracket && $hasOSBracket){
                    $isTemplate = true;
                    $success2 = 0;
                    $failed2 = 0;
                    
                    foreach ($grpContacts as $key => $value) {
                        $recipient = $this->contacts_model->get_contact_by_msisdn($value);
                        if($recipient === false){

                        }else{
                            foreach($recipient as $key1 => $value1){
                                $message = str_replace('['.$key1.']', $value1, $message);
                            }
                        }

                        //send sms
                        $msg_sent1= $this->sendsms_model->send_sms($value,$message);
                        if ($msg_sent1 !== null) {
                            //loop through the result if it contains more than one object and save each response
                            foreach ($msg_sent1 as $key => $value) {
                                if ($value->status == 'Success') {
                                    $success2++;
                                    $status = 'Sent';
                                    $phoneNumber = substr($value->number, 1);
                                    $this->sms_model->save_bulksms($phoneNumber, $groupName, $message, $this->session->userdata('id'),$value->messageId,$status,$userfactory);
                                }else{
                                    $failed2++;
                                    log_message("info", "Sending status code: " . $value->Status);
                                }
                                
                            }
                            
                        } else {
                            //message failed
                            // Display fail message
                            $this -> session -> set_flashdata('appmsg', 'Message to ' . $msisdn . ' failed.');
                            $this -> session -> set_flashdata('alert_type', 'alert-danger');
                            redirect('sms/pendingbulksms');
                        }
                    }
                    //call approve function
                    $approvalCheck = $this->sms_model->approve_pending_bulk($id,$aprrovedBy);
                    if (!$approvalCheck) {
                            // Display fail message
                            $this -> session -> set_flashdata('appmsg', 'Could no update the approved sms');
                            $this -> session -> set_flashdata('alert_type', 'alert-danger');
                            redirect('sms/pendingbulksms');
                    }
                    // Display success message
                    $this->session->set_flashdata('appmsg', $success2 . ' Message to ' . $groupName . ' sent successfully and ' . $failed2 . ' messages failed');
                    $this->session->set_flashdata('alert_type', 'alert-info');
                    $this->session->set_flashdata('alert_type_', 'info');
                    redirect('sms/pendingbulksms');
                    
                }else{
                     //Send message to group
                    $msg_sent= $this->sendsms_model->send_sms($groupcontacts,$message);

                    // log_message("info", "Sending status: " . $msg_sent);

                    if ($msg_sent !== null) {

                        $success = 0;
                        $failed = 0;
                        //loop through the result if it contains more than one object and save each response
                        foreach ($msg_sent as $key => $value) {
                            if ($value->status == 'Success') {
                                $success++;
                                $status = 'Sent';
                                $phoneNumber = substr($value->number, 1);
                                $this->sms_model->save_bulksms($phoneNumber, $groupName, $message, $this->session->userdata('id'),$value->messageId,$status,$userfactory);
                            }else{
                                $failed++;
                                log_message("info", "Sending status code: " . $value->Status);
                            }
                            
                        }
                        //call approve function
                        $approvalCheck = $this->sms_model->approve_pending_bulk($id,$aprrovedBy);
                        if (!$approvalCheck) {
                                // Display fail message
                                $this -> session -> set_flashdata('appmsg', 'Could no update the approved sms');
                                $this -> session -> set_flashdata('alert_type', 'alert-danger');
                                redirect('sms/pendingbulksms');
                        }
                        // Display success message
                        $this->session->set_flashdata('appmsg', $success . ' Message to ' . $groupName . ' sent successfully and ' . $failed . ' messages failed');
                        $this->session->set_flashdata('alert_type', 'alert-info');
                        $this->session->set_flashdata('alert_type_', 'info');
                        redirect('sms/pendingbulksms');
                    } else {
                        // Display fail message
                        $this->session->set_flashdata('appmsg', 'Message to ' . $groupName . ' failed.');
                        $this->session->set_flashdata('alert_type', 'alert-warning');
                        $this->session->set_flashdata('alert_type_', 'warning');
                        redirect('sms/pendingbulksms');

                    }
                }




                // =====================================================================
                // $msg_sent= $this->sendsms_model->send_sms($grpContacts,$message);

                // if ($msg_sent !== null) {

                //     $success = 0;
                //     $failed = 0;
                    
                //     //loop through the result if it contains more than one object and save each response
                //     foreach ($msg_sent as $key => $value) {
                //         if ($value->status == 'Success') {
                //             $success++;
                //             $status = 'Sent';
                //             $phoneNumber = substr($value->number, 1);
                //             // $this -> sms_model -> save_sms($value->Number, "Individual", $message, $userid, $value->MessageId);
                //             $this->sms_model->save_bulksms($phoneNumber, $group_details->name, $message, $this->session->userdata('id'),$value->messageId,$status);
                //         }else{
                //             $failed++;
                //             log_message("info", "Sending status code: " . $value->Status);
                //         }
                        
                //     }

                //     //call approve function
                //     $approvalCheck = $this->sms_model->approve_pending_bulk($id,$aprrovedBy);
                
                //     if($approvalCheck){
                //         $this->session->set_flashdata('appmsg', $success . ' Message to ' . $group_details->name . ' sent successfully and ' . $failed . ' messages failed.'.' Approval is successfull ');
                //         $this->session->set_flashdata('alert_type', 'alert-success');
                // $this->session->set_flashdata('alert_type_', 'sucess');
                //     }else{
                //         $this->session->set_flashdata('appmsg', 'An Error Was Encountered! The bulk sms could not be approved ');
                //         $this->session->set_flashdata('alert_type', 'alert-danger');
                // $this->session->set_flashdata('alert_type_', 'error');
                //     }
                // }else{
                //     $this->session->set_flashdata('appmsg', 'An Error Was Encountered! The bulk sms could not be sent ');
                //     $this->session->set_flashdata('alert_type', 'alert-danger');
                // $this->session->set_flashdata('alert_type_', 'error');
                // }
        //    ==========================================================================
            

            }else{
                // No contact id specified
                $this->session->set_flashdata('appmsg', 'An Error Was Encountered! No bulk SMS identifier provided ');
                $this->session->set_flashdata('alert_type', 'alert-danger');
                $this->session->set_flashdata('alert_type_', 'error');
            }

        }else{
            // No contact id specified
            $this->session->set_flashdata('appmsg', 'An Error Was Encountered! The record you are tryng to approve was found ');
            $this->session->set_flashdata('alert_type', 'alert-warning');
            $this->session->set_flashdata('alert_type_', 'warning');
            // redirect('sms/pendingbulksms');
        }
        redirect('sms/pendingbulksms');
    }

    //cancel pending bulk 
    function cancel($id=null)
    {
        if(!empty($id)){

            //pull the sms to be approved
            $cancelledBy = $this->session->userdata('id');
            $to_cancel = $this->sms_model->cancel_pending_bulk($id,$cancelledBy);
            if ($to_cancel) {
                $this->session->set_flashdata('appmsg', 'The bulk sms cancelled successfully ');
                $this->session->set_flashdata('alert_type', 'alert-success');
                $this->session->set_flashdata('alert_type_', 'sucess');
                // redirect('sms/pendingbulksms/approvedbulk');
            }else{
                $this->session->set_flashdata('appmsg', 'The bulk sms could not be cancelled ');
                $this->session->set_flashdata('alert_type', 'alert-warning');
                $this->session->set_flashdata('alert_type_', 'warning');
            }
        }else{
            // No contact id specified
            $this->session->set_flashdata('appmsg', 'An Error Was Encountered! No bulk SMS identifier provided ');
            $this->session->set_flashdata('alert_type', 'alert-danger');
            $this->session->set_flashdata('alert_type_', 'error');
            // redirect('sms/pendingbulksms');
        }
        redirect('sms/pendingbulksms');
    }

    //cancel pending bulk 
    function reject($id=null)
    {
        if(!empty($id)){

            //pull the sms to be approved
            $rejectedBy = $this->session->userdata('id');
            $to_reject = $this->sms_model->reject_pending_bulk($id,$rejectedBy);
            if ($to_reject) {
                $this->session->set_flashdata('appmsg', 'The bulk sms cancelled successfully ');
                $this->session->set_flashdata('alert_type', 'alert-success');
                $this->session->set_flashdata('alert_type_', 'success');
                // redirect('sms/pendingbulksms/approvedbulk');
            }else{
                $this->session->set_flashdata('appmsg', 'The bulk sms could not be cancelled ');
                $this->session->set_flashdata('alert_type', 'alert-warning');
                $this->session->set_flashdata('alert_type_', 'warning');
            }
        }else{
            // No contact id specified
            $this->session->set_flashdata('appmsg', 'An Error Was Encountered! No bulk SMS identifier provided ');
            $this->session->set_flashdata('alert_type', 'alert-danger');
            $this->session->set_flashdata('alert_type_', 'error');
            // redirect('sms/pendingbulksms');
        }
        redirect('sms/pendingbulksms');
    }

    
}
