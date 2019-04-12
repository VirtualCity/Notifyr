<?php
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 11/26/2014
 * Time: 10:11 AM
 */

class Managers extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('buttons_helper');
        $this->load->model('regions_m');
        $this->load->model('managers_m');
        $this->load->model('tas_m');
        $this->load->model('reports_m');
		$this->load->model('settings_m');
        $this->load->database();


    }

    function index(){
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Email Report";
        $data['mainContent'] = 'reports/email_managers';
        $this->load->view('templates/template', $data);
    }

    function mail(){
		$config['protocol'] = 'mail';
		$config['smtp_host'] = 'VCITY-APP-SVR';
		$config['smtp_user'] = '';
		$config['smtp_pass'] = '';
		$config['smtp_port'] = '25';
		//$config['mailtype'] = 'html';
		
		$this->load->library('email',$config);
	
        $mailSettings = $this->settings_m->get_email();
        $mailFrom ="admin@virtualcity.co.ke";
        if($mailSettings){
            $mailFrom=$mailSettings->value1;
        }

        $regionslist = $this->regions_m->get_all_regions();

        if($regionslist){
            //Regions available

            foreach($regionslist as $region){
                $region_id = $region ->id;
                $region_name = $region->name;

                //Get purchase report for that region
                $query = $this->reports_m->get_purchase_report_by_region($region_name);

                $emailTo ="";

                if($query){
                    //get list of Managers for the region
                    log_message('info','Region ID: '.$region_id);
                    $managersList = $this->managers_m->get_managers_by_region($region_id);
                    if($managersList){
                        //Managers present in region
                        foreach($managersList as $managerdetails){
                            log_message('info','Email: '. $managerdetails->email);
                            if($emailTo!==""){
								$emailTo = $emailTo.', '.$managerdetails->email;
                            }else{
                                $emailTo = $managerdetails->email;
                                
                            }
                        }
                    }else{
                        log_message('info','Regions Manager List empty');
                    }

                    if($emailTo){
                        //Create Excel for emailing
                        $file_created = $this->createExcel($query,$region_name);

                        if($file_created){
                            log_message('info','Exporting of data for this region: '.$region_name.' is successful, Process of emailing Area Sales Managers started');
                            //Send email with file attached

                            $this->email->from($mailFrom, 'SMS Portal');
                            $this->email->to($emailTo);

                            $this->email->attach('./exports/managers/'.$region_name.'/purchase_report.xls');
                            $this->email->subject($region_name.' Purchases Report');
                            $this->email->message('Kindly find attached weekly report for purchases made in your region.');

                            $emailSent = $this->email->send();
                            if ( $emailSent){
                                log_message('info','Purchase report email for '.$region_name.' sent successfully!');
                            }else{
                                log_message('info','Purchase report email for '.$region_name.' failed to send!');
                            }

                        }else{
                            log_message('info','Exporting of data for this region: '.$region_name.' is unsuccessful. Email wont be sent');
                        }
                    }else{
                        log_message('info','No Emails found for TAs in this region: '.$region_name);
                    }
                }
            }
            log_message('info','Exporting & Email process complete,');
            $this->session->set_flashdata('appmsg', 'Exporting & emailing process complete. View logs for details');
            $this->session->set_flashdata('alert_type', 'alert-info');
            $this->session->set_flashdata('alert_type_', 'info');
        }else{
            //Regions dont exist
            log_message('info','Regions dont exist. Data wont be exported and Email wont be sent');
            $this->session->set_flashdata('appmsg', 'There are currently no regions existing. Data cant be exported.');
            $this->session->set_flashdata('alert_type', 'alert-danger');
            $this->session->set_flashdata('alert_type_', 'danger');
        }

        redirect('reports/managers');
    }

    function createExcel($query,$region_name){
        log_message('info','Creating Excel');
        // Starting the PHPExcel library
        $this->load->library('Excel');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");

        $objPHPExcel->setActiveSheetIndex(0);

        //merge cells
        $objPHPExcel->getActiveSheet()->mergeCells('A1:K1');
        $objPHPExcel->getActiveSheet()->mergeCells('A2:K2');
        $objPHPExcel->getActiveSheet()->mergeCells('A3:K3');

        //manage row height
        $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(25);

        //style alignment
        $styleArray = array(
            'alignment' => array(	'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ),
        );

        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A1:K1')->applyFromArray($styleArray);
        //border
        $styleArray1 = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $styleArray12 = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => array(
                    'rgb' => 'FFEC8B',
                ),
            )
        );

        $styleArrayHeaders = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => array(
                    'rgb' => 'BF8F00',
                ),
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        //coloum width
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);


        $objPHPExcel->getActiveSheet()->getStyle('A1:K3')->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('A1:K3')->applyFromArray($styleArray1);
        $objPHPExcel->getActiveSheet()->getStyle('A1:K3')->applyFromArray($styleArray12);
        $objPHPExcel->getActiveSheet()->getStyle('A4:K4')->applyFromArray($styleArrayHeaders);


        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Purchase-report-'.date('d-M-y'));
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Region - '.$region_name);

        // Field names in the first row
        $fields = $query->list_fields();
        $col = 0;
        foreach ($fields as $field)
        {
           // log_message('info','Excel Field: '.$field);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 4, $field);
            $col++;
        }

        // Fetching the table data
        $row = 5;
        foreach($query->result() as $data)
        {
            $col = 0;
            foreach ($fields as $field)
            {
              //  log_message('info','Excel cell data: '.$data->$field);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                $col++;
            }
            $objPHPExcel->getActiveSheet()->getStyle('A'.$row.':K'.$row)->applyFromArray($styleArray1);
            $row++;
        }

        $objPHPExcel->setActiveSheetIndex(0);

        //


        /* Use this to save using browser
         * $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
         * header('Content-type: application/ms-excel');
         * header('Content-Disposition: attachment; filename="Stockist_purchase_report-'.date('d-M-y').'.xls"');
         * header("Cache-control: max-age=0");
         * $objWriter->save("php://output");
         * */
        try{
			$path = "./exports/managers/".$region_name;
			
			if(!is_dir($path)){
				//create the folder if it does not exist
				mkdir($path,0755,TRUE);
			}
		
            $filename = 'purchase_report.xls';
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('./exports/managers/'.$region_name.'/'.$filename);
            log_message('info',$region_name.' excel File exported successfully');

            return true;
        }catch (Exception $e){
            log_message('warning','Failed to export excel file! '.$e);
            return false;
        }




    }
}