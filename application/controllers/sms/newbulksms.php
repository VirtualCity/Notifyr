<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 7/31/14
 * Time: 4:06 PM
 */
class Newbulksms extends Admin_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->library('sms/SmsSender.php');
        $this->load->model('sms_model');
        $this->load->model('contacts_model');
        $this->load->model('groups_model');
        $this->load->model('sendsms_model');
        $this->load->model('template_model');
        $this->load->model('settings_m');
    }

    private function isJson($string) 
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    public function index()
    {
        //check if user and redirect to dashboard
        $role = $this->session->userdata('role');
		$userfactory = $this->session->userdata('factory');
        // if ($role === "USER") {
        //     // Display message
        //     $this->session->set_flashdata('appmsg', 'You are not allowed to access this function');
        //     $this->session->set_flashdata('alert_type', 'alert-info');
        //     $this->session->set_flashdata('alert_type_', 'info');
        //     redirect('dashboard');
        // }

        // SET VALIDATION RULES
        $this->form_validation->set_rules('group', 'SMS Group', 'required|max_length[50]');
        $this->form_validation->set_rules('groupcontacts', 'SMS Sub-Group Contacts', 'required');
        $this->form_validation->set_rules('message', 'Message', 'required|max_length[480]');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $group_id = "";
        $message = "";
        $sms_approval = "";
        $isTemplate = false;
        $variables = false;
        $config = "";

        // has the form been submitted
        if ($this->input->post()) {
            $group_id = $this->input->post('group');
            $message = $this->input->post('message');
            $groupcontacts = $this->input->post('groupcontacts');
            // print_r($groupcontacts);
            // if($groupcontacts == null || count($groupcontacts)<=0){

            //     $this->session->set_flashdata('appmsg', 'Please Select the group contacts to sent to.');
            //     $this->session->set_flashdata('alert_type', 'alert-warning');
            // $this->session->set_flashdata('alert_type_', 'warning');
            //     // redirect('sms/newbulksms');
            // } 
            

            //Does it have valid form info (not empty values)
            if ($this->form_validation->run()) {
                if ($role === 'SUPER_USER') {
                    $config = $this->settings_m->get_configuration();
                } else {
                    $config = $this->settings_m->get_configuration__by_factory($userfactory);
                }
                
                
				if($config){
                    $approval = $config->smsapproval;
                }
                $sms_approval = ($approval ? 'true' : 'false');
                //Get groupname
                $group_details = $this->groups_model->get_group_by_id($group_id);

                //Retrieve group contacts if group exists and put in an array
            // $addresses = $this->contacts_model->get_group_contacts($group_id);

                if(count($groupcontacts) > 0){

                    if ($role === "USER") {
                        if ($sms_approval === 'true') {
                            $createdBy = $this->session->userdata('id');
                            $smstype = 'Group';
                            $grpContacts = implode('-',$groupcontacts);
                            $response = $this->sms_model->save_pending_bulk($group_id,$grpContacts,$message,$createdBy,$smstype,$userfactory);
                            if(!$response){
                                $this->session->set_flashdata('appmsg',' Message to ' . $group_details->name . ' could not be saved!');
                                $this->session->set_flashdata('alert_type', 'alert-danger');
                                $this->session->set_flashdata('alert_type_', 'error');
                                redirect('sms/newbulksms');
                            }
                            // Display success message
                            $this->session->set_flashdata('appmsg',' Message to ' . $group_details->name . ' saved successfully');
                            $this->session->set_flashdata('alert_type', 'alert-info');
                            $this->session->set_flashdata('alert_type_', 'info');
                            redirect('sms/newbulksms');
                        }else{


                            //check if the message body is a template
                            $hasOSBracket = strpos($message, '[') !== false;
                            $hasCSBracket = strpos($message, ']') !== false;

                            if($hasCSBracket && $hasOSBracket){
                                $isTemplate = true;
                                $success1 = 0;
                                $failed1 = 0;
                                
                                foreach ($groupcontacts as $key => $value) {
                                    $recipient = $this->contacts_model->get_contact_by_msisdn($value);
                                    if($recipient === false){

                                    }else{
                                        foreach($recipient as $key1 => $value1){
                                            $message = str_replace('['.$key1.']', $value1, $message);
                                        }
                                    }

                                    // echo "xxxxxx";
                                    // return;

                                    //send sms
                                    $msg_sent1= $this->sendsms_model->send_sms($value,$message);
                                    // if ($msg_sent1 !== null) {
                                    //     //loop through the result if it contains more than one object and save each response
                                    //     foreach ($msg_sent1 as $key => $value) {
                                    $check = $this->isJson($msg_sent);					
					
                                    log_message("info", "Sending status: " . $msg_sent);

                                if ($msg_sent !== null && $msg_sent !== 'fail' && $check) 
                                    {
                                            
                                            $success = 0;
                                            $failed = 0;
                                            $smsresponse = json_decode($msg_sent)->SMSMessageData->Recipients;
                                            //loop through the result if it contains more than one object and save each response
                                        foreach ($smsresponse as $key => $value)
                                        {
                                            if ($value->status == 'Success')
                                            {
                                                $success1++;
                                                $status = 'Sent';
                                                $phoneNumber = substr($value->number, 1);
                                                $this->sms_model->save_bulksms($phoneNumber, $group_details->name, $message, $this->session->userdata('id'),$value->messageId,$status,$userfactory);
                                            }
                                            else
                                            {
                                                $failed1++;
                                                log_message("info", "Sending status code: " . $value->Status);
                                            }
                                            
                                        }
    
                                        
                                    } else {
                                        //message failed
                                        // Display fail message
                                        $this -> session -> set_flashdata('appmsg', 'Message to ' . $msisdn . ' failed.');
                                        $this -> session -> set_flashdata('alert_type', 'alert-danger');
                                        redirect('sms/newsms');
                                    }
                                }
                                // Display success message
                                $this->session->set_flashdata('appmsg', $success1 . ' Message to ' . $group_details->name . ' sent successfully and ' . $failed1 . ' messages failed');
                                $this->session->set_flashdata('alert_type', 'alert-info');
                                $this->session->set_flashdata('alert_type_', 'info');
                                redirect('sms/newbulksms');
                                
                            }else{
                                 //Send message to group
                                $msg_sent= $this->sendsms_model->send_sms($groupcontacts,$message);

                                log_message("info", "Sending status: " . $msg_sent);

                                if ($msg_sent !== null && $msg_sent !== 'fail') {

                                    $success = 0;
                                    $failed = 0;
                                    $smsresponse = json_decode($msg_sent)->SMSMessageData->Recipients;
                                    //loop through the result if it contains more than one object and save each response
                                    foreach ($smsresponse as $key => $value) {
                                        if ($value->status == 'Success') {
                                            $success++;
                                            $status = 'Sent';
                                            $phoneNumber = substr($value->number, 1);
                                            $this->sms_model->save_bulksms($phoneNumber, $group_details->name, $message, $this->session->userdata('id'),$value->messageId,$status,$userfactory);
                                        }else{
                                            $failed++;
                                            log_message("info", "Sending status code: " . $value->Status);
                                        }
                                        
                                    }

                                    // Display success message
                                    $this->session->set_flashdata('appmsg', $success . ' Message to ' . $group_details->name . ' sent successfully and ' . $failed . ' messages failed');
                                    $this->session->set_flashdata('alert_type', 'alert-info');
                                    $this->session->set_flashdata('alert_type_', 'info');
                                    redirect('sms/newbulksms');
                                } else {
                                    // Display fail message
                                    $this->session->set_flashdata('appmsg', 'Message to ' . $group_details->name . ' failed. Check Your Network Connection');
                                    $this->session->set_flashdata('alert_type', 'alert-warning');
                                    $this->session->set_flashdata('alert_type_', 'warning');
                                    redirect('sms/newbulksms');

                                }
                            }
                           
                        }
                        
                    }else{

                        //check if the message body is a template
                        $hasOSBracket = strpos($message, '[') !== false;
                        $hasCSBracket = strpos($message, ']') !== false;

                        if($hasCSBracket && $hasOSBracket){
                            $isTemplate = true;
                            $success1 = 0;
                            $failed1 = 0;
                            
                            foreach ($groupcontacts as $key => $value) {
                                $recipient = $this->contacts_model->get_contact_by_msisdn($value);
                                if($recipient === false){

                                }else{
                                    foreach($recipient as $key1 => $value1){
                                        $message = str_replace('['.$key1.']', $value1, $message);
                                    }
                                }

                                // echo "xxxxxx";
                                // return;

                                //send sms
                                $msg_sent1= $this->sendsms_model->send_sms($value,$message);
                                if ($msg_sent1 !== null) {
                                    $smsresponse = json_decode($msg_sent)->SMSMessageData->Recipients;
                                    //loop through the result if it contains more than one object and save each response
                                    foreach ($smsresponse as $key => $value) {
                                        if ($value->status == 'Success') {
                                            $success1++;
                                            $status = 'Sent';
                                            $phoneNumber = substr($value->number, 1);
                                            $this->sms_model->save_bulksms($phoneNumber, $group_details->name, $message, $this->session->userdata('id'),$value->messageId,$status,$userfactory);
                                        }else{
                                            $failed1++;
                                            log_message("info", "Sending status code: " . $value->Status);
                                        }
                                        
                                    }

                                    
                                } else {
                                    //message failed
                                    // Display fail message
                                    $this -> session -> set_flashdata('appmsg', 'Message to ' . $msisdn . ' failed.');
                                    $this -> session -> set_flashdata('alert_type', 'alert-danger');
                                    redirect('sms/newsms');
                                }
                            }
                            // Display success message
                            $this->session->set_flashdata('appmsg', $success1 . ' Message to ' . $group_details->name . ' sent successfully and ' . $failed1 . ' messages failed');
                            $this->session->set_flashdata('alert_type', 'alert-info');
                            $this->session->set_flashdata('alert_type_', 'info');
                            redirect('sms/newbulksms');
                            
                        }else{
                             //Send message to group
                            $msg_sent= $this->sendsms_model->send_sms($groupcontacts,$message);

                            log_message("info", "Sending status: " . $msg_sent);

                            if ($msg_sent !== null && $msg_sent !== 'fail') {

                                $success = 0;
                                $failed = 0;
                                $smsresponse = json_decode($msg_sent)->SMSMessageData->Recipients;
                                //loop through the result if it contains more than one object and save each response
                                foreach ($smsresponse as $key => $value) {
                                    if ($value->status == 'Success') {
                                        $success++;
                                        $status = 'Sent';
                                        $phoneNumber = substr($value->number, 1);
                                        $this->sms_model->save_bulksms($phoneNumber, $group_details->name, $message, $this->session->userdata('id'),$value->messageId,$status,$userfactory);
                                    }else{
                                        $failed++;
                                        log_message("info", "Sending status code: " . $value->Status);
                                    }
                                    
                                }

                                // Display success message
                                $this->session->set_flashdata('appmsg', $success . ' Message to ' . $group_details->name . ' sent successfully and ' . $failed . ' messages failed');
                                $this->session->set_flashdata('alert_type', 'alert-info');
                                $this->session->set_flashdata('alert_type_', 'info');
                                redirect('sms/newbulksms');
                            } else {
                                // Display fail message
                                $this->session->set_flashdata('appmsg', 'Message to ' . $group_details->name . ' failed. . Check Your Network Connection');
                                $this->session->set_flashdata('alert_type', 'alert-warning');
                                $this->session->set_flashdata('alert_type_', 'warning');
                                redirect('sms/newbulksms');

                            }
                        }
                        // //Send message to group
                        // $msg_sent= $this->sendsms_model->send_sms($groupcontacts,$message);

                        // log_message("info", "Sending status: " . $msg_sent);

                        // if ($msg_sent !== null) {

                        //     $success = 0;
                        //     $failed = 0;
                        //     print_r($msg_sent);
                        //     //loop through the result if it contains more than one object and save each response
                        //     foreach ($msg_sent as $key => $value) {
                        //         if ($value->status == 'Success') {
                        //             $success++;
                        //             $status = 'Sent';
                        //             $phoneNumber = substr($value->number, 1);
                        //             $this->sms_model->save_bulksms($phoneNumber, $group_details->name, $message, $this->session->userdata('id'),$value->messageId,$status);
                        //         }else{
                        //             $failed++;
                        //             log_message("info", "Sending status code: " . $value->Status);
                        //         }
                                
                        //     }

                        //     // Display success message
                        //     $this->session->set_flashdata('appmsg', $success . ' Message to ' . $group_details->name . ' sent successfully and ' . $failed . ' messages failed');
                        //     $this->session->set_flashdata('alert_type', 'alert-info');
                        // $this->session->set_flashdata('alert_type_', 'info');
                        //     redirect('sms/newbulksms');
                        // } else {
                        //     // Display fail message
                        //     $this->session->set_flashdata('appmsg', 'Message to ' . $group_details->name . ' failed.');
                        //     $this->session->set_flashdata('alert_type', 'alert-warning');
                        // $this->session->set_flashdata('alert_type_', 'warning');
                        //     redirect('sms/newbulksms');

                        // }
                    }
                    
                } else {
                    log_message("info", "No addresses exist for group " . $group_details->name);
                    // Display fail message
                    $this->session->set_flashdata('appmsg', 'This group' . $group_details->name . ' has no contacts subscribed.');
                    $this->session->set_flashdata('alert_type', 'alert-warning');
                    $this->session->set_flashdata('alert_type_', 'warning');
                    redirect('sms/newbulksms');
                }

            }
        }
        //Retrieve groups
        $role = $this->session->userdata('role');
        if ($role === "SUPER_USER") {
            $groups = $this->groups_model->get_all_groups();
        }else{
            $groups = $this->groups_model->get_group_by_factory($userfactory);
        }
       


        $data['groups'] = $groups;
        $data['group_id'] = $group_id;
        $data['message'] = $message;
        $data['templates']= $this->template_model->get_all_templates();

        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "New Bulk SMS";
        $data['mainContent'] = 'sms/newbulksms';
        $this->load->view('templates/template', $data);

    }

    public function uploadexcel()
    {
        //check if user and redirect to dashboard
        $role = $this->session->userdata('role');
        if ($role === "USER") {
            // Display message
            $this->session->set_flashdata('appmsg', 'You are not allowed to access this function');
            $this->session->set_flashdata('alert_type', 'alert-info');
            $this->session->set_flashdata('alert_type_', 'info');
            redirect('dashboard');
        }

        $data['base'] = $this->config->item('base_url');
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Import SMS From Excel";
        $data['mainContent'] = 'sms/upload_sms';
        $this->load->view('templates/template', $data);
    }

    public function do_upload()
    {
        $this->form_validation->set_rules('userfile', 'Import File', 'required');
        //$this->form_validation->set_rules('group', 'group', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $group_id = $this->input->post('group');

        $config['upload_path'] = './uploads/groups/';
        $config['allowed_types'] = 'xls|xlsx';
        //$config['overwrite'] = TRUE;
        $config['max_size'] = '1000';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());

            log_message('error', 'Error: File not imported. ' . $error);
            // Display fail message
            $this->session->set_flashdata('appmsg', $error['error']);
            $this->session->set_flashdata('alert_type', 'alert-danger');
            $this->session->set_flashdata('alert_type_', 'error');
            redirect('sms/newbulksms/uploadexcel');

        } else {
            $data = array('upload_data' => $this->upload->data());

            foreach ($data['upload_data'] as $item => $value) {
                log_message('info', 'item: ' . $item . ' value: ' . $value);
            }

            $data2 = $this->upload->data();
            $file_name = $data2['file_name'];

            $result = $this->import_excel($file_name, $group_id);

            $importedNo = $result['count'];
            $unregistered = $result['unregistered'];
            $notImported = $result['notadded'];

            // Display success message
            $this->session->set_flashdata('notimported', $notImported);
            $this->session->set_flashdata('unregistered', $unregistered);
            $this->session->set_flashdata('appmsg', 'Total SMS Sent: ' . $importedNo);
            $this->session->set_flashdata('alert_type', 'alert-success');
            $this->session->set_flashdata('alert_type_', 'success');
            redirect('sms/newbulksms/uploadexcel');
        }


    }

    function import_excel($fileName)
    {
        $this->load->library('Excel');
        //  Include PHPExcel_IOFactory

        $inputFileName = './uploads/groups/' . $fileName;

        //  Read your Excel workbook
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }

        //  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = 'D';

        $addCounter = 0;
        $unknownContacts = '';
        $notAdded = '';

        //  Loop through each row of the worksheet in turn
        for ($row = 2; $row <= $highestRow; $row++) {
            //  Read a row of data into an array
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

            $groupData = $rowData[0];
            $mobile = trim($groupData[0]);
            $text = $groupData[1] ? trim($groupData[1]) : "";

            //Check if all fields are not null
            if ($mobile != null && $mobile != "") {

                //check if mobile has 12 characters and is numeric
                if (is_numeric($mobile) && strlen($mobile) == 12) {
                    if ($text != "") {
                        $recipients = array($mobile);
                        $msg_sent = $this->sendsms_model->send_sms($recipients, $text);
                        $status = json_decode($msg_sent)->SMSMessageData->Recipients->status;
                        log_message("info", "Sending status: " . $msg_sent);

                        if ($status === 'Success') {
                            $addCounter++;

                        } else
                            $notAdded = $notAdded . ' | ' . $mobile;

                    }
                } else
                    $unknownContacts = $unknownContacts . ' | ' . $mobile;

            }

        }

        $import_result = array('count' => $addCounter, 'notadded' => $notAdded, 'unregistered' => $unknownContacts);

        return $import_result;
    }
    //pull subgroups based on groupid
    public function subgroups($id) { 
        $groupContacts = $this->contacts_model->get_subgroup_contacts($id);
        echo json_encode($groupContacts);
    }

    public function download(){
        //load download helper
        $this->load->helper('download');
        
        //file path
        $filePath = 'uploads/templates/';
        $fileName = 'excelsms_import.xlsx';
        $data = file_get_contents($filePath.$fileName);
        force_download($fileName, $data);   
        redirect('sms/newbulksms/uploadexcel');
    }



}
