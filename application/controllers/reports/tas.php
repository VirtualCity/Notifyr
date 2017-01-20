<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 11/26/2014
 * Time: 10:11 AM
 */

class Tas extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('buttons_helper');
        $this->load->model('locations_m');
        $this->load->model('towns_m');
        $this->load->model('regions_m');
        $this->load->model('tas_m');
        $this->load->model('reports_m');
        $this->load->model('settings_m');
        $this->load->database();

        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    function index(){
        $data['user_role'] = $this->session->userdata('role');
        $data['title'] = "Email Report";
        $this->load->view('templates/header', $data);
        $this->load->view('reports/email_tas',$data);
    }

    function mail(){
		$config['protocol'] = 'mail';
		$config['smtp_host'] = 'HEWANI-COUNTY-S';
		$config['smtp_user'] = '';
		$config['smtp_pass'] = '';
		$config['smtp_port'] = '25';
		//$config['mailtype'] = 'html';
		
		$this->load->library('email',$config);
	
        $mailSettings = $this->settings_m->get_email();
        $mailFrom ="admin@twiga-chemicals.com";
        if($mailSettings){
            $mailFrom=$mailSettings->value1;
        }

        $townsList = $this->towns_m->get_all_towns();

        if($townsList){
            //Towns available
            //  echo "towns available";

            $townsMailed="";
            foreach($townsList as $town){
                $town_id = $town ->id;
                $town_name = $town->name;
                $region = $this->regions_m->get_region($town->region_id);
                $region_name = $region ->name;

                //Get purchase report for that town
                $query = $this->reports_m->get_purchase_report_by_town($town_id);

                $emailTo ="";
                /*$emailCC ="";*/

                if($query){
                    //get list of TAS for the town
                    log_message('info','Town ID: '.$town_id);
                    $tasList = $this->tas_m->get_tas_by_townID($town_id);
                    if($tasList){
                        //TAS present in town
                        foreach($tasList as $tasdetails){
                            log_message('info','Email: '. $tasdetails->email);
                            if($emailTo!==""){
								$emailTo = $emailTo.', '.$tasdetails->email;
                            }else{
                                $emailTo = $tasdetails->email;

                            }
                        }
                    }else{
                        log_message('info','TAS List empty');
                    }

					log_message('info','Email List: '.$emailTo);
                    if($emailTo){
                        //Create Excel for emailing
                        $file_created = $this->createExcel($query,$town_name,$region_name);

                        if($file_created){
                           // echo 'success';
                            //Send email with file attached

                            $this->email->from($mailFrom, 'Twiga Chemicals SMS Portal');
                            $this->email->to($emailTo);

                            $this->email->attach('./exports/supervisors/'.$town_name.'/Stockist_purchase_report.xls');
                            $this->email->subject($town_name.' Stockist Purchases Report');
                            $this->email->message('Kindly find attached weekly report for purchases made by stockists in your town.');

                            $emailSent = $this->email->send();
                            if ( $emailSent){
                                log_message('info','Purchase report email for '.$town_name.' sent successfully!');
                                $townsMailed = $townsMailed . ' | '.$town_name;
                            }else{
								show_error($this->email->print_debugger());
                                log_message('info','Purchase report email for '.$town_name.' failed to send!');
                            }

                        }else{
                            log_message('info','Exporting of data for this town: '.$town_name.' is unsuccessful. Email wont be sent');
                        }
                    }else{
                        log_message('info','No Emails found for TAs in this town: '.$town_name);
                    }
                }
            }
			
            log_message('info','Exporting process complete, emailing TAS');
            $this->session->set_flashdata('appmsg', 'Exporting & emailing process complete');
            $this->session->set_flashdata('mailed', '('.$townsMailed.')');
            $this->session->set_flashdata('alert_type', 'alert-info');
        }else{
            //Towns dont exist
            log_message('info','Towns dont exist. Data wont be exported and Email wont be sent');
            $this->session->set_flashdata('appmsg', 'There are currently no towns existing. Data cant be exported.');
            $this->session->set_flashdata('alert_type', 'alert-danger');
            $this->session->set_flashdata('mailed', '');
        }

        redirect('reports/supervisors');
    }

    function createExcel($query,$town_name,$region_name){
        log_message('info','Creating Excel');
        // Starting the PHPExcel library
        $this->load->library('Excel');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");

        $objPHPExcel->setActiveSheetIndex(0);

        //merge cells
        $objPHPExcel->getActiveSheet()->mergeCells('A1:M1');
        $objPHPExcel->getActiveSheet()->mergeCells('A2:M2');
        $objPHPExcel->getActiveSheet()->mergeCells('A3:M3');

        //manage row height
        $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(25);

        //style alignment
        $styleArray = array(
            'alignment' => array(	'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ),
        );

        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A1:M1')->applyFromArray($styleArray);
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
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);


        $objPHPExcel->getActiveSheet()->getStyle('A1:M3')->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('A1:M3')->applyFromArray($styleArray1);
        $objPHPExcel->getActiveSheet()->getStyle('A1:M3')->applyFromArray($styleArray12);
        $objPHPExcel->getActiveSheet()->getStyle('A4:M4')->applyFromArray($styleArrayHeaders);


        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Stockist_purchase_report-'.date('d-M-y'));
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Region - '.$region_name);
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Town - '.$town_name);

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
            $objPHPExcel->getActiveSheet()->getStyle('A'.$row.':M'.$row)->applyFromArray($styleArray1);
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
			$path = "./exports/supervisors/".$town_name;
			
			if(!is_dir($path)){
				//create the folder if it does not exist
				mkdir($path,0755,TRUE);
			}
		
            $filename = 'Stockist_purchase_report.xls';
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('./exports/supervisors/'.$town_name.'/'.$filename);
            log_message('info','Excel File exported successfully');

            return true;
        }catch (Exception $e){
            log_message('warning','Failed to export excel file! '.$e);
            return false;
        }




    }
}