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

class SmsResponseReceiver{
    private $messageId; //Define parameters for receive sms data
    private $status;
    private $phonenumber;
    private $networkcode;
    private $failurereason;
    private $retrycount;

    /*
        decode the json data an get them to an array
        Get data from Json objects
        check the validity of the response
    **/
    public function __construct(){
        $array = json_decode(file_get_contents('php://input'),TRUE);
        print_r($array);
        $this->messageId = $array['id'];
        $this->status = $array['status'];
        $this->phonenumber = $array['phoneNumber'];
        $this->networkcode = $array['networkCode'];
        $this->failurereason = $array['failureReason'];
        $this->retrycount = $array['retryCount'];
        if ($this->messageId==null && $this->phonenumber==null) {
            throw new Exception("Some of the required parameters are not provided");
        } else {
            // Success received response
            $responses = array("statusCode" => "S1000", "statusDetail" => "Success");
            header("Content-type: application/json");
          //  echo json_encode($responses);

        }
    }

    /*
        Define getters to return receive data
    **/

    public function getMessageId(){
        return $this->messageId;
    }

    public function getStatus(){
        return $this->status;
    }

    public function getPhoneNumber(){
        return $this->phonenumber;
    }

    public function getNetworkCode(){
        return $this->networkcode;
    }

    public function getFailureReason(){
        return $this->failurereason;
    }

    public function getRetryCount(){
        return $this->retrycount;
    }

}

?>