<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 8/5/14
 * Time: 8:52 AM
 */

class Factories extends Admin_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('buttons_helper');
        $this->load->model('factories_model');
        $this->load->model('regions_m');
        $this->load->model('supervisors_m');
        $this->load->model('dashboard_model');

        $this->load->model('settings_m');
        $this->load->model('groups_model');
    }

    function index(){
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Factories";
        $data['mainContent']='factory/view_factories';
        $this->load->view('templates/template',$data); 
    }

    function datatable(){
        $this->datatables->select('factories.id AS id,factories.`name AS factoryName,factories.code as factoryCode,regions.name AS region, factories.updated AS modified,factories.created AS created')
        ->unset_column('id')
        ->add_column('actions', get_factories_buttons('$1'), 'id')
        ->from('factories')
        ->join('regions','factories.region_id = regions.id');
        echo $this->datatables->generate();
    }

    function factory_usage_report(){
        // $facts = "";

        // $facts =$this->usageBalance();

        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Factory Usage Reports";
        // $data['factories'] = $facts;
        $data['mainContent']='factory/view_factories_report';
        $this->load->view('templates/template',$data); 

    }

    function usageBalance(){
        // $factories = $this->factories_model->get_all_factories_balance();
        $factories = $this->factories_model->get_all_factories_and_balance_settings();
        if(count($factories)>0){

            foreach ($factories as $key => $value) {
                $months_sent_total = $this->dashboard_model->get_months_sent_total_by_factory($value->id);
                $bal = $this->dashboard_model->get_factory_sms_balance($value->username, $value->apiKey);
                $value->balance = $bal;
                $value->sent = $months_sent_total;
            }
        }

        // $json_data = array(
        //     "draw"            => intval( $_REQUEST['draw'] ),
        //     "recordsTotal"    => intval( count($factories) ),
        //     "recordsFiltered" => intval( count($factories) ),
        //     "data"            => $factories
        // );
        // print(intval( $_REQUEST['draw'] ))
        echo json_encode($factories);
    }

    function usageBalance_period($period = null){
        // $factories = $this->factories_model->get_all_factories_balance();
        $factories = $this->factories_model->get_all_factories_and_balance_settings();
        if(count($factories)>0){

            foreach ($factories as $key => $value) {
                if ($period == 30) {
                    $sent = $this->dashboard_model->get_months_sent_total_by_factory($value->id);
                    $received = $this->dashboard_model->get_months_total_by_factory($value->id);
                } else if($period == 7) {
                    $sent = $this->dashboard_model->get_weeks_sent_total_by_factory($value->id);
                    $received = $this->dashboard_model->get_weeks_total_by_factory($value->id);
                    
                }else if($period == 1) {
                    $sent = $this->dashboard_model->get_todays_sent_total($value->id);
                    $received = $this->dashboard_model->get_todays_total_by_factory($value->id);
                }else{
                    $sent = $this->dashboard_model->get_months_sent_total_by_factory($value->id);
                    $received = $this->dashboard_model->get_months_total_by_factory($value->id);
                }
                
                $bal = $this->dashboard_model->get_factory_sms_balance($value->username, $value->apiKey);
                $value->balance = $bal;
                $value->sent = $sent;
                $value->received = $received;
            }
        }
        echo json_encode($factories);
    }

    function add(){
        $factoryName="";
        $region_id ="";
        $factoryCode="";

        // SET VALIDATION RULES
        $this->form_validation->set_rules('factoryName', 'Factory Name', 'required|max_length[50]|is_unique[factories.name]');
        $this->form_validation->set_rules('factoryCode', 'Factory Code', 'alpha_dash|max_length[20]|is_unique[factories.code]');
        $this->form_validation->set_rules('region_id', 'Region', 'required|numeric');
        $this->form_validation->set_message('is_unique', 'The %s already exists');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // has the form been submitted
        if($this->input->post()){
            $factoryName = trim($this->input->post('factoryName'));
            $region_id = trim($this->input->post('region_id'));
            $factoryCode = trim($this->input->post('factoryCode'));

            //Does it have valid form info (not empty values)
            if($this->form_validation->run()){

                //Save new factoryName
                $saved = $this->factories_model->add_factory($factoryName,$factoryCode,$region_id);
                if($saved){
                    // Display success message
                    $this->session->set_flashdata('appmsg', 'Factory added successfully!');
                    $this->session->set_flashdata('alert_type', 'alert-success');
                    $this->session->set_flashdata('alert_type_', 'success');
                    redirect('factories/add');

                }else{
                    // Display fail message
                    $this->session->set_flashdata('appmsg', 'Factory NOT added! Check logs');
                    $this->session->set_flashdata('alert_type', 'alert-danger');
                    $this->session->set_flashdata('alert_type_', 'error');
                    redirect('factories/add');
                }


            }
        }

        //Retrieve factories
        $regions = $this->regions_m->get_all_regions();
        $data['regions'] = $regions;

        $data['factoryName'] =$factoryName;
        $data['factoryCode'] =$factoryCode;
        $data['region_id'] =$region_id;
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Add Factory";
        $data['mainContent']='factory/add_factory';
        $this->load->view('templates/template',$data); 
    }

    function edit($id=null){

        if(!empty($id)){
            //retrieve factoryName to edit
            $to_edit = $this->factories_model->get_factory($id);
            // print_r($to_edit);
            // return;
            //display reply view
            $data['id']=$id;
            $data['factoryName']=$to_edit->name;
            $data['factoryCode']=$to_edit->code;
            $data['region_id']=$to_edit->region_id;
        }else{
            // No factoryName id specified
            $this->session->set_flashdata('appmsg', 'An Error Was Encountered! No identifier provided ');
            $this->session->set_flashdata('alert_type', 'alert-danger');
            $this->session->set_flashdata('alert_type_', 'error');
            redirect('factories');
        }

        //Retrieve regions
        $regions = $this->regions_m->get_all_regions();
        $data['regions'] = $regions;
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Edit Factory";
        $data['mainContent']='factory/edit_factory';
        $this->load->view('templates/template',$data);
    }

    function modify(){

        // SET VALIDATION RULES
        $this->form_validation->set_rules('factoryName', 'Factory Name', 'required|max_length[50]');
        $this->form_validation->set_rules('factoryCode', 'Factory Code', 'alpha_dash|max_length[20]');
        $this->form_validation->set_rules('region_id', 'Region', 'required|numeric');

        // $this->form_validation->set_rules('factoryName', 'Factory Name', 'required|max_length[50]');
        // $this->form_validation->set_rules('code', 'Factory Code', 'alpha_dash|max_length[20]');
        // $this->form_validation->set_rules('region_id', 'Region', 'required|numeric');

        // has the form been submitted
        if($this->input->post()){

            $id = $this->input->post('id');
            $factoryName = trim($this->input->post('factoryName'));
            $code = trim($this->input->post('factoryCode'));
            $region_id = trim($this->input->post('region_id'));

            //Does it have valid form info (not empty values)
            if($this->form_validation->run()){

                //verify factoryName name doesnt exist except current edited factoryName
                $factory_exists = $this->factories_model->verify_factory($id,$factoryName);
                $code_exists = $this->factories_model->verify_factory($id,$code);
                if($factory_exists){
                    //return fail. factoryName name already in use
                    $this->session->set_flashdata('appmsg', 'This Factory "'.$factoryName.'" already exists');
                    $this->session->set_flashdata('alert_type', 'alert-danger');
                    $this->session->set_flashdata('alert_type_', 'error');
                    redirect('factories/edit/'.$id);
                }elseif($code_exists){
                    //return fail. factoryName name already in use
                    $this->session->set_flashdata('appmsg', 'This Factory Code"'.$code.'" already exists');
                    $this->session->set_flashdata('alert_type', 'alert-danger');
                    $this->session->set_flashdata('alert_type_', 'error');
                    redirect('factories/edit/'.$id);
                }else{
                    //Save new factoryName
                    $saved = $this->factories_model->update_factory($id,$factoryName,$code,$region_id);

                    if($saved){
                        // Display success message
                        $this->session->set_flashdata('appmsg', 'Factory updated successfully!');
                        $this->session->set_flashdata('alert_type', 'alert-success');
                        $this->session->set_flashdata('alert_type_', 'success');
                        redirect('factories');

                    }else{
                        // Display fail message
                        $this->session->set_flashdata('appmsg', 'Factory NOT updated! Check logs');
                        $this->session->set_flashdata('alert_type', 'alert-danger');
                        $this->session->set_flashdata('alert_type_', 'error');
                        redirect('factories');
                    }
                }

            }
            $errors = validation_errors();
            $this->session->set_flashdata('appmsg', $errors);
            $this->session->set_flashdata('alert_type', 'alert-danger');
            $this->session->set_flashdata('alert_type_', 'error');
            redirect('factories/edit/'.$id);
        }

        redirect('factories');
    }

    function import(){

        $data['base']=$this->config->item('base_url');
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Import Factrories";
        $data['mainContent']='factory/import_factories';
        $this->load->view('templates/template',$data);
        
    }

    function do_upload(){
        $config['upload_path'] = './uploads/factories/';
        $config['allowed_types'] = 'xls|xlsx';
        //$config['overwrite'] = TRUE;
        $config['max_size']	= '1000';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        $config['encrypt_name']	= TRUE;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload()){
            $error = array('error' => $this->upload->display_errors());

            log_message('error','Error: File not imported. '.$error);
            // Display fail message
            $this->session->set_flashdata('appmsg', $error['error']);
            $this->session->set_flashdata('alert_type', 'alert-danger');
            $this->session->set_flashdata('alert_type_', 'error');
            redirect('factories/import');
        }else{
            $data = array('upload_data' => $this->upload->data());

            foreach($data['upload_data'] as $item => $value){
                log_message('info','item: '.$item. ' value: '.$value);
            }

            $data2 =  $this->upload->data();
            $file_name= $data2['file_name'];

            $result = $this->import_excel($file_name);

            $importedNo =$result['count'];
            $existing_regions = $result['existing'];
            $notImported = $result['notadded'];

            // Display success message
            $this->session->set_flashdata('existing', $existing_regions);
            $this->session->set_flashdata('notimported', $notImported);
            $this->session->set_flashdata('appmsg', 'Factories imported: '.$importedNo);
            $this->session->set_flashdata('alert_type', 'alert-success');
            $this->session->set_flashdata('alert_type_', 'success');
            redirect('factories/import');
        }
    }

    function import_excel($fileName){
        $this->load->library('Excel');
        $this->load->model('regions_m');
        //  Include PHPExcel_IOFactory


        $inputFileName = './uploads/factories/'.$fileName;

        //  Read your Excel workbook
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch(Exception $e) {
            die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            return array('count'=>'0. Error reading uploaded file','existing'=>'','notadded'=>'');
        }

        //  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = 'C';

        $addCounter = 0;
        $notAdded = '';
        $existingFactories = '';

        //  Loop through each row of the worksheet in turn
        for ($row = 2; $row <= $highestRow; $row++) {
            //  Read a row of data into an array
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

            $factoryData = $rowData[0];
            $factoryName = trim($factoryData[0]);
            $factoryCode = trim($factoryData[1]);
            $factoryRegion = trim($factoryData[2]);

            if ($factoryName != null AND $factoryRegion!=null) {
                log_message('info', 'Excel Factory Name: ' . $factoryName . '. Region: ' . $factoryRegion);

                $regionId = $this->regions_m->getAddRegionId($factoryRegion);
                $factoryexists = $this->factories_model->check_factory_region($factoryName,$regionId);
                if($factoryexists){
                    $existingFactories =$existingFactories.' | '.$factoryName;
                }else{
                    $factory_added = $this->factories_model->add_factory($factoryName,$factoryCode,$regionId,NULL,NULL);
                    if($factory_added){
                        $addCounter++;
                        //log the region added
                        log_message('info',$factoryName.' ADDED SUCCESSFULLY! ');

                    }else{
                        $notAdded .= ' '.$factoryName;
                        //log the region as not added
                        log_message('info',$factoryName.' NOT ADDED! ');
                    }
                }

            }
        }

        $import_result = array('count'=>$addCounter,'existing'=>$existingFactories,'notadded'=>$notAdded);

        return $import_result;
    }

    function assign($id=null){

        if(!empty($id)){
            //retrieve factoryName to edit
            $factory_details = $this->factories_model->get_factory($id);
            $region_id = $factory_details->region_id;
            $region_details = $this->regions_m->get_region($region_id);
            $supervisors = $this->supervisors_m->get_SupervisorsNotInFactoryID($id);

            //display reply view
            $data['id']=$id;
            $data['factoryName']=$factory_details->name;
            $data['region']=$region_details->name;
            $data['supervisors']=$supervisors;
        }else{
            // No factoryName id specified
            $this->session->set_flashdata('appmsg', 'An Error Was Encountered! No identifier provided ');
            $this->session->set_flashdata('alert_type', 'alert-danger');
            $this->session->set_flashdata('alert_type_', 'error');
            redirect('factories');
        }


        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Assign Clerks to Factory";
        $data['mainContent']='factories/assign_factory_supervisors';
        $this->load->view('templates/template',$data); 
    }

    function assignsupervisor(){
        // SET VALIDATION RULES
        $this->form_validation->set_rules('factoryName', 'Factory Name', 'required');
        $this->form_validation->set_rules('supervisor', 'Select atleast one supervisors', 'required');

        // has the form been submitted
        if($this->input->post()){

            $factory_id = $this->input->post('id');
            $factoryName = $this->input->post('factoryName');
            $supervisor = $this->input->post('supervisor');



            //Does it have valid form info (not empty values)
            if($this->form_validation->run()){
                $factory_details = $factory_details = $this->factories_model->get_factory($factory_id);
                $region_id = $factory_details->region_id;

                $count = 0;
                foreach( $supervisor as $ta){
                    //check if supervisor exists in factoryName
                    $ta_exists = $this->supervisors_m->check_supervisor_in_factory($ta,$factory_id);

                    if(!$ta_exists){
                        //Save new factoryName TA
                        $saved = $this->supervisors_m->add_supervisor_to_factory($ta,$factory_id,$region_id);
                        if($saved){
                            $count++;
                        }
                    }

                }

                // Display success message
                $this->session->set_flashdata('appmsg', $count.' Clerk(s) have being  successfully assigned to '.$factory_details->name.' Factory!');
                $this->session->set_flashdata('alert_type', 'alert-success');
                $this->session->set_flashdata('alert_type_', 'success');
                redirect('factories');



            }
            $errors = validation_errors();
            $this->session->set_flashdata('appmsg', $errors);
            $this->session->set_flashdata('alert_type', 'alert-danger');
            $this->session->set_flashdata('alert_type_', 'error');
            redirect('factories/addsupervisor/'.$factory_id);
        }

        redirect('factories');
    }

    function supervisors($id=null){
        if(!empty($id)){
            //retrieve factoryName details
            $factory_details = $this->factories_model->get_factory($id);
            $region_id = $factory_details -> region_id;
            $region_details = $this->regions_m->get_region($region_id);



            //purchase report details
            $data['id']=$id;
            $data['region_name']=$region_details -> name;
            $data['factory_name']=$factory_details -> name;

        }else{
            //return fail.
            $this->session->set_flashdata('appmsg', 'Error encountered! No identifier specified');
            $this->session->set_flashdata('alert_type', 'alert-warning');
            $this->session->set_flashdata('alert_type_', 'warning');
            redirect('factories');
        }

        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Factory Clerks";
        $data['mainContent']='factories/view_factory_supervisors';
        $this->load->view('templates/template',$data); 

    }

    function factory_supervisors($id){
        if(!empty($id)) {
            $this->datatables->select('supervisors.id AS id,supervisors.name as name,supervisors.mobile as mobile,
                supervisors.email as email,supervisors.division as division, supervisors.modified As modified,supervisors.created As created')
            ->unset_column('id')
            ->add_column('actions', get_factories_supervisor_buttons('$1',$id), 'id')
            ->from('supervisors_factories')
            ->join('supervisors', 'supervisors_factories.supervisor_id = supervisors.id')
            ->where('supervisors_factories.factory_id',$id);

            echo $this->datatables->generate();


        }
    }

    function removesupervisor($id,$factory_id){
        if(!empty($id) AND !empty($factory_id)) {
            $deleted = $this->supervisors_m->remove_supervisor_from_factory($id,$factory_id);
            if($deleted){
                //return success.
                $this->session->set_flashdata('appmsg', 'Clerk has being removed from factory');
                $this->session->set_flashdata('alert_type', 'alert-success');
                $this->session->set_flashdata('alert_type_', 'success');
                redirect('factories/supervisors/'.$factory_id);
            } else{
                //return fail.
                $this->session->set_flashdata('appmsg', 'Failed to remove supervisor from factory! Check logs');
                $this->session->set_flashdata('alert_type', 'alert-warning');
                $this->session->set_flashdata('alert_type_', 'warning');
                redirect('factories/supervisors/'.$factory_id);
            }


        }
    }

    function getFactoryByRegion($id=null){

        if(!empty($id)){
            //retrieve factoryName to edit
            $factories = $this->factories_model->get_factories_by_regionId($id);
            if ($factories === false) {
                return null;
            }
            echo json_encode($factories);
        }else{
            // No factoryName id specified
            $this->session->set_flashdata('appmsg', 'An Error Was Encountered! No identifier provided ');
            $this->session->set_flashdata('alert_type', 'alert-danger');
            $this->session->set_flashdata('alert_type_', 'error');
            redirect('factories');
        }

    }

    function settings($selectedfactory)
    {
        $role = $this->session->userdata('role');
        $userfactory = $this->session->userdata('factory');
        $factory = $this->session->userdata('factory');

        
        // if ($role !== "SUPER_USER" || $role !== "ADMIN") {
        //     // Display message
        //     $this->session->set_flashdata('appmsg', 'You are not allowed to access this function');
        //     $this->session->set_flashdata('alert_type', 'alert-info');
        //     redirect('dashboard');
        // }
        // SET VALIDATION RULES
        // $this->form_validation->set_rules('appid', 'Application ID', 'required|exact_length[10]|alpha_dash');
        // $this->form_validation->set_rules('password', 'Application Password', 'required|max_length[150]|alpha_numeric');
        // $this->form_validation->set_rules('shortcode', 'SMS Short Code', 'required|max_length[20]|alpha_dash');
        // $this->form_validation->set_rules('keyword', 'SMS Keyword', 'required|max_length[20]|alpha_numeric');
        // $this->form_validation->set_rules('shortcodeName', 'Source Address', 'required|max_length[60]|alpha_numeric');
        // $this->form_validation->set_rules('subscription', 'Subscription Keyword', 'required|max_length[20]|alpha_numeric');
        // $this->form_validation->set_rules('unsubscription', 'Un-subscription Keyword', 'required|max_length[20]|alpha_numeric');
        // $this->form_validation->set_rules('groups', 'Products linked Group', 'numeric');
        // // $this->form_validation->set_rules('factorye', 'Factory', 'required|numeric');
        // $this->form_validation->set_rules('smsurl', 'SMS SDP Server URL', 'required|max_length[150]');
        // $this->form_validation->set_rules('balanceurl', 'SMS SDP Balance Server URL', 'required|max_length[150]');
        // $this->form_validation->set_rules('smsapproval', 'SMS Approval Status', 'required');
        // $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $origin_appid="";
        $origin_password="";
        $origin_shortcode="";
        $origin_shortcodeName="";
        $origin_keyword="";
        $origin_smsurl="";
        $origin_balanceurl="";
        $subscription_word="";
        $unsubscription_word="";
        $productsgroupid="";
        $smsapproval = "";
        $factoryid = "";
        $originshortcode = "";
        
            // $configurationData = $this->settings_m->get_configuration();
            $configurationData = $this->settings_m->get_configuration_by_factory($selectedfactory);
            // print_r($configurationData);
            //     return;
            if($configurationData){
                $origin_appid = $configurationData->value1;
                $origin_password = $configurationData->value2;
                $origin_shortcode = $configurationData->value3;
                $origin_keyword = $configurationData->value4;
                $origin_smsurl = $configurationData->value5;
                $subscription_word = $configurationData->value6;
                $unsubscription_word = $configurationData->value7;
                $productsgroupid = $configurationData->value8;
                $origin_shortcodeName = $configurationData->value9;
                $originshortcode = $configurationData->shortcode;
                $origin_balanceurl = $configurationData->balanceurl;
                $smsapproval = $configurationData->smsapproval;
                $factoryid = $configurationData->factory_id;
            }
        $groups = $this->groups_model->get_all_groups();
        $factories = $this->factories_model->get_all_factories();

        $data['groups']=$groups;
        $data['factories']=$factories;
        $data['appid']=$origin_appid;
        $data['password']=$origin_password;
        $data['shortcode']=$origin_shortcode;
        $data['shortcodeNumber']=$originshortcode;
        $data['keyword']=$origin_keyword;
        $data['smsurl']=$origin_smsurl;
        $data['subscription']=$subscription_word;
        $data['unsubscription']=$unsubscription_word;
        $data['productsgroupid']=$productsgroupid;
        $data['factoryid']=$factoryid;
        $data['shortcodeName']=$origin_shortcodeName;
        $data['balanceurl']=$origin_balanceurl;
        $data['smsapproval']=$smsapproval;
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Configuration Settings";
        $data['mainContent'] = 'factory/factory_settings';
        $this->load->view('templates/template', $data);
    }

    function update_settings()
    {

        $role = $this->session->userdata('role');
        $userfactory = $this->session->userdata('factory');
        $factory = $this->session->userdata('factory');

        
        // if ($role !== "SUPER_USER" ) {
        //     // Display message
        //     $this->session->set_flashdata('appmsg', 'You are not allowed to access this function');
        //     $this->session->set_flashdata('alert_type', 'alert-info');
        //     redirect('dashboard');
        // }
        // SET VALIDATION RULES
        $this->form_validation->set_rules('appid', 'Application ID', 'required|exact_length[10]|alpha_dash');
        $this->form_validation->set_rules('password', 'Application Password', 'required|max_length[150]|alpha_numeric');
        $this->form_validation->set_rules('shortcode', 'SMS Short Code', 'required|max_length[20]|alpha_dash');
        $this->form_validation->set_rules('keyword', 'SMS Keyword', 'required|max_length[20]|alpha_numeric');
        $this->form_validation->set_rules('shortcodeName', 'Source Address', 'required|max_length[60]|alpha_numeric');
        $this->form_validation->set_rules('subscription', 'Subscription Keyword', 'required|max_length[20]|alpha_numeric');
        $this->form_validation->set_rules('unsubscription', 'Un-subscription Keyword', 'required|max_length[20]|alpha_numeric');
        $this->form_validation->set_rules('groups', 'Products linked Group', 'numeric');
        // $this->form_validation->set_rules('factorye', 'Factory', 'required|numeric');
        $this->form_validation->set_rules('smsurl', 'SMS SDP Server URL', 'required|max_length[150]');
        $this->form_validation->set_rules('balanceurl', 'SMS SDP Balance Server URL', 'required|max_length[150]');
        $this->form_validation->set_rules('smsapproval', 'SMS Approval Status', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $origin_appid="";
        $origin_password="";
        $origin_shortcode="";
        $origin_shortcodeName="";
        $origin_keyword="";
        $origin_smsurl="";
        $origin_balanceurl="";
        $subscription_word="";
        $unsubscription_word="";
        $productsgroupid="";
        $smsapproval = "";
        $factoryid = "";
        $originshortcode = "";

        // has the form been submitted
        if($this->input->post())
        {

            $origin_appid = $this->input->post('appid');
            $origin_password = $this->input->post('password');
            $origin_shortcode = $this->input->post('shortcode');
            $originshortcode = $this->input->post('shortcodeNumber');
            $origin_shortcodeName = $this->input->post('shortcodeName');
            $origin_keyword = $this->input->post('keyword');
            $origin_smsurl = $this->input->post('smsurl');
            $origin_balanceurl = $this->input->post('balanceurl');
            $subscription_word = $this->input->post('subscription');
            $unsubscription_word = $this->input->post('unsubscription');
            $productsgroupid = $this->input->post('groups');
            $smsapproval = $this->input->post('smsapproval');
            $factoryid = $this->input->post('factoryid');

            
            
            //Does it have valid form info (not empty values)
            if($this->form_validation->run()){
                //Save new product
                $saved = $this->settings_m->save_app_configuration($origin_appid,$origin_password,$origin_shortcode,$origin_keyword,$origin_smsurl,$subscription_word,$unsubscription_word,$productsgroupid,$origin_shortcodeName,$originshortcode,$origin_balanceurl,$smsapproval,$factoryid);
                // print($saved);
                // return;
                if($saved){
                    // Display success message
                    $this->session->set_flashdata('appmsg', 'Configuration settings saved successfully!');
                    $this->session->set_flashdata('alert_type', 'alert-success');
                    $this->session->set_flashdata('alert_type_', 'success');
                    redirect('factories');

                }else{
                    // Display fail message
                    $this->session->set_flashdata('appmsg', 'Configuration settings Not saved! Check logs');
                    $this->session->set_flashdata('alert_type', 'alert-danger');
                    $this->session->set_flashdata('alert_type_', 'error');
                    redirect('factories');
                }
            }
        }
        // $groups = $this->groups_model->get_all_groups();
        // $factories = $this->factories_model->get_all_factories();

        // $data['groups']=$groups;
        // $data['factories']=$factories;
        // $data['appid']=$origin_appid;
        // $data['password']=$origin_password;
        // $data['shortcode']=$origin_shortcode;
        // $data['shortcodeNumber']=$originshortcode;
        // $data['keyword']=$origin_keyword;
        // $data['smsurl']=$origin_smsurl;
        // $data['subscription']=$subscription_word;
        // $data['unsubscription']=$unsubscription_word;
        // $data['productsgroupid']=$productsgroupid;
        // $data['factoryid']=$factoryid;
        // $data['shortcodeName']=$origin_shortcodeName;
        // $data['balanceurl']=$origin_balanceurl;
        // $data['smsapproval']=$smsapproval;
        // $data['user_role'] = $this->session->userdata('role');
        // $data['title'] = "Factory Configuration Settings";
        // $data['mainContent'] = 'factory/factory_settings';
        // $this->load->view('templates/template', $data);
    }
    

    public function download()
    {
        //load download helper
        $this->load->helper('download');
        
        //file path
        $filePath = 'uploads/templates/';
        $fileName = 'factories_import.xlsx';
        $data = file_get_contents($filePath.$fileName);
        force_download($fileName, $data);
        redirect('factories/import');
}
}