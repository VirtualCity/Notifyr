<?php
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 8/6/14
 * Time: 11:25 AM
 */

class Sendsms_model extends CI_Model
{

    function send_sms($destination, $msg)
    {

        /* $this->load->library('sms/SmsSender.php');
         $this->load->library('sms/log.php');*/

          // $userid = $this->session->userdata('id');
        $role = $this->session->userdata('role');
        $userfactory = $this->session->userdata('factory');

        //SDP Configuration

        $applicationId = "";
        $password = "";
        $sourceAddress = "";
        $configurationData ="";

        if ($role === 'SUPER_USER') {
            $configurationData = $this->get_configuration();
        } else {
            $configurationData = $this->get_configuration_by_factory($userfactory);
        }
        
        
        if ($configurationData) {
            $applicationId = $configurationData->value1;
            $senderId = $configurationData->value3;
            $password = $configurationData->value2;
            $sourceAddress = $configurationData->value9;
        }


        log_message('info', 'Message to send: ' . $msg);

        try {
            $responseMsg = $msg;

            // Create the sender object server url
            $sender = new SmsSender();

            //sending a one message


            $encoding = "0";
            $version = "1.0";
            $deliveryStatusRequest = "0";
            $charging_amount = "0";
            $destinationAddresses = $destination;
            $binary_header = "";
            //  log_message("info","Sending Parameters ".$responseMsg ." ". $destinationAddresses[0]." ". $password." ".$applicationId." ".$sourceAddress." ".$deliveryStatusRequest." ".$charging_amount." ".$encoding." ".$version." ".$binary_header);
            $res = $sender->sms($responseMsg, $destinationAddresses, $password, $applicationId, $sourceAddress, $deliveryStatusRequest, $charging_amount, $encoding, $version, $binary_header,$senderId);

            $response = json_decode($res);
            $server_response = $response->SMSMessageData->Recipients;

            //  print_r($server_response[0]);

            log_message("info", "SDP response: " . $server_response[0]->statusCode);
            //AFRICASTALKING for success ->statusCode =101, status=success
            // if ($server_response[0]->status == 'Success')
            if (count($server_response) > 0)
                // return 'success';
                return $server_response;
            else return null;

            //log_message("info", "SDP response " . var_export($res, true));

        } catch (SmsException $ex) {
            //throws when failed sending or receiving the sms
            log_message("info", "Status code error: " . $ex->getStatusCode());
            log_message("info", "Status message error: " . $ex->getStatusMessage());
            error_log("ERROR: {$ex->getStatusCode()} | {$ex->getStatusMessage()}");
            return "fail";
        }

    }

    function get_configuration()
    {
        $this->db->select('*');
        $this->db->from('settings');
        $this->db->where('title', 'CONFIGURATION');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
    function get_configuration_by_factory($factory)
    {
        $this->db->select('*');
        $this->db->from('settings');
        $this->db->where('title', 'CONFIGURATION');
        $this->db->where('factory_id', $factory);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
}