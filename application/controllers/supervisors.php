<?php
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 10/6/2014
 * Time: 9:30 AM
 */

class Supervisors extends Admin_Controller{

    function __construct(){
        parent::__construct();
        $this->load->helper('buttons_helper');
        $this->load->model('supervisors_m');
        $this->load->model('towns_m');
        $this->load->model('regions_m');
    }

    function index(){

        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Supervisors";
        $data['mainContent']='supervisors/view_supervisors';
        $this->load->view('templates/template',$data); 

    }

    function datatables(){
        $this->datatables->select('supervisors.id AS id,supervisors.name as name,mobile,email,division, supervisors.modified As modified,supervisors.created As created')
            ->unset_column('id')
            ->add_column('actions', get_supervisors_buttons('$1'), 'id')
            ->from('supervisors');
        echo $this->datatables->generate();
    }

    function add(){
        // SET VALIDATION RULES
        $this->form_validation->set_rules('name', "Supervisor Name", 'required|max_length[60]|is_unique[supervisors.name]');
        $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|numeric|exact_length[12]|is_unique[supervisors.mobile]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[100]|is_unique[supervisors.email]');
        $this->form_validation->set_rules('division', 'Supervisor Division', 'required|max_length[40]');
        $this->form_validation->set_message('is_unique', 'The %s already exists');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $name="";
        $mobile ="";
        $email="";
        $division ="";

        // has the form been submitted
        if($this->input->post()){
            $name = trim($this->input->post('name'));
            $mobile = ($this->input->post('mobile'));
            $email = $this->input->post('email');
            $division = ($this->input->post('division'));


            //Does it have valid form info (not empty values)
            if($this->form_validation->run()){

                //Save new distributor
                $saved = $this->supervisors_m->save_supervisor(ucwords($name),$mobile,strtolower($email),strtoupper($division));

                if($saved){
                    // Display success message
                    $this->session->set_flashdata('appmsg', 'New supervisor added successfully!');
                    $this->session->set_flashdata('alert_type', 'alert-success');
                    redirect('supervisors/add');

                }else{
                    // Display fail message
                    $this->session->set_flashdata('appmsg', 'Supervisor NOT added! Check logs');
                    $this->session->set_flashdata('alert_type', 'alert-danger');
                    redirect('supervisors/add');
                }
            }
        }


        $data['name']=$name;
        $data['mobile']=$mobile;
        $data['division']=$division;
        $data['email']=$email;

        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Add Supervisor";
        $data['mainContent']='supervisors/add_supervisor';
        $this->load->view('templates/template',$data); 

    }

    function edit($id=null){
        if(!empty($id)){
            //retrieve the msisdn for the recipient
            $to_edit = $this->supervisors_m->get_supervisor($id);

            if($to_edit){
                //display reply view
                $data['id']=$id;
                $data['name']=$to_edit->name;
                $data['mobile']=$to_edit->mobile;
                $data['email']=$to_edit->email;
                $data['division']=$to_edit->division;


            }else{
                //return to supervisor. no id specified
                $this->session->set_flashdata('appmsg', 'Error encountered! No record found');
                $this->session->set_flashdata('alert_type', 'alert-warning');
                redirect('supervisors');
            }

        }else{
            //return to supervisor. no id specified
            $this->session->set_flashdata('appmsg', 'Error encountered! No identifier specified');
            $this->session->set_flashdata('alert_type', 'alert-warning');
            redirect('supervisors');
        }

        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Edit Supervisor";
        $data['mainContent']='supervisors/edit_supervisor';
        $this->load->view('templates/template',$data); 

    }

    function modify(){
        // SET VALIDATION RULES
        $this->form_validation->set_rules('name', "TA's Name", 'required|max_length[60]');
        $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|numeric|exact_length[12]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[100]');
        $this->form_validation->set_rules('division', 'Division', 'required|max_length[40]');
        /*$this->form_validation->set_rules('region_id', 'region', 'required');
        $this->form_validation->set_rules('town_id', 'town', 'required');*/

        // has the form been submitted
        if($this->input->post()){
            $id = $this->input->post('id');
            $name = trim($this->input->post('name'));
            $mobile = ($this->input->post('mobile'));
            $email = $this->input->post('email');
            $division = ($this->input->post('division'));

            //Does it have valid form info (not empty values)
            if($this->form_validation->run()){

                /*//verify name if it exists other than modified field
                $name_exists = $this->supervisors_m->verify_supervisor_name($id,$name);

                if($name_exists){
                    //return fail. supervisor name already in use
                    $this->session->set_flashdata('appmsg', 'This Supervisor  Name "'.$name.'" is already in use by a different TA');
                    $this->session->set_flashdata('alert_type', 'alert-danger');
                    redirect('supervisors/edit/'.$id);
                }else{*/
                    //Verify mobile number1
                $valid_mobile = $this->__checkMobile($mobile);

                    if(!$valid_mobile){
                        //return fail. supervisor mobile already in use
                        $this->session->set_flashdata('appmsg', 'Invalid Mobile Number format: "'.$mobile.'". Use this format: "2547xxxxxxxx"  e.g. 254712345678');
                        $this->session->set_flashdata('alert_type', 'alert-danger');
                        redirect('supervisors/edit/'.$id);
                    }else{
                        //Verify Email
                        $email_exists = $this->supervisors_m->verify_supervisor_email($id,$email);
                        if($email_exists){
                            //return fail. supervisor email already in use
                            $this->session->set_flashdata('appmsg', 'This Supervisor Email "'.$email.'" is already in use by a different Supervisor');
                            $this->session->set_flashdata('alert_type', 'alert-danger');
                            redirect('supervisors/edit/'.$id);
                        }else{
                            //update supervisor
                            $saved = $this->supervisors_m->update_supervisor($id,ucwords($name),$mobile,strtolower($email),strtoupper($division));

                            if($saved){
                                // Display success message
                                $this->session->set_flashdata('appmsg', 'Supervisor modified successfully!');
                                $this->session->set_flashdata('alert_type', 'alert-success');
                                redirect('supervisors');

                            }else{
                                // Display fail message
                                $this->session->set_flashdata('appmsg', 'Supervisor NOT modified! Check logs');
                                $this->session->set_flashdata('alert_type', 'alert-danger');
                                redirect('supervisors');
                            }
                        }




                    }

                //}

            }
            $errors = validation_errors();
            $this->session->set_flashdata('appmsg', $errors);
            $this->session->set_flashdata('alert_type', 'alert-danger');
            redirect('supervisors/edit/'.$id);
        }

        redirect('supervisors');
    }

    function delete($id=null){
        if(!empty($id)){
            $deleted = $this-> supervisors_m -> delete($id);
            if($deleted){
                $this->session->set_flashdata('appmsg', 'Supervisor successfully deleted!');
                $this->session->set_flashdata('alert_type', 'alert-success');
            }else{
                $this->session->set_flashdata('appmsg', 'Failed to delete Supervisor! Check logs.');
                $this->session->set_flashdata('alert_type', 'alert-warning');
            }
        }else{
            //return to supervisor. no id specified
            $this->session->set_flashdata('appmsg', 'Error encountered! No identifier specified');
            $this->session->set_flashdata('alert_type', 'alert-warning');

        }
        redirect('supervisors');
    }

    function __get_towns($region){
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->towns_m->get_towns_by_region($region)));
    }

    function import(){

        $data['base']=$this->config->item('base_url');
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Import Supervisors";
        $data['mainContent']='supervisors/import_supervisors';
        $this->load->view('templates/template',$data); 
    }

    function do_upload(){
        $config['upload_path'] = './uploads/supervisors/';
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
            redirect('supervisors/import');
        }else{
            $data = array('upload_data' => $this->upload->data());

            foreach($data['upload_data'] as $item => $value){
                log_message('info','item: '.$item. ' value: '.$value);
            }

            $data2 =  $this->upload->data();
            $file_name= $data2['file_name'];

            $result = $this->import_excel($file_name);

            $importedNo =$result['count'];
            $existing_supervisor = $result['existing'];
            $notImported = $result['notadded'];

            // Display success message
            $this->session->set_flashdata('existing', $existing_supervisor);
            $this->session->set_flashdata('notimported', $notImported);
            $this->session->set_flashdata('appmsg', 'Supervisors imported: '.$importedNo);
            $this->session->set_flashdata('alert_type', 'alert-success');
            redirect('supervisors/import');
        }
    }

    function import_excel($fileName){
        $this->load->library('Excel');
        $this->load->model('regions_m');
        $this->load->model('towns_m');
        //  Include PHPExcel_IOFactory


        $inputFileName = './uploads/supervisors/'.$fileName;

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
        $highestColumn = 'F';

        $addCounter = 0;
        $notAdded = '';
        $notAddedTown = '';
        $notAddedRegion = '';
        $existingsupervisorNames = '';
        $existingMobiles = '';
        $invalidMobiles = '';
        $invalidEmails = '';
        $existingEmails = '';

        //  Loop through each row of the worksheet in turn
        for ($row = 2; $row <= $highestRow; $row++) {
            //  Read a row of data into an array
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

            $supervisorData = $rowData[0];

            $supervisorName = $supervisorData[0];
            $mobile = trim($supervisorData[1]);
            $email = trim($supervisorData[2]);
            $division = trim($supervisorData[3]);
            $region = trim($supervisorData[4]);
            $town = trim($supervisorData[5]);




            if ( $supervisorName!=null AND $mobile!=null AND $email!=null AND $division!=null AND  $region!=null AND $town!=null ) {
                //log_message('info', 'TA Name: ' . $supervisorName .'. Mobile: ' . $mobile. '. Email: ' . $email.'. Division: ' . $division. '. Region: ' . $region. '. Town: ' . $town);
                $regionId = $this->regions_m->getAddRegionId($region);
                $townId = $this->towns_m->getAddTownId($town,$regionId);

                // Check supervisor email exists or not
                $existsEmail = $this->supervisors_m->check_supervisor_email(strtolower($email));

                if($existsEmail){
                    //Get id of Supervisor
                    $supervisor = $this->supervisors_m->get_supervisor_by_email(strtolower($email));

                    //check if supervisor exists in town
                    $ta_exists = $this->supervisors_m->check_supervisor_in_town($supervisor->id,$townId);
                    log_message('info','PAss test');
                    if($ta_exists){
                        $existingEmails =$existingEmails.' | '.$email.' - '.$town;
                        //log as not added
                        log_message('info',$email.' EXISTS! IGNORED ENTRY: '.$supervisorName.' '.$mobile.' '.$email.' '.$division.' '.$region.' '.$town);
                    }else{

                        //save stockist
                        $supervisor_assigned = $this->supervisors_m->add_supervisor_to_town($supervisor->id,$townId,$regionId);

                        if($supervisor_assigned){
                            $addCounter++;
                            //log the ta added
                            log_message('info',$supervisorName.' '.$mobile.' '.$email.' '.$division.' '.$region.' '.$town.' ADDED SUCCESSFULLY! ');

                        }else{
                            $notAdded = $notAdded. ' | '.$email.' - '.$supervisorName;
                            //log the ta as not added
                            log_message('info','supervisor NOT ASSIGNED! '.$supervisorName.' '.$mobile.' '.$email.' '.$division.' '.$region.' '.$town);
                        }
                    }

                }else{

                    // check email validity
                    if(!valid_email($email)){
                        //Email invalid
                        $invalidEmails = $invalidEmails.' | '.$email;
                        //log as not added
                        log_message('info',$email.' INVALID EMAIL! IGNORED ENTRY: '.$supervisorName.' '.$mobile.' '.$email.' '.$division.' '.$region.' '.$town);
                    }else{

                        //check mobile validity
                        $valid_mobile = $this->__checkMobile($mobile);

                        if(!$valid_mobile){
                            //Mobile invalid
                            $invalidMobiles =$invalidMobiles.' | '.$mobile;
                            //log as not added
                            log_message('info',$mobile.' INVALID MOBILE! IGNORED ENTRY: '.$supervisorName.' '.$mobile.' '.$email.' '.$division.' '.$region.' '.$town);
                        }else{

                            //save stockist
                            $supervisor_added = $this->supervisors_m->add_supervisor(ucwords($supervisorName),$mobile,strtolower($email),strtoupper($division),$regionId,$townId);

                            if($supervisor_added){
                                $addCounter++;
                                //log the region added
                                log_message('info',$supervisorName.' '.$mobile.' '.$email.' '.$division.' '.$region.' '.$town.' ADDED SUCCESSFULLY! ');

                            }else{
                                $notAdded = $notAdded. ' | '.$email.' - '.$supervisorName;
                                //log the region as not added
                                log_message('info','supervisor NOT ADDED! '.$supervisorName.' '.$mobile.' '.$email.' '.$division.' '.$region.' '.$town);
                            }

                        }

                    }
                }

            }
        }
        $existingVariables ="";
        if(!empty($existingsupervisorNames)){
            $existingVariables =$existingVariables .'Supervisor: ('.$existingsupervisorNames.') ';
        }

        if(!empty($existingMobiles)){
            $existingVariables =$existingVariables .'Mobile Numbers: ('.$existingMobiles.') ';
        }

        if(!empty($existingEmails)){
            $existingVariables =$existingVariables .'Emails Linked to towns: ('.$existingEmails.') ';
        }

        $notAddedVariables ="";


        $import_result = array('count'=>$addCounter,'existing'=>$existingVariables,'notadded'=>$notAddedVariables);

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
        $fileName = 'import_to_group.csv';
        $data = file_get_contents($filePath.$fileName);
        force_download($fileName, $data);
        redirect('supervisors/import');
    }

}