<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 8/5/14
 * Time: 9:18 AM
 *
 */

class ReceiveStatusResponse extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('text');
        $this->load->model('groups_model');
        $this->load->model('sms_model');
        $this->load->model('sendsms_model');
        $this->load->model('contacts_model');
        $this->load->model('settings_m');
        $this->load->model('products_m');
        $this->load->model('blacklist_model');
        ini_set('error_log', 'sms-app-error.log');

        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    //Hsenid API
    function index(){
        $this->load->library('sms/SmsResponseReceiver.php');
        $this->load->library('sms/log.php');

        try {
            $receiver = new SmsResponseReceiver(); // Create the Receiver object

            $messageId = $receiver->getMessageId(); // get the messageId
            $status = $receiver->getStatus(); // get the sms status
            $phoneNumber = $receiver->getPhoneNumber(); // get the phone number of the recipient
            $networkCode = $receiver->getNetworkCode(); // get network code
            $failureReason = $receiver->getFailureReason(); // get the failure reason
            $retryCount = $receiver->getRetryCount(); // get the retry counts


            logFile("[ messageId=$messageId, phonenumber=$phoneNumber, status=$status, networkcode=$networkCode, failurereason=$failureReason, retrycount=$retryCount ]");
            // //log_message("info","[ content=$content, address=$address, requestId=$requestId, applicationId=$applicationId, encoding=$encoding, version=$version ]");

            $check = $resp = $this->sms_model->findByMessageId($messageId);

            if ($check === true) {
                $resp = $this->sms_model->update_sms_status($messageId,$status);
                echo json_encode($resp);
                return $resp;
            }else{
                echo json_encode($check);
                return $check;
            }

        } catch (SmsException $ex) {
            error_log("ERROR: {$ex->getStatusCode()} | {$ex->getStatusMessage()}");
        }
    }

}