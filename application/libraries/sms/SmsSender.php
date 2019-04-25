<?php
/**
 *   (C) Copyright 1997-2013 hSenid International (pvt) Limited.
 *   All Rights Reserved.
 *
 *   These materials are unpublished, proprietary, confidential source code of
 *   hSenid International (pvt) Limited and constitute a TRADE SECRET of hSenid
 *   International (pvt) Limited.
 *
 *   hSenid International (pvt) Limited retains all title to and intellectual
 *   property rights in these materials.
 */

class SmsSender{
    var $server;
    

    public function __construct($factory=null){
        $settings = "";
       
        if ($factory!==null) {
            $settings = $this->get_factory_settings($factory);
        } else {
            // $settings = $this->getSettings();
        }
        

        // $settings = $this->getSettings();
        if(!empty($settings[0]->value5)){
            $this->server = $settings[0]->value5;
        }else{
            // $this->server = "http://api.hewani.co.ke:7000/sms/send";

            //use this for local testing
            //$this->server = "http://localhost:7000/sms/send";
        }
        
    }

    /*
        Get parameters form the application
        check one or more addresses
        Send them to smsMany
    **/

    public function sms($message, $addresses, $password, $applicationId, $sourceAddress, $deliveryStatusRequest, $charging_amount, $encoding, $version, $binary_header,$senderId){
        log_message("info","Sms Sender sms function" );
        if (is_array($addresses)) {
            return $this->smsMany($message, $addresses, $password, $applicationId, $sourceAddress, $deliveryStatusRequest, $charging_amount, $encoding, $version, $binary_header,$senderId);
        } else if (is_string($addresses) && trim($addresses) != "") {
            return $this->smsMany($message, array($addresses), $password, $applicationId, $sourceAddress, $deliveryStatusRequest, $charging_amount, $encoding, $version, $binary_header,$senderId);
        } else {
            throw new Exception("address should be a string or a array of strings");
        }
    }

    /*
        Get parameters form the sms
        Assign them to an array according to json format
        encode that array to json format
        Send json to sendRequest
    **/

    private function smsMany($message, $addresses, $password, $applicationId, $sourceAddress, $deliveryStatusRequest, $charging_amount, $encoding, $version, $binary_header,$senderId){

        $arrayField = array(
            "applicationId" => $applicationId,
            "password" => $password,
            "senderId" =>$senderId,
            "message" => $message,
            "deliveryStatusRequest" => $deliveryStatusRequest,
            "recipients" => $addresses,
            "sourceAddress" => $sourceAddress,
            "chargingAmount" => $charging_amount,
            "encoding" => $encoding,
            "version" => $version,
            "binaryHeader" => $binary_header,
            "apiKey"=>$password
        );

        $jsonObjectFields = json_encode($arrayField);

        log_message("info",$jsonObjectFields );
        return $this->sendRequest($jsonObjectFields);
    }

    /*
        Get the json request from smsMany
        use curl methods to send sms
        Send the response to handleResponse
    **/

    private function sendRequest($jsonObjectFields){
        $ch = curl_init($this->server);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonObjectFields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);
        return $this->handleResponse($res);
    }

    /*
        Get the response from sendRequest
        check response is empty
        return response
    **/

    private function handleResponse($resp){
        if ($resp == "") {
            throw new SmsException
            ("Server URL is invalid", '500');
        } else {
            return $resp;
        }
    }

    private function getSettings(){
        $CI =& get_instance();
        $CI->db->select('*');
        $CI->db->from('settings');
        $CI->db->where('title','CONFIGURATION');
        $query  =   $CI->db->get();
        return $query->result();

        if($query -> num_rows() > 0){
            return $query -> row();
        }else{
            return false;
        }
    }

    private function get_factory_settings($factory){
        $CI =& get_instance();
        $CI->db->select('*');
        $CI->db->from('settings');
        $CI->db->where('title','CONFIGURATION');
        $CI->db->where('factory_id',$factory);
        $query  =   $CI->db->get();
        return $query->result();

        if($query -> num_rows() > 0){
            return $query -> row();
        }else{
            return false;
        }
    }
    
}

class SmsException extends Exception{ // Sms Exception Handler

    var $code;
    var $response;
    var $statusMessage;

    public function __construct($message, $code, $response = null){
        parent::__construct($message);
        $this->statusMessage = $message;
        $this->code = $code;
        $this->response = $response;
    }

    public function getStatusCode(){
        return $this->code;
    }

    public function getStatusMessage(){
        return $this->statusMessage;
    }

    public function getRawResponse(){
        return $this->response;
    }

}

?>