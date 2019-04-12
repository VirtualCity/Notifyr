<?php
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 10/6/2014
 * Time: 9:30 AM
 */

class Managers extends Admin_Controller{

    function __construct(){
        parent::__construct();
        $this->load->helper('buttons_helper');
        $this->load->model('managers_m');
        $this->load->model('regions_m');
    }

    function index(){

        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Region Managers";
        $data['mainContent']='managers/view_managers';
        $this->load->view('templates/template',$data); 

    }

    function datatables(){
        $this->datatables->select('managers.id AS id,managers.name as name,mobile,email,division,regions.name AS region,managers.modified As modified,managers.created As created')
        ->unset_column('id')
        ->add_column('actions', get_area_managers_buttons('$1'), 'id')
        ->from('managers')
        ->join('regions', 'managers.region_id = regions.id');
        echo $this->datatables->generate();
    }

    function add(){
        // SET VALIDATION RULES

        $this->form_validation->set_rules('name', 'Manager Name', 'required|max_length[60]|is_unique[managers.name]');
        $this->form_validation->set_rules('mobile', 'Manager Mobile', 'required|numeric|max_length[12]|is_unique[managers.mobile]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[100]|is_unique[managers.email]');
        $this->form_validation->set_rules('region', 'Manager Region', 'required');
        $this->form_validation->set_rules('division', 'Managers Hub', 'required|max_length[40]');
        $this->form_validation->set_message('is_unique', 'The %s already exists');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');


        $name ="";
        $mobile="";
        $email="";
        $region_id ="";
        $division ="";


        // has the form been submitted
        if($this->input->post()){
            $name = trim($this->input->post('name'));
            $mobile = ($this->input->post('mobile'));
            $email = ($this->input->post('email'));
            $division = ($this->input->post('division'));
            $region_id = ($this->input->post('region'));

            //Does it have valid form info (not empty values)
            if($this->form_validation->run()){


                //Save new Manager
                $saved = $this->managers_m->add_manager(ucwords($name),$mobile,strtolower($email),strtoupper($division),$region_id);

                if($saved){
                    // Display success message
                    $this->session->set_flashdata('appmsg', 'Area Manager added successfully!');
                    $this->session->set_flashdata('alert_type', 'alert-success');
                    $this->session->set_flashdata('alert_type_', 'success');
                    redirect('managers/add');

                }else{
                    // Display fail message
                    $this->session->set_flashdata('appmsg', 'Area Manager NOT added! Check logs');
                    $this->session->set_flashdata('alert_type', 'alert-danger');
                    $this->session->set_flashdata('alert_type_', 'danger');
                    redirect('managers/add');
                }
            }
        }
        //Retrieve regions
        $areas = $this->regions_m->get_all_regions();
        $data['areas'] = $areas;


        $data['name']=$name;
        $data['mobile']=$mobile;
        $data['division']=$division;
        $data['email']=$email;
        $data['region_id']=$region_id;

        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Add Region Manager"; //
        $data['mainContent']='managers/add_manager';
        $this->load->view('templates/template',$data); 

    }

    function edit($id=null){
        if(!empty($id)){
            //retrieve manager to edit
            $to_edit = $this->managers_m->get_manager($id);

            //display reply view
            $data['id']=$id;
            $data['name']=$to_edit->name;
            $data['mobile']=$to_edit->mobile;
            $data['email']=$to_edit->email;
            $data['region_id']=$to_edit->region_id;
            $data['division']=$to_edit->division;

            //Retrieve regions
            $areas = $this->regions_m->get_all_regions();
            $data['areas'] = $areas;
        }else{
            //return fail.
            $this->session->set_flashdata('appmsg', 'Error encountered! No identifier specified');
            $this->session->set_flashdata('alert_type', 'alert-warning');
            $this->session->set_flashdata('alert_type_', 'warning');
            redirect('managers');
        }

        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Edit Region Manager";
        $data['mainContent']='managers/edit_manager';
        $this->load->view('templates/template',$data); 

    }

    function modify(){
        // SET VALIDATION RULES

        $this->form_validation->set_rules('name', 'Manager Name', 'required|max_length[60]');
        $this->form_validation->set_rules('mobile', 'Manager Mobile', 'required|numeric|max_length[12]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[100]');
        $this->form_validation->set_rules('region', 'Manager Region', 'required');
        $this->form_validation->set_rules('division', 'Manager Hub', 'required|max_length[40]');

        // has the form been submitted
        if($this->input->post()){
            $id = trim($this->input->post('id'));
            $name = trim($this->input->post('name'));
            $mobile = $this->input->post('mobile');
            $email = $this->input->post('email');
            $region_id = $this->input->post('region');
            $division = $this->input->post('division');

            //Does it have valid form info (not empty values)
            if($this->form_validation->run()){


                //verify name if it exists other than modified field
                $name_exists = $this->managers_m->verify_manager_name($id,$name);

                if($name_exists){
                    //return fail. manager name already in use
                    $this->session->set_flashdata('appmsg', 'This Manager Name "'.$name.'" is already in use by a different Area Manager');
                    $this->session->set_flashdata('alert_type', 'alert-danger');
                    $this->session->set_flashdata('alert_type_', 'danger');
                    redirect('managers/edit/'.$id);
                }else{
                    //Verify mobile number1
                    $mobile_exists = $this->managers_m->verify_manager_mobile($id,$mobile);
                    if($mobile_exists){
                        //return fail. manager mobile already in use
                        $this->session->set_flashdata('appmsg', 'This Manager Mobile "'.$mobile.'" is already in use by a different Area Manager');
                        $this->session->set_flashdata('alert_type', 'alert-danger');
                        $this->session->set_flashdata('alert_type_', 'danger');
                        redirect('managers/edit/'.$id);
                    }else{
                        //Verify Email
                        $email_exists = $this->managers_m->verify_manager_email($id,$email);
                        if($email_exists){
                            //return fail. Manager email already in use
                            $this->session->set_flashdata('appmsg', 'This Manager Email "'.$email.'" is already in use by a different Area Manager');
                            $this->session->set_flashdata('alert_type', 'alert-danger');
                            $this->session->set_flashdata('alert_type_', 'danger');
                            redirect('managers/edit/'.$id);
                        }else{
                            //Save new Manager
                            $saved = $this->managers_m->update_manager($id,ucwords($name),$mobile,strtolower($email),strtoupper($division),$region_id);

                            if($saved){
                                // Display success message
                                $this->session->set_flashdata('appmsg', 'Area Manager modified successfully!');
                                $this->session->set_flashdata('alert_type', 'alert-success');
                                $this->session->set_flashdata('alert_type_', 'success');
                                redirect('managers');

                            }else{
                                // Display fail message
                                $this->session->set_flashdata('appmsg', 'Area Manager NOT modified! Check logs');
                                $this->session->set_flashdata('alert_type', 'alert-danger');
                                $this->session->set_flashdata('alert_type_', 'danger');
                                redirect('managers');
                            }
                        }
                    }

                }


            }
            $errors = validation_errors();
            $this->session->set_flashdata('appmsg', $errors);
            $this->session->set_flashdata('alert_type', 'alert-danger');
            $this->session->set_flashdata('alert_type_', 'danger');
            redirect('managers/edit/'.$id);
        }

        redirect('managers');
    }

    function import(){

        $data['base']=$this->config->item('base_url');
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Import Region Managers";
        $data['mainContent']='managers/import_managers';
        $this->load->view('templates/template',$data); 
    }

    function do_upload(){
        $config['upload_path'] = './uploads/managers/';
        $config['allowed_types'] = 'xls|xlsx';
       // $config['overwrite'] = TRUE;
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
            $this->session->set_flashdata('alert_type_', 'danger');
            redirect('managers/import');
        }else{
            $data = array('upload_data' => $this->upload->data());

            foreach($data['upload_data'] as $item => $value){
                log_message('info','item: '.$item. ' value: '.$value);
            }

            $data2 =  $this->upload->data();
            $file_name= $data2['file_name'];

            $result = $this->import_excel($file_name);

            $importedNo =$result['count'];
            $existing_managers = $result['existing'];
            $notImported = $result['notadded'];

            // Display success message
            $this->session->set_flashdata('existing', $existing_managers);
            $this->session->set_flashdata('notimported', $notImported);
            $this->session->set_flashdata('appmsg', 'Area Managers imported: '.$importedNo);
            $this->session->set_flashdata('alert_type', 'alert-success');
            $this->session->set_flashdata('alert_type_', 'success');
            redirect('managers/import');
        }
    }

    function import_excel($fileName){
        $this->load->library('Excel');
        $this->load->model('regions_m');
        //  Include PHPExcel_IOFactory


        $inputFileName = './uploads/managers/'.$fileName;

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
        $highestColumn = 'E';

        $addCounter = 0;
        $notAdded = '';
        $existingNames = '';
        $existingMobiles = '';
        $existingEmails = '';

        //  Loop through each row of the worksheet in turn
        for ($row = 2; $row <= $highestRow; $row++) {
            //  Read a row of data into an array
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

            $managersData = $rowData[0];
            $managerName = trim($managersData[0]);
            $managerMobile = trim($managersData[1]);
            $managerEmail = trim($managersData[2]);
            $managerDivision = trim($managersData[3]);
            $managerRegion = trim($managersData[4]);

            if ($managerDivision != null AND $managerName!=null AND $managerMobile!=null AND $managerRegion!=null AND $managerEmail !=null) {
                log_message('info', 'Manager Hub: ' .$managerDivision .' Manager Name: ' . $managerName .'. Mobile: ' . $managerMobile. '. Email: ' . $managerEmail. '. Region: ' . $managerRegion);

                // Check region if it exists

                $regionId = $this->regions_m->getAddRegionId($managerRegion);


                    // Check manager name exists or not
                $existsName = $this->managers_m->check_manager_name($managerName);

                if($existsName){
                        //manager Name exists
                    $existingNames =$existingNames.' | '.$managerName;
                        //log as not added
                    log_message('info',$managerName.' EXISTS! IGNORED ENTRY: '.$managerDivision.' '.$managerName.' '.$managerMobile.' '.$managerEmail.' '.$managerRegion);
                }else {
                        // Check manager mobile exists or not
                    $existsMobile = $this->managers_m->check_manager_mobile($managerMobile);
                    $valid_mobile = $this->__checkMobile($managerMobile);
                    log_message('info','Mobile Exist: '.print_r($existsMobile).' Mobile Valid: '.print_r($valid_mobile));
                    if($existsMobile OR $valid_mobile === false){

                        if($existsMobile){
                                //manager Mobile exists
                            $existingMobiles =$existingMobiles.' | '.$managerMobile;
                                //log as not added
                            log_message('info',$managerMobile.' EXISTS! IGNORED ENTRY: '.$managerDivision.' '.$managerName.' '.$managerMobile.' '.$managerEmail.' '.$managerRegion);
                        }else{
                                //manager Mobile not added
                            $notAdded = $notAdded. ' | '.$managerName;
                                //log as not added
                            log_message('info','INVALID MOBILE FORMAT! IGNORED ENTRY: '.$managerDivision.' '.$managerName.' '.$managerMobile.' '.$managerEmail.' '.$managerRegion);
                        }

                    }else {

                            //Email exist
                            // Check manager email exists or not
                        $existsEmail = $this->managers_m->check_manager_email($managerEmail);

                        if(valid_email($managerEmail)===false){
                            $notAdded = $notAdded. ' | '.$managerName;
                                //log as not added
                            log_message('info',' INVALID EMAIL! IGNORED ENTRY: '.$managerDivision.' '.$managerName.' '.$managerMobile.' '.$managerEmail.' '.$managerRegion);
                        }else{

                            if($existsEmail===true){
                                $existingEmails =$existingEmails.' | '.$managerEmail;
                                    //log as not added
                                log_message('info',$managerEmail.' EXISTS! IGNORED ENTRY: '.$managerDivision.' '.$managerName.' '.$managerMobile.' '.$managerEmail.' '.$managerRegion);
                            }else{
                                    //Fields Valid. Add the manager
                                $manager_added = $this->managers_m->add_manager(ucwords($managerName),$managerMobile,strtolower($managerEmail),strtoupper($managerDivision),$regionId);

                                if($manager_added){
                                    $addCounter++;
                                        //log the region added
                                    log_message('info',$managerDivision.' '.$managerName.' '.$managerMobile.' '.$managerEmail.' '.$managerRegion.' ADDED SUCCESSFULLY! ');

                                }else{
                                    $notAdded = $notAdded. ' | '.$managerName;
                                        //log the region as not added
                                    log_message('info','MANAGER NOT ADDED! '.$managerDivision.' '.$managerName.' '.$managerMobile.' '.$managerEmail.' '.$managerRegion);
                                }
                            }

                        }


                    }


                }


            }
        }
        $existingVariables ="";

        if(!empty($existingNames)){
            $existingVariables =$existingVariables .'Manager Names: ('.$existingNames.') ';
        }

        if(!empty($existingMobiles)){
            $existingVariables =$existingVariables .'Manager Mobiles: ('.$existingMobiles.') ';
        }

        if(!empty($existingEmails)){
            $existingVariables =$existingVariables .'Manager Emails: ('.$existingEmails.') ';
        }


        $import_result = array('count'=>$addCounter,'existing'=>$existingVariables,'notadded'=>$notAdded);

        return $import_result;
    }

    function __checkMobile($mobile){
        if(strlen($mobile)===12 ){
            if(substr($mobile,0,3)==254){
                if(ctype_digit($mobile)){
                    return true;
                }else{
                    return false;
                }

            }else{
                return false;
            }

        }else{
            return false;
        }
    }

    public function download(){
        //load download helper
        $this->load->helper('download');
        
        //file path
        $filePath = 'uploads/templates/';
        $fileName = 'managers_import.xlsx';
        $data = file_get_contents($filePath.$fileName);
        force_download($fileName, $data);
        redirect('managers/import');
    }

}