<?php
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 10/6/2014
 * Time: 9:30 AM
 */

class Products extends Admin_Controller{

    function __construct(){
        parent::__construct();
        $this->load->helper('buttons_helper');
        $this->load->model('products_m');
    }

    function index(){

        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Products";
         $data['mainContent']='products/view_products';
        $this->load->view('templates/template', $data);


    }

    function datatable(){
        $this->datatables->select('id,code,name,description,modified,created')
            ->unset_column('id')
            ->add_column('actions', get_view_products_buttons('$1'), 'id')
            ->from('products');
        echo $this->datatables->generate();
    }

    function add(){
        // SET VALIDATION RULES
        $this->form_validation->set_rules('code', 'Product Code', 'required|max_length[50]|is_unique[products.code]');
        $this->form_validation->set_rules('name', 'Product Name', 'required|max_length[50]');
        $this->form_validation->set_rules('description', 'Product Description', 'required|max_length[100]|is_unique[products.description]');
        $this->form_validation->set_message('is_unique', 'The %s already exists');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $code ="";
        $name = "";
        $description ="";

        // has the form been submitted
        if($this->input->post()){
            $code = trim($this->input->post('code'));
            $name = trim($this->input->post('name'));
            $description = trim($this->input->post('description'));

            //Does it have valid form info (not empty values)
            if($this->form_validation->run()){


                //Save new product
                $saved = $this->products_m->add_product($code,$name,strtoupper($description));

                if($saved){
                    // Display success message
                    $this->session->set_flashdata('appmsg', 'New Product added successfully!');
                    $this->session->set_flashdata('alert_type', 'alert-success');
                    redirect('products/add');

                }else{
                    // Display fail message
                    $this->session->set_flashdata('appmsg', 'New Product NOT added! Check logs');
                    $this->session->set_flashdata('alert_type', 'alert-danger');
                    redirect('products/add');
                }
            }
        }

        $data['code']=$code;
        $data['name']=$name;
        $data['description']=$description;
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Add Product";
        $data['mainContent']='products/add_product';

        $this->load->view('templates/template', $data);
        

    }

    function edit($id=null){
        if(!empty($id)){
            //retrieve the msisdn for the recipient
            $to_edit = $this->products_m->get_product($id);

            //display reply view
            $data['id']=$id;
            $data['code']=$to_edit->code;
            $data['name']=$to_edit->name;
            $data['description']=$to_edit->description;
        }else{
            //return fail. distributor code already in use
            $this->session->set_flashdata('appmsg', 'Error encountered! No identifier specified');
            $this->session->set_flashdata('alert_type', 'alert-warning');
            redirect('products');
        }

        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Edit Product";
       $data['mainContent']='products/edit_product';
        $this->load->view('templates/template', $data);
       
    }

    function delete($id=null){
        if(!empty($id)){
            //retrieve the msisdn for the recipient
            $to_delete = $this->products_m->get_product($id);

            //check if resource exist
            if ($to_delete === false) {
                $this->session->set_flashdata('appmsg', 'Error encountered! The Resource Was Not Found');
                $this->session->set_flashdata('alert_type', 'alert-warning');
                redirect('products');
            }

            //delete the product (status change)
            $deleted = $this->products_m->delete_product($id);
            if($deleted){
                $this->session->set_flashdata('appmsg', 'Product Deleted successfully');
                $this->session->set_flashdata('alert_type', 'alert-success');
                redirect('products');
            }
            
        }else{
            //return fail. distributor code already in use
            $this->session->set_flashdata('appmsg', 'Error encountered! No identifier specified');
            $this->session->set_flashdata('alert_type', 'alert-warning');
            redirect('products');
        }
       
    }

    function deleteAll(){
            //retrieve the msisdn for the recipient
            $truncated = $this->products_m->truncate_product();

            //check if resource exist
            if ($truncated === false) {
                $this->session->set_flashdata('appmsg', 'Error encountered! Products Could Not Be Deleted');
                $this->session->set_flashdata('alert_type', 'alert-warning');
                redirect('products');
            }
            $this->session->set_flashdata('appmsg', 'Products Deleted successfully');
            $this->session->set_flashdata('alert_type', 'alert-success');
            redirect('products');
       
    }

    function modify(){
        // SET VALIDATION RULES


        $this->form_validation->set_rules('code', 'Product Code', 'required|max_length[50]');
        $this->form_validation->set_rules('name', 'Product Name', 'required|max_length[50]');
        $this->form_validation->set_rules('description', 'Description', 'required|max_length[100]');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // has the form been submitted
        if($this->input->post()){
            $id = trim($this->input->post('id'));
            $code = trim($this->input->post('code'));
            $name = trim($this->input->post('name'));
            $description = trim($this->input->post('description'));
            //Does it have valid form info (not empty values)
            if($this->form_validation->run()){

                //verify Product Code if it exists other than modified record
                $code_exists = $this->products_m->verify_code($id,$code);

                if($code_exists){
                    //return fail. product code already in use
                    $this->session->set_flashdata('appmsg', 'This Product Code "'.$code.'" is already in assigned by a different product');
                    $this->session->set_flashdata('alert_type', 'alert-danger');
                    redirect('products/edit/'.$id);
                }else{
                    //Product Code is unique to edited field

                    //verify if Product Name exists other than edited record
                    /*$name_exists = $this->products_m->verify_name($id,$name);

                    if($name_exists){
                        //return fail. product name already in use
                        $this->session->set_flashdata('appmsg', 'This Product Name "'.$name.'" is already in assigned by a different product');
                        $this->session->set_flashdata('alert_type', 'alert-danger');
                        redirect('products/edit/'.$id);
                    }else{*/
                        //verify name if it exists other than modified record
                        $description_exists = $this->products_m->verify_product_description($id,strtoupper($description));

                        if($description_exists){
                            //return fail. product name already in use
                            $this->session->set_flashdata('appmsg', 'This Product description "'.strtoupper($description).'" is already exists for a different product');
                            $this->session->set_flashdata('alert_type', 'alert-danger');
                            redirect('products/edit/'.$id);
                        }else{
                            //Save new product
                            $saved = $this->products_m->update_product($id,$code,$name,strtoupper($description));

                            if($saved){
                                // Display success message
                                $this->session->set_flashdata('appmsg', 'Product modified successfully!');
                                $this->session->set_flashdata('alert_type', 'alert-success');
                                redirect('products');

                            }else{
                                // Display fail message
                                $this->session->set_flashdata('appmsg', 'Product NOT modified! Check logs');
                                $this->session->set_flashdata('alert_type', 'alert-danger');
                                redirect('products');
                            }

                        }
                    //}

                }

            }
            $errors = validation_errors();
            $this->session->set_flashdata('appmsg', $errors);
            $this->session->set_flashdata('alert_type', 'alert-danger');
            redirect('products/edit/'.$id);
        }

        redirect('products');
    }

    function import(){

        $data['base']=$this->config->item('base_url');
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Import Products";
        $data['mainContent']='products/import_products';
        $this->load->view('templates/template', $data);
       
    }

    function do_upload(){
        $config['upload_path'] = './uploads/products/';
        $config['allowed_types'] = 'xls|xlsx';
        //$config['overwrite'] = TRUE;
        $config['max_size']	= '2048';
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
            redirect('products/import');
        }else{
            $data = array('upload_data' => $this->upload->data());

            foreach($data['upload_data'] as $item => $value){
                log_message('debug','item: '.$item. ' value: '.$value);
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
            $this->session->set_flashdata('appmsg', 'Products imported: '.$importedNo);
            $this->session->set_flashdata('alert_type', 'alert-success');
            redirect('products/import');
        }
    }

    function import_excel($fileName){
        $this->load->library('Excel');
        //  Include PHPExcel_IOFactory


        $inputFileName = './uploads/products/'.$fileName;

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
        $existingNames = '';
        $existingDescriptions = '';
        $existingCodes = '';


        //  Loop through each row of the worksheet in turn
        for ($row = 2; $row <= $highestRow; $row++) {
            //  Read a row of data into an array
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

            $productData = $rowData[0];
            $productCode = trim($productData[0]);
            $productName = trim($productData[1]);
            $productDescription = trim($productData[2]);
            

            //Check if all fields are not null
            if($productCode!=null AND $productDescription != null AND $productName != null){

                //Check if Product Name already exists
                $itemCodeExists = $this->products_m->check_code($productCode);
                if($itemCodeExists){
                    $existingCodes =$existingCodes.' | '.$productCode;
                    //log the region as not added
                    log_message('debug',$productCode.' EXISTS! ');
                }else{
                    //Check if Product Description already exists
                    $descriptionExists = $this->products_m->check_description($productDescription);
                    if($descriptionExists){
                        $existingDescriptions =$existingDescriptions.' | '.$productDescription;
                        //log the region as not added
                        log_message('debug',$productDescription.' EXISTS! ');
                    }else{
                        //Check if Product Name already exists
                        /*$skuExists = $this->products_m->check_name($productName);
                        if($skuExists){
                            $existingNames =$existingSkus.' | '.$productName;
                            //log the region as not added
                            log_message('debug',$productName.' EXISTS! ');
                        }else{*/

                            $product_added = $this->products_m->add_product($productCode,ucfirst($productName),strtoupper($productDescription));

                            if($product_added){
                                $addCounter++;
                                //log the region added
                                log_message('debug',$productCode.' '.$productDescription.' '.$productName.' ADDED SUCCESSFULLY! ');

                            }else{
                                $notAdded = $notAdded. ' | '.$productDescription;
                                //log the region as not added
                                log_message('debug','PRODUCT NOT ADDED! '.$productCode.' '.$productDescription.' '.$productName);
                            }
                       /* }*/

                    }

                }
            }

        }

        $existingVariables ="";
        if(!empty($existingCodes)){
            $existingVariables = 'Product Codes: ('.$existingCodes.') ';
        }

        if(!empty($existingDescriptions)){
            $existingVariables =$existingVariables .'Descriptions: ('.$existingDescriptions.') ';
        }

        /*if(!empty($existingNames)){
            $existingVariables =$existingVariables .'Product Names: ('.$existingNames.') ';
        }*/


        $import_result = array('count'=>$addCounter,'existing'=>$existingVariables,'notadded'=>$notAdded);

        return $import_result;
    }

    public function download(){
        //load download helper
        $this->load->helper('download');
        
        //file path
        $filePath = 'uploads/templates/';
        $fileName = 'products_import.xlsx';
        $data = file_get_contents($filePath.$fileName);
        force_download($fileName, $data);
        redirect('products/import');
    }


}