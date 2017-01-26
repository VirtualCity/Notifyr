<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 8/5/14
 * Time: 8:52 AM
 */

class Regions extends Admin_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('buttons_helper');
        $this->load->model('regions_m');
    }

    function index(){


        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Regions";

         $data['mainContent']='regions/view_regions';
        $this->load->view('templates/template',$data);

        
    }

    function datatable(){
        $this->datatables->select('id,name,code,description,modified,created')
            ->unset_column('id')
            ->add_column('actions', get_regions_buttons('$1'), 'id')
            ->from('regions');

        echo $this->datatables->generate();
    }

    function add(){


        $region="";
        $description="";
        $code="";

        // SET VALIDATION RULES
        $this->form_validation->set_rules('region', 'Region Name', 'required|max_length[50]|is_unique[regions.name]');
        $this->form_validation->set_rules('code', 'Region Code', 'max_length[20]|is_unique[regions.name]');
        $this->form_validation->set_rules('description', 'Region Description', 'max_length[200]');
        $this->form_validation->set_message('is_unique', 'The %s already exists');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // has the form been submitted
        if($this->input->post()){
            $region = trim($this->input->post('region'));
            $code = trim($this->input->post('code'));
            $description = trim($this->input->post('description'));

            //Does it have valid form info (not empty values)
            if($this->form_validation->run()){


                //Save new region
                $saved = $this->regions_m->add_region($region,$code,$description);

                if($saved){
                    // Display success message
                    $this->session->set_flashdata('appmsg', 'New Region added successfully!');
                    $this->session->set_flashdata('alert_type', 'alert-success');
                    redirect('regions/add');

                }else{
                    // Display fail message
                    $this->session->set_flashdata('appmsg', 'New Region NOT added! Check logs');
                    $this->session->set_flashdata('alert_type', 'alert-danger');
                    redirect('regions/add');
                }


            }
        }

        $data['region'] =$region;
        $data['code'] =$code;
        $data['description'] =$description;
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Add Region";
         $data['mainContent']='regions/add_region';
        $this->load->view('templates/template',$data);

       
    }

    function edit($id=null){

        if(!empty($id)){
            //retrieve the msisdn for the recipient
            $to_edit = $this->regions_m->get_region($id);

            //display reply view
            $data['id']=$id;
            $data['region']=$to_edit->name;
            $data['code']=$to_edit->code;
            $data['description']=$to_edit->description;
        }else{
            // No region id specified
            $this->session->set_flashdata('appmsg', 'An Error Was Encountered! No identifier provided ');
            $this->session->set_flashdata('alert_type', 'alert-danger');
            redirect('regions');
        }

        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Edit Region";
        $data['mainContent']='regions/edit_region';
        $this->load->view('templates/template',$data);


       



    }

    function modify(){

        // SET VALIDATION RULES
        $this->form_validation->set_rules('region', 'Region Name', 'required|max_length[50]');
        $this->form_validation->set_rules('code', 'Region Code', 'max_length[20]');
        $this->form_validation->set_rules('description', 'Region Description', 'max_length[200]');

        // has the form been submitted
        if($this->input->post()){

            $id = $this->input->post('id');
            $region = trim($this->input->post('region'));
            $code = trim($this->input->post('code'));
            $description = trim($this->input->post('description'));

            //Does it have valid form info (not empty values)
            if($this->form_validation->run()){

                //verify region name doesnt exist except current edited region
                $region_exists = $this->regions_m->verify_region($id,$region);

                if($region_exists){
                    //return fail. region name already in use
                    $this->session->set_flashdata('appmsg', 'This Region name "'.$region.'" already exists');
                    $this->session->set_flashdata('alert_type', 'alert-danger');
                    redirect('regions/edit/'.$id);
                }else{
                    $code_exists = $this->regions_m->verify_code($id,$code);
                    if($code_exists){
                        //return fail. region name already in use
                        $this->session->set_flashdata('appmsg', 'This Region code "'.$code.'" already exists');
                        $this->session->set_flashdata('alert_type', 'alert-danger');
                        redirect('regions/edit/'.$id);
                    }else{
                        //Save new region
                        $saved = $this->regions_m->update_region($id,$region,$code,$description);

                        if($saved){
                            // Display success message
                            $this->session->set_flashdata('appmsg', 'Region updated successfully!');
                            $this->session->set_flashdata('alert_type', 'alert-success');
                            redirect('regions');

                        }else{
                            // Display fail message
                            $this->session->set_flashdata('appmsg', 'Region NOT updated! Check logs');
                            $this->session->set_flashdata('alert_type', 'alert-danger');
                            redirect('regions');
                        }
                    }

                }




            }
            $errors = validation_errors();
            $this->session->set_flashdata('appmsg', $errors);
            $this->session->set_flashdata('alert_type', 'alert-danger');
            redirect('regions/edit/'.$id);
        }

        redirect('regions');
    }

    function import(){

        $data['base']=$this->config->item('base_url');
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Import Regions";

         $data['mainContent']='regions/import_regions';
    
        $this->load->view('templates/template', $data);
    }

    function do_upload(){
        $config['upload_path'] = './uploads/regions/';
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
            redirect('regions/import');
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
            $this->session->set_flashdata('appmsg', 'Regions imported: '.$importedNo);
            $this->session->set_flashdata('alert_type', 'alert-success');
            redirect('regions/import');
        }
    }

    function import_excel($fileName){
        $this->load->library('Excel');
        //  Include PHPExcel_IOFactory


        $inputFileName = './uploads/regions/'.$fileName;

        //  Read your Excel workbook
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch(Exception $e) {
            die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        }

        //  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = 'C';

        $addCounter = 0;
        $notAdded = '';
        $existingRegions = '';

        //  Loop through each row of the worksheet in turn
        for ($row = 2; $row <= $highestRow; $row++) {
            //  Read a row of data into an array
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

            $regionData = $rowData[0];
            $regionName = trim($regionData[0]);
            $regionCode = trim($regionData[1]);
            $regionDescription = trim($regionData[2]);

            if ($regionName != null) {
                log_message('debug', 'Excel Region Name: ' . $regionName . ' Description: ' . $regionDescription);

                // Check region if it exists
                $exists = $this->regions_m->check_region($regionName);
                $exists_code = $this->regions_m->check_code($regionCode);

                if($exists){
                    $existingRegions =$existingRegions.' | '.$regionName;
                    //log the region as not added
                    log_message('debug',$regionName.' EXISTS! ');
                }elseif($exists_code){
                    $existingRegions =$existingRegions.' | '.$regionName;
                    //log the region as not added
                    log_message('debug',$regionName.' EXISTS! ');
                }else{
                    //add the region
                    $region_added = $this->regions_m->add_region($regionName,$regionCode,$regionDescription);

                    if($region_added){
                        $addCounter++;
                        //log the region added
                        log_message('debug',$regionName.' ADDED SUCCESSFULLY! ');

                    }else{
                        $notAdded .= ' '.$regionName;
                        //log the region as not added
                        log_message('debug',$regionName.' NOT ADDED! ');
                    }
                }

            }
        }

        $import_result = array('count'=>$addCounter,'existing'=>$existingRegions,'notadded'=>$notAdded);

        return $import_result;
    }

}