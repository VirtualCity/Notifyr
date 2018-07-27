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
    }
        public function index()
        {
            //check if user and redirect to dashboard
            $role = $this->session->userdata('role');
            if ($role === "USER") {
                // Display message
                $this->session->set_flashdata('appmsg', 'You are not allowed to access this function');
                $this->session->set_flashdata('alert_type', 'alert-info');
                redirect('dashboard');
            }

        // SET VALIDATION RULES
        $this->form_validation->set_rules('group', 'SMS Group', 'required|max_length[50]');
        $this->form_validation->set_rules('message', 'Message', 'required|max_length[160]');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $group_id = "";
        $message = "";

        // has the form been submitted
        if ($this->input->post()) {
            $group_id = $this->input->post('group');
            $message = $this->input->post('message');

            //Does it have valid form info (not empty values)
            if ($this->form_validation->run()) {
                //Get groupname
                $group_details = $this->groups_model->get_group_by_id($group_id);

                //Retrieve group contacts if group exists and put in an array
                $addresses = $this->contacts_model->get_group_contacts($group_id);

                if ($addresses) {
                    $recipients = array();
                    //Create an array with recipients
                    foreach ($addresses as $address) {
                        $recipients[] = $address->msisdn;
                    }

                    //Send message to group
                    $msg_sent = $this->sendsms_model->send_sms($recipients, $message);

                    log_message("info", "Sending status: " . $msg_sent);

                    if ($msg_sent == 'success') {
                        // Display success message
                        $this->session->set_flashdata('appmsg', 'Message to ' . $group_details->name . ' sent successfully!');
                        $this->session->set_flashdata('alert_type', 'alert-success');


                        //save bulk sms
                        $this->sms_model->save_bulksms($group_details->name, $group_details->name, $message, $this->session->userdata('id'));
                        redirect('sms/newbulksms');
                    } else {
                        // Display fail message
                        $this->session->set_flashdata('appmsg', 'Message to ' . $group_details->name . ' failed.');
                        $this->session->set_flashdata('alert_type', 'alert-warning');
                        redirect('sms/newbulksms');

                    }


                } else {
                    log_message("info", "No addresses exist for group " . $group_details->name);
                    // Display fail message
                    $this->session->set_flashdata('appmsg', 'This group' . $group_details->name . ' has no contacts subscribed.');
                    $this->session->set_flashdata('alert_type', 'alert-warning');
                    redirect('sms/newbulksms');
                }

            }
        }
        //Retrieve groups
        $groups = $this->groups_model->get_all_groups();
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

                        log_message("info", "Sending status: " . $msg_sent);

                        if ($msg_sent == 'success') {
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

}
