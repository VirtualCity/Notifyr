<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 5/15/2015
 * Time: 11:17 AM
 */

class Cumulative extends CI_Controller{


    function __construct(){
        parent::__construct();
        $this->load->library('sms/SmsSender.php');
        $this->load->model('sms_model');
        $this->load->model('sendsms_model');
    }

    function index(){
        $array = json_decode(file_get_contents('php://input'), true);
        $mobile= $array['Mobile'];
        $farmer_code= $array['Code'];
        $month = $array['Month'];



        log_message('info','Mobile: '.$mobile.' Farmer Code: '.$farmer_code.' Month: '.$month);
        // Success received response
        $commodity1 = array("Commodity"=>"Maize","Weight"=>"20");
        $commodity2 = array("Commodity"=>"Beans","Weight"=>"40");
        $deliveries = array($commodity1,$commodity2);
        $responses = array("Name"=>"Brian Mwasi","Code"=>$farmer_code,"StatusCode" => "1", "StatusDetail" => "Success","Deliveries" => $deliveries,"Date"=>"2016/06/31");
        header("Content-type: application/json");
        $encoded = json_encode($responses);
        echo $encoded;

    }

    public function ReceiveCumulativeData()
    {
        $cumulativeReport = json_decode(file_get_contents('php://input'), true);
        foreach ($cumulativeReport as $report) {
            $statusCode= $report['StatusCode'];
            $statusDetail = $report['StatusDetail'];
            $farmerCode = $report['Code'];
            $msisdn = $this->ChangePhoneNumberFormat($report['MobileNumber']);
            $farmerName = $report['Name'];
            $asAtDate = $report['Date'];
            $summaryDetail = $report['Deliveries'];
            $message=$farmerName.', Supplier Code: '.$farmerCode.', ';
            if(sizeof($summaryDetail) > 0){
                log_message('info','Summary detail is not null');
                foreach ($summaryDetail as $commodity){
                    $message = $message. ' '.$commodity['Commodity'].':'.$commodity['Weight'].'Kg ';
                }
            }else{
                log_message('info','Summary detail is null');
                $message = $message.' Cumulative Weight: 0 Kg ';
            }
            $message = $message.'as at '.$asAtDate;
            $recipients= array('tel:'.$msisdn);
            $msg_sent= $this->sendsms_model->send_sms($recipients,$message);
            if($msg_sent=='success'){
                $this->sms_model->save_sms($msisdn,"Cumulative Report",$message,0);

            }else{
                echo 'Message to '.$msisdn.' failed.';
                log_message('appmsg', 'Message to '.$msisdn.' failed.');
            }
            echo $msisdn;
        }
    }

    public function ChangePhoneNumberFormat($phoneNumber){
        $phoneNumber = preg_replace('/[^0-9]/','',$phoneNumber);

        if(strlen($phoneNumber) == 12) {
            $countryCode = substr($phoneNumber, 0, strlen($phoneNumber)-9);
            $areaCode = substr($phoneNumber, -8, 4);
            $nextThree = substr($phoneNumber, -9, 3);
            $lastSix = substr($phoneNumber, -6, 6);
            $phoneNumber = $countryCode.$nextThree.$lastSix;
        }
        else if(strlen($phoneNumber) == 10) {
            $nextThree = substr($phoneNumber, 1, 3);
            $lastFour = substr($phoneNumber, 4, 6);
            $phoneNumber = '254'.$nextThree.$lastFour;
        }
        else if(strlen($phoneNumber) == 9) {
            $nextThree = substr($phoneNumber, 0, 3);
            $lastFour = substr($phoneNumber, 3, 6);
            $phoneNumber = '254'.$nextThree.''.$lastFour;
        }
        return $phoneNumber;
    }



}