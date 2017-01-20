<?php
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 11/26/2014
 * Time: 10:11 AM
 */

class Mail_report extends Admin_Controller
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
        $this->load->database();

        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    function index(){
        /*  todo 1. Retrieve all towns
            todo 2. loop through towns store region_id and town_id
            todo 3. retrieve purchase reports for that town
            todo 4. create excel and save it
            todo 5. send Email
        */

        $townsList = $this->towns_m->get_all_towns();

        if($townsList){
            //Towns available
          //  echo "towns available";

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
                                $emailTo = $tasdetails->email;
                            }else{
                                $emailTo = $emailTo.', '.$tasdetails->email;
                            }
                        }
                    }else{
                        log_message('info','TAS List empty');
                    }

                    if($emailTo){
                        //Create Excel for emailing
                        $file_created = $this->createExcel($query,$town_name,$region_name);

                        if($file_created){
                            echo 'success';
                            //Send email with file attached

                            $this->email->from('lsbethuel@gmail.com', 'Twiga Chemicals SMS Portal');
                            $this->email->to($emailTo);

                            $this->email->attach('./exports/supervisors/Stockist_purchase_report.xls');
                            $this->email->subject($town_name.' Stockist Purchases Report');
                            $this->email->message('Kindly find attached weekly report for purchases made by stockists in your town.');

                            $this->email->send();
                        }else{
                            echo 'file not created';
                        }
                    }else{
                        log_message('info','Email List empty');
                    }

                    /*//Get list of managers for the region
                    $managerList = $this->managers_m->get_managers_by_region($region_id);
                    if($managerList){
                        //Managers present in region
                        foreach($managerList as $managerDetails){
                            if($emailCC!==""){
                                $emailCC = $tasdetails->email;
                            }else{
                                $emailCC = $emailCC.', '.$tasdetails->email;
                            }
                        }
                    }*/


                }

            }
        }else{
            //Towns dont exist
        //    echo "towns not available";
        }



        /*$detailedReport = $this->reports_m->get_today_purchase_report();
        //'purchase_products.sku_code as sku_code,item_code,products.description as description,quantity,item_um,purchase_reports.msisdn as msisdn,business_name,distributor_code,distributors.name AS distributor_name,regions.name AS region,towns.name AS town,purchase_reports.created AS created'
        if($detailedReport){
            foreach ($detailedReport as $record){

                log_message('Info','Invoice Number: '.$record->invoice_no . ' SKU: '.$record->sku_code . ' itemcode: '.$record->item_code . ' Description: '.$record->description .' Quantity: '.$record->quantity.' Item UM: '.$record->item_um.' msisdn: '.$record->msisdn.' Biz name: '.$record->business_name.' Distributor: '.$record->distributor_code.' Distributor Name: '.$record->distributor_name.' Region: '.$record->region.' Town: '.$record->town.' Created: '.$record->created);
            }
            echo "Data logged";
        }else{
            echo "empty recordset";
        }*/
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
            log_message('info','Excel Field: '.$field);
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
                log_message('info','Excel cell data: '.$data->$field);
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
            $filename = 'Stockist_purchase_report.xls';
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('./exports/supervisors/'.$filename);
            log_message('info','Excel File exported successfully');

            return true;
        }catch (Exception $e){
            log_message('warning','Failed to export excel file! '.$e);
            return false;
        }




    }
}