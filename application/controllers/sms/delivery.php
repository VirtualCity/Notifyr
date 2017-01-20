<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 8/5/14
 * Time: 9:18 AM
 */

class Delivery extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->library('sms/SmsDeliveryReport.php');
        $this->load->model('sms_model');


        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    //Hsenid API
    function index(){

        try {
            $receiver = new SmsDeliveryReport(); // Create the Receiver object


            $destinationAddress = $receiver->getDesAddress();
            $timeStamp = $receiver->getTimeStamp();
            $requestId = $receiver->getRequestId();
            $deliveryStatus = $receiver->getDeliveryStatus();


            log_message('Info','-----DELIVERY REPORT FROM SDP------');
            log_message('Info','[ destinationAddress='.$destinationAddress.', timeStamp='.$timeStamp.', requestId='.$requestId.', deliveryStatus='.$deliveryStatus.' ]');
            log_message('Info','-------------------------------------------------------------------');
        } catch (SmsException $ex) {
            //throws when failed delivery report receiving
            $ERROR_STRING= "ERROR: {$ex->getStatusCode()} | {$ex->getStatusMessage()}";
            log_message('Info',$ERROR_STRING);
        }
    }


}