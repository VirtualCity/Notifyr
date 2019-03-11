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

    function getSmsBalance($password, $sourceAddress){

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

    function get_sms_pending_total(){
        $this -> db-> select('count(*) AS count');
        $this -> db -> from('sms_received');
        // $where = "DATE(created)= CURDATE()";
        // $this -> db -> where($where);
        $result = $this -> db -> get();

        if($result->num_rows()>0){
            $row = $result->row();

            $count = $row->count;

            return $count;

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

    function get_todays_sent_total(){
        $this -> db-> select('count(*) AS count');
        $this -> db -> from('smsout');
        $where = "DATE(created)= CURDATE()";
        $this -> db -> where($where);
        $result = $this -> db -> get();

        if($result->num_rows()>0){
            $row = $result->row();

            $count = $row->count;

            return $count;

        }
    }

    function get_sms_balance(){

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
            $res = $this->getSmsBalance($password, $sourceAddress);
            return $res;

        } catch (SmsException $ex) {
            log_message("info", "Status code error: " . $ex->getStatusCode());
            log_message("info", "Status message error: " . $ex->getStatusMessage());
            error_log("ERROR: {$ex->getStatusCode()} | {$ex->getStatusMessage()}");
            return "fail";
        }
    }

// function to format the currency properly
    function formatcurrency($floatcurr, $curr = "USD"){
        $currencies['ARS'] = array(2,',','.');          //  Argentine Peso
        $currencies['AMD'] = array(2,'.',',');          //  Armenian Dram
        $currencies['AWG'] = array(2,'.',',');          //  Aruban Guilder
        $currencies['AUD'] = array(2,'.',' ');          //  Australian Dollar
        $currencies['BSD'] = array(2,'.',',');          //  Bahamian Dollar
        $currencies['BHD'] = array(3,'.',',');          //  Bahraini Dinar
        $currencies['BDT'] = array(2,'.',',');          //  Bangladesh, Taka
        $currencies['BZD'] = array(2,'.',',');          //  Belize Dollar
        $currencies['BMD'] = array(2,'.',',');          //  Bermudian Dollar
        $currencies['BOB'] = array(2,'.',',');          //  Bolivia, Boliviano
        $currencies['BAM'] = array(2,'.',',');          //  Bosnia and Herzegovina, Convertible Marks
        $currencies['BWP'] = array(2,'.',',');          //  Botswana, Pula
        $currencies['BRL'] = array(2,',','.');          //  Brazilian Real
        $currencies['BND'] = array(2,'.',',');          //  Brunei Dollar
        $currencies['CAD'] = array(2,'.',',');          //  Canadian Dollar
        $currencies['KYD'] = array(2,'.',',');          //  Cayman Islands Dollar
        $currencies['CLP'] = array(0,'','.');           //  Chilean Peso
        $currencies['CNY'] = array(2,'.',',');          //  China Yuan Renminbi
        $currencies['COP'] = array(2,',','.');          //  Colombian Peso
        $currencies['CRC'] = array(2,',','.');          //  Costa Rican Colon
        $currencies['HRK'] = array(2,',','.');          //  Croatian Kuna
        $currencies['CUC'] = array(2,'.',',');          //  Cuban Convertible Peso
        $currencies['CUP'] = array(2,'.',',');          //  Cuban Peso
        $currencies['CYP'] = array(2,'.',',');          //  Cyprus Pound
        $currencies['CZK'] = array(2,'.',',');          //  Czech Koruna
        $currencies['DKK'] = array(2,',','.');          //  Danish Krone
        $currencies['DOP'] = array(2,'.',',');          //  Dominican Peso
        $currencies['XCD'] = array(2,'.',',');          //  East Caribbean Dollar
        $currencies['EGP'] = array(2,'.',',');          //  Egyptian Pound
        $currencies['SVC'] = array(2,'.',',');          //  El Salvador Colon
        $currencies['ATS'] = array(2,',','.');          //  Euro
        $currencies['BEF'] = array(2,',','.');          //  Euro
        $currencies['DEM'] = array(2,',','.');          //  Euro
        $currencies['EEK'] = array(2,',','.');          //  Euro
        $currencies['ESP'] = array(2,',','.');          //  Euro
        $currencies['EUR'] = array(2,',','.');          //  Euro
        $currencies['FIM'] = array(2,',','.');          //  Euro
        $currencies['FRF'] = array(2,',','.');          //  Euro
        $currencies['GRD'] = array(2,',','.');          //  Euro
        $currencies['IEP'] = array(2,',','.');          //  Euro
        $currencies['ITL'] = array(2,',','.');          //  Euro
        $currencies['LUF'] = array(2,',','.');          //  Euro
        $currencies['NLG'] = array(2,',','.');          //  Euro
        $currencies['PTE'] = array(2,',','.');          //  Euro
        $currencies['GHC'] = array(2,'.',',');          //  Ghana, Cedi
        $currencies['GIP'] = array(2,'.',',');          //  Gibraltar Pound
        $currencies['GTQ'] = array(2,'.',',');          //  Guatemala, Quetzal
        $currencies['HNL'] = array(2,'.',',');          //  Honduras, Lempira
        $currencies['HKD'] = array(2,'.',',');          //  Hong Kong Dollar
        $currencies['HUF'] = array(0,'','.');           //  Hungary, Forint
        $currencies['ISK'] = array(0,'','.');           //  Iceland Krona
        $currencies['INR'] = array(2,'.',',');          //  Indian Rupee
        $currencies['IDR'] = array(2,',','.');          //  Indonesia, Rupiah
        $currencies['IRR'] = array(2,'.',',');          //  Iranian Rial
        $currencies['JMD'] = array(2,'.',',');          //  Jamaican Dollar
        $currencies['JPY'] = array(0,'',',');           //  Japan, Yen
        $currencies['JOD'] = array(3,'.',',');          //  Jordanian Dinar
        $currencies['KES'] = array(2,'.',',');          //  Kenyan Shilling
        $currencies['KWD'] = array(3,'.',',');          //  Kuwaiti Dinar
        $currencies['LVL'] = array(2,'.',',');          //  Latvian Lats
        $currencies['LBP'] = array(0,'',' ');           //  Lebanese Pound
        $currencies['LTL'] = array(2,',',' ');          //  Lithuanian Litas
        $currencies['MKD'] = array(2,'.',',');          //  Macedonia, Denar
        $currencies['MYR'] = array(2,'.',',');          //  Malaysian Ringgit
        $currencies['MTL'] = array(2,'.',',');          //  Maltese Lira
        $currencies['MUR'] = array(0,'',',');           //  Mauritius Rupee
        $currencies['MXN'] = array(2,'.',',');          //  Mexican Peso
        $currencies['MZM'] = array(2,',','.');          //  Mozambique Metical
        $currencies['NPR'] = array(2,'.',',');          //  Nepalese Rupee
        $currencies['ANG'] = array(2,'.',',');          //  Netherlands Antillian Guilder
        $currencies['ILS'] = array(2,'.',',');          //  New Israeli Shekel
        $currencies['TRY'] = array(2,'.',',');          //  New Turkish Lira
        $currencies['NZD'] = array(2,'.',',');          //  New Zealand Dollar
        $currencies['NOK'] = array(2,',','.');          //  Norwegian Krone
        $currencies['PKR'] = array(2,'.',',');          //  Pakistan Rupee
        $currencies['PEN'] = array(2,'.',',');          //  Peru, Nuevo Sol
        $currencies['UYU'] = array(2,',','.');          //  Peso Uruguayo
        $currencies['PHP'] = array(2,'.',',');          //  Philippine Peso
        $currencies['PLN'] = array(2,'.',' ');          //  Poland, Zloty
        $currencies['GBP'] = array(2,'.',',');          //  Pound Sterling
        $currencies['OMR'] = array(3,'.',',');          //  Rial Omani
        $currencies['RON'] = array(2,',','.');          //  Romania, New Leu
        $currencies['ROL'] = array(2,',','.');          //  Romania, Old Leu
        $currencies['RUB'] = array(2,',','.');          //  Russian Ruble
        $currencies['SAR'] = array(2,'.',',');          //  Saudi Riyal
        $currencies['SGD'] = array(2,'.',',');          //  Singapore Dollar
        $currencies['SKK'] = array(2,',',' ');          //  Slovak Koruna
        $currencies['SIT'] = array(2,',','.');          //  Slovenia, Tolar
        $currencies['ZAR'] = array(2,'.',' ');          //  South Africa, Rand
        $currencies['KRW'] = array(0,'',',');           //  South Korea, Won
        $currencies['SZL'] = array(2,'.',', ');         //  Swaziland, Lilangeni
        $currencies['SEK'] = array(2,',','.');          //  Swedish Krona
        $currencies['CHF'] = array(2,'.','\'');         //  Swiss Franc 
        $currencies['TZS'] = array(2,'.',',');          //  Tanzanian Shilling
        $currencies['THB'] = array(2,'.',',');          //  Thailand, Baht
        $currencies['TOP'] = array(2,'.',',');          //  Tonga, Paanga
        $currencies['AED'] = array(2,'.',',');          //  UAE Dirham
        $currencies['UAH'] = array(2,',',' ');          //  Ukraine, Hryvnia
        $currencies['USD'] = array(2,'.',',');          //  US Dollar
        $currencies['VUV'] = array(0,'',',');           //  Vanuatu, Vatu
        $currencies['VEF'] = array(2,',','.');          //  Venezuela Bolivares Fuertes
        $currencies['VEB'] = array(2,',','.');          //  Venezuela, Bolivar
        $currencies['VND'] = array(0,'','.');           //  Viet Nam, Dong
        $currencies['ZWD'] = array(2,'.',' ');          //  Zimbabwe Dollar

        function formatinr($input){
            //CUSTOM FUNCTION TO GENERATE ##,##,###.##
            $dec = "";
            $pos = strpos($input, ".");
            if ($pos === false){
                //no decimals   
            } else {
                //decimals
                $dec = substr(round(substr($input,$pos),2),1);
                $input = substr($input,0,$pos);
            }
            $num = substr($input,-3); //get the last 3 digits
            $input = substr($input,0, -3); //omit the last 3 digits already stored in $num
            while(strlen($input) > 0) //loop the process - further get digits 2 by 2
            {
                $num = substr($input,-2).",".$num;
                $input = substr($input,0,-2);
            }
            return $num . $dec;
        }


        if ($curr == "INR"){    
            return formatinr($floatcurr);
        } else {
            return number_format($floatcurr,$currencies[$curr][0],$currencies[$curr][1],$currencies[$curr][2]);
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

    function get_weeks_sent_total(){
        $this -> db-> select('count(*) AS count');
        $this -> db -> from('smsout');
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

    function get_months_sent_total(){
        $this -> db-> select('count(*) AS count');
        $this -> db -> from('smsout');
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