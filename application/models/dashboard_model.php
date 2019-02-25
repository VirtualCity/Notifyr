<?php
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 7/31/14
 * Time: 2:14 PM
 */
// require 'vendor/autoload.php';
// use AfricasTalking\SDK\AfricasTalking;

class Dashboard_model extends CI_Model{

    var $server;

    public function __construct(){
       
        $settings = $this->getSettings();
        if(!empty($settings[0]->balanceurl)){
            $this->server = $settings[0]->balanceurl;
            // $this->server = "http://localhost:4200/api/africastalking/balance";
        }else{
            
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

    function getBalance($password, $sourceAddress){

        $arrayField = array(
            "user" => $sourceAddress,
            "apiKey"=>$password
        );
        $jsonObjectFields = json_encode($arrayField);
        log_message("info",$jsonObjectFields );
        return $this->sendRequest($jsonObjectFields);
    }

    function sendRequest($jsonObjectFields){
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

    function handleResponse($resp){
        if ($resp == "") {
            throw new SmsException
            ("Server URL is invalid", '500');
        } else {
            return $resp;
        }
    }

    function get_todays_total(){
        $this -> db-> select('count(*) AS count');
        $this -> db -> from('sms_received');
        $where = "DATE(created)= CURDATE()";
        $this -> db -> where($where);
        $result = $this -> db -> get();

        if($result->num_rows()>0){
            $row = $result->row();

            $count = $row->count;

            return $count;

        }
    }

    function get_balance_total(){

        $password = "";
        $sourceAddress = "";

        $configurationData = $this->get_configuration();
        if ($configurationData) {
            $password = $configurationData->value2;
            $sourceAddress = $configurationData->value9;
        }

        try {
            $encoding = "0";
            $version = "1.0";
            $deliveryStatusRequest = "0";
            $charging_amount = "0";
            $binary_header = "";
            $res = $this->getBalance($password, $sourceAddress);

            $response = json_decode($res);
            return $response;

        } catch (SmsException $ex) {
            log_message("info", "Status code error: " . $ex->getStatusCode());
            log_message("info", "Status message error: " . $ex->getStatusMessage());
            error_log("ERROR: {$ex->getStatusCode()} | {$ex->getStatusMessage()}");
            return "fail";
        }
    }

    function get_weeks_total(){
        $this -> db-> select('count(*) AS count');
        $this -> db -> from('sms_received');
        $where = "created >=( DATE(NOW()) - INTERVAL 7 DAY + INTERVAL 0 SECOND )";
        $this -> db -> where($where);
        $result = $this -> db -> get();

        if($result->num_rows()>0){
            $row = $result->row();

            $count = $row->count;

            return $count;

        }
    }

    function get_months_total(){
        $this -> db-> select('count(*) AS count');
        $this -> db -> from('sms_received');
        $where = "created >=( DATE(NOW()) - INTERVAL 30 DAY + INTERVAL 0 SECOND )";
        $this -> db -> where($where);
        $result = $this -> db -> get();

        if($result->num_rows()>0){
            $row = $result->row();

            $count = $row->count;

            return $count;

        }
    }

    function get_contacts_total(){
        $this -> db-> select('count(*) AS count');
        $this -> db -> from('contacts');
        $result = $this -> db -> get();

        if($result->num_rows()>0){
            $row = $result->row();

            $count = $row->count;

            return $count;

        }
    }

    function get_blacklist_total(){
        $this -> db-> select('count(*) AS count');
        $this -> db -> from('blacklist');
        $result = $this -> db -> get();

        if($result->num_rows()>0){
            $row = $result->row();

            $count = $row->count;

            return $count;

        }
    }

    function get_contact_groups_total(){
        $this -> db-> select('count(*) AS count');
        $this -> db -> from('groups');
        $result = $this -> db -> get();

        if($result->num_rows()>0){
            $row = $result->row();

            $count = $row->count;

            return $count;

        }
    }

    function get_outbox_total(){
        $this -> db-> select('count(*) AS count');
        $this -> db -> from('smsout');
        $result = $this -> db -> get();

        if($result->num_rows()>0){
            $row = $result->row();

            $count = $row->count;

            return $count;

        }
    }

    function getLastDaysSubscriptions($days){
        $this -> db-> select('*');
        $this -> db -> from('smsin');
        $where = "DATE(created)= CURDATE() - INTERVAL ".$days." DAY + INTERVAL 0 SECOND";
        $this -> db -> WHERE($where);
        $this-> db-> where('type','subscription');
        $this-> db-> where('recipient !=','none');
        $query = $this -> db -> get();
        $row_count = $query-> num_rows();

        return $row_count;


    }

    function getLastDaysUnsubscriptions($days){
        $this -> db-> select('*');
        $this -> db -> from('smsin');
        $where = "DATE(created)= CURDATE() - INTERVAL ".$days." DAY + INTERVAL 0 SECOND";
        $this -> db -> WHERE($where);
        $this-> db-> where('type','unsubscription');
        $this-> db-> where('recipient !=','none');
        $query = $this -> db -> get();
        $row_count = $query-> num_rows();

        return $row_count;


    }

    function getLastDaysGroupQueryRecievedMessages($days){
        $this -> db-> select('*');
        $this -> db -> from('sms_received');
        $where = "DATE(created)= CURDATE() - INTERVAL ".$days." DAY + INTERVAL 0 SECOND";
        $this -> db -> WHERE($where);
        $this-> db-> where('message_type','GROUP');
        $query = $this -> db -> get();
        $row_count = $query-> num_rows();

        return $row_count;

    }
    function getLastDaysGroupQueryRepliedMessages($days){
        $this -> db-> select('*');
        $this -> db -> from('replies');
        $where = "DATE(created)= CURDATE() - INTERVAL ".$days." DAY + INTERVAL 0 SECOND";
        $this -> db -> WHERE($where);
        $query = $this -> db -> get();
        $row_count = $query-> num_rows();

        return $row_count;

    }

    function getLastDaysCummulativeQueries($days){
        $this -> db-> select('*');
        $this -> db -> from('sms_received');
        $where = "DATE(created)= CURDATE() - INTERVAL ".$days." DAY + INTERVAL 0 SECOND";
        $this -> db -> WHERE($where);
        $this-> db-> where('message_type','TOTAL');
        $query = $this -> db -> get();
        $row_count = $query-> num_rows();

        return $row_count;

    }

    function getLastDaysGroupQueryPendingMessages($days){
        $this -> db-> select('*');
        $this -> db -> from('smsin');
        $where = "DATE(created)= CURDATE() - INTERVAL ".$days." DAY + INTERVAL 0 SECOND";
        $this -> db -> WHERE($where);
        $this-> db-> where('type','group');
        $this-> db-> where('status','Pending');
        $query = $this -> db -> get();
        $row_count = $query-> num_rows();

        return $row_count;

    }

    //Last seven days orders
    function getLastSevenDaysOrders($days){
        $this -> db-> select('invoice_no');
        $this -> db -> from('purchase_reports');
        $where = "DATE(created)= CURDATE() - INTERVAL ".$days." DAY + INTERVAL 0 SECOND";
        $this -> db -> WHERE($where);
        $query = $this -> db -> get();
        $row_count = $query-> num_rows();

        return $row_count;

    }

    //Last seven days deliveries
    function getLastSevenDaysDeliveries($days){
        $this -> db-> select('invoice_no');
        $this -> db -> from('purchase_reports');
        $where = "DATE(created)= CURDATE() - INTERVAL ".$days." DAY + INTERVAL 0 SECOND";
        $this -> db -> WHERE($where);
        $this-> db-> where('order_status','DELIVERED');
        $query = $this -> db -> get();
        $row_count = $query-> num_rows();

        return $row_count;

    }




    /*Stockist Data
    ----------------------------------------------------------------------
    */
    function get_stockist_todays_total($code){
        $this -> db-> select('count(*) AS count');
        $this -> db -> from('purchase_reports');
        $this -> db -> where('distributor_code',$code);
        $where = "DATE(created)= CURDATE()";
        $this -> db -> where($where);
        $result = $this -> db -> get();

        if($result->num_rows()>0){
            $row = $result->row();

            $count = $row->count;

            return $count;

        }
    }

    function get_stockist_weeks_total($code){
        $this -> db-> select('count(*) AS count');
        $this -> db -> from('purchase_reports');
        $this -> db -> where('distributor_code',$code);
        $where = "created >=( DATE(NOW()) - INTERVAL 7 DAY + INTERVAL 0 SECOND )";
        $this -> db -> where($where);
        $result = $this -> db -> get();

        if($result->num_rows()>0){
            $row = $result->row();

            $count = $row->count;

            return $count;

        }
    }

    function get_stockist_months_total($code){
        $this -> db-> select('count(*) AS count');
        $this -> db -> from('purchase_reports');
        $this -> db -> where('distributor_code',$code);
        $where = "created >=( DATE(NOW()) - INTERVAL 30 DAY + INTERVAL 0 SECOND )";
        $this -> db -> where($where);
        $result = $this -> db -> get();

        if($result->num_rows()>0){
            $row = $result->row();

            $count = $row->count;

            return $count;

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