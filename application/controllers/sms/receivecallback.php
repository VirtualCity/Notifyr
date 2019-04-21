<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 8/5/14
 * Time: 9:18 AM
 *
 */

class ReceiveCallback extends CI_Controller{
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
        $this->load->library('sms/SmsReceiver.php');
        $this->load->library('sms/SmsSender.php');
        $this->load->library('sms/log.php');


        try {



            $receiver = new SmsReceiver(); // Create the Receiver object

            $content = $receiver->getMessage(); // get the message content
            $address = $receiver->getAddress(); // get the sender's address
            $requestId = $receiver->getRequestID(); // get the request ID
            $applicationId = $receiver->getApplicationId(); // get application ID
            $encoding = $receiver->getEncoding(); // get the encoding value
            $version = $receiver->getVersion(); // get the version


            logFile("[ content=$content, address=$address, requestId=$requestId, applicationId=$applicationId, encoding=$encoding, version=$version ]");
            // //log_message("info","[ content=$content, address=$address, requestId=$requestId, applicationId=$applicationId, encoding=$encoding, version=$version ]");

            //SDP Configuration
            $applicationId = "";
            $password = "";
            $sourceAddress = "";
            $sourceKeyword ="";
            $subscriptionKeyword="";
            $unsubscriptionKeyword="";
            $allowedPurchaseGroup="";

            // $configurationData = $this->settings_m->get_configuration();
            
            // if($configurationData){
            //     $applicationId = $configurationData->value1;
            //     $password = $configurationData->value2;
            //  // $sourceAddress = $configurationData->value9;
            //     $sourceKeyword = $configurationData->value4;
            //     $subscriptionKeyword = $configurationData->value6;
            //     $unsubscriptionKeyword = $configurationData->value7;
            //     $allowedPurchaseGroup = $configurationData->value8;
            // }
            


            $responseMsg="";
            $factoryId = "";
            $msg_group="";
            $message="";
            $msisdn = $address;

            $contact1 = $this->contacts_model->get_contact_by_msisdn($msisdn);
            if($contact1){
                $factoryId = $contact1->factory;
                $configurationData = $this->settings_m->get_configuration_by_factory($factoryId);
            
                if($configurationData){
                    $applicationId = $configurationData->value1;
                    $password = $configurationData->value2;
                    $sourceAddress = $configurationData->value9;
                    $sourceKeyword = $configurationData->value4;
                    $subscriptionKeyword = $configurationData->value6;
                    $unsubscriptionKeyword = $configurationData->value7;
                    $allowedPurchaseGroup = $configurationData->value8;
                }

            }
            //check if number is in blacklist
            $blacklisted = $this->blacklist_model->check_contact($msisdn);

            if(!$blacklisted){

                //Get keyword
                $content_split = explode(' ',$content);

                if(sizeof($content_split) >0){
                    $keyword = $content_split[0];//Keyword
                    $key_word = trim(strtoupper($keyword));

                    if($key_word === trim(strtoupper($sourceKeyword))){

                            //Split message where there is space
                            $split = explode(' ', $content);

                            if (sizeof($split) < 3) {
                                $part2 = $split[1];//Carton Code
                                //Check length of Carton Code if greater than 4
                                if(strlen($part2) >= 4 ){

                                    //First four digits rep product code
                                    $productCode  = substr($part2,0, 3);
                                    log_message("info","product code".$productCode);
                                    $product_valid = $this->products_m->check_code($productCode);
                                    if($product_valid){
                                        $contact = $this->contacts_model->get_contact_by_msisdn($msisdn);
                                        if(!$contact){
                                            $contact = $this->__getDefaultContact();
                                        }
                                        if(!empty($allowedPurchaseGroup && $allowedPurchaseGroup !=0)){
                                            
                                            //restricted to single group
                                            $subscribed = $this->contacts_model->check_subscribed_contact($allowedPurchaseGroup,$msisdn);
                                            $active = $this->contacts_model->check_active_contact($allowedPurchaseGroup,$msisdn);
                                           
                                            if($subscribed && $active){
                                                $product_saved = $this->sms_model->save_purchase_report($part2,$productCode,$msisdn,$contact,$factoryId);

                                                if($product_saved){
													//log_message("info","Report Saved");
                                                    $responseMsg = 'Your report has been received. Thank you';
                                                }else{
                                                    $responseMsg = 'Your report has been received. Thank you';
                                                }
                                            }else{
                                                $responseMsg = 'Sorry! You are not allowed to use this SMS service';
                                            }
                                            //confirm sender is in group
                                        }else{
                                            $responseMsg = 'Sorry! This service has been disabled';
                                        }

                                    }else{
                                        $responseMsg =  $responseMsg = 'Unable to determine product!';
                                    }

                                }else{
                                    $responseMsg = 'Wrong Format! Kindly use the correct SMS format.';
                                }

                            } else {

                                $part2 = $split[1];//Service Word or Group Name or Reg or Unreg
                                $part3 = $split[2];//Farmercode or Group Name or GROUP Message

                                // //log_message("info", "Message parts = Keyword: ".$keyword." Part2: ".$part2." Part3: ".$part3);


                                //Check if service code exists
                                $service_word = trim(strtoupper($part2));
                                if($service_word === 'TOTAL') {


                                    /*Service Types Defined in Agrimanagr
                                     * 1 Cummulative
                                     * 2 Other services
                                    */
                                    $servicecode =1;

                                    $farmercode ="";
                                    $selected_month = "";
                                    $month_exists = false;

                                    //Check if message has more than 3 parts
                                    if (sizeof($split) > 3) {
                                        //log_message("info", 'Split parts more than 4');
                                        //Check if 4th part corresponds to month
                                        $farmercode = $split[2];
                                        $selected_month = strtoupper($split[3]);

                                        //Validate month
                                        $months = array('JANUARY','FEBRUARY','MARCH','APRIL','MAY','JUNE','JULY','AUGUST','SEPTEMBER','OCTOBER','NOVEMBER','DECEMBER');

                                        foreach($months as $month){
                                            if($month ==$selected_month){
                                                //Month found
                                                $month_exists = true;
                                                break;
                                            }
                                        }
                                    }else{
                                        // //log_message("info", 'Split parts = 3');
                                        //message has three parts
                                        $farmercode = $split[2];
                                    }

                                    if($selected_month !=="" && $month_exists === false){
                                        //Month provided but does not have correct spelling

                                        $responseMsg = "Incorrect Month name. Kindly SMS again and include a valid month name";
                                        //log_message("info", 'Month not found. Provide valid month name!');
                                    }else{
                                        //Month provided or not provided
                                        //log_message("info", 'Retrieving cumulative');

                                        $nmonth = $nmonth = date('m');
                                        if($selected_month !==""){
                                            $nmonth = date('m',strtotime($selected_month));
                                        }


                                        $data_to_post = array();
                                        $data_to_post['Mobile'] = $msisdn;
                                        //$data_to_post['ServiceType'] = $servicecode;
                                        $data_to_post['Code'] = $farmercode;
                                        $data_to_post['Month'] = $nmonth;

                                        //log_message('info','Post Parameters to send = mobile:'.$msisdn.', FarmerCode:'.$farmercode.', Month:'.$nmonth);

                                        //Service Test
                                        //$url = "http://localhost/agrimanagrsms/services/cumulative";

                                        //Live Test
                                       // $url= 'http://localhost:59157/reports/farmerquery/farmerquery';

                                        //Retrieve URL from DB
                                        $url ="";
                                        $agrimanagrDATA = $this->settings_m->get_qservice();
                                        if($agrimanagrDATA){
                                           $url = $agrimanagrDATA->value1;
                                          //$url = "http://localhost:59157/reports/farmerquery/farmerquery";
										  //$url = "http://localhost/agrimanagrsms/services/cumulative";
                                        }
                                        //log_message('info','URL:'.$url);
                                        $curl_content = json_encode($data_to_post);
                                        $curl = null;
                                        try{
                                            // Initialize cURL

                                            $curl = curl_init($url);
                                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                            curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
                                            curl_setopt($curl, CURLOPT_POST, true);
                                            curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_content);
                                            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

                                            $json_response = curl_exec($curl);
                                            //log_message("info", 'response: '.$json_response);

                                            if(curl_errno($curl)){
                                                $responseMsg = "Cummulative Service unreachable. Kindly try again later.";
                                                //log_message("error", "Could not connect. Curl Error:".curl_error($curl));
                                                //die('Couldn\'t send request: ' . curl_error($ch));
                                            }else{
                                                //Check HTTP status code of request

                                                $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                                                // $status = curl_getinfo($curl);
                                                //log_message("info", 'Curl info: '.$status);

                                                if ( $status != 200 ) {
                                                    $responseMsg = "Cummulative Service unreachable. Kindly try again later.";
                                                    //log_message("info", "Error: call to URL". $url. "failed with status ".$status.",  response". $json_response.", curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
                                                    //die("Error: call to URL". $url. "failed with status ".$status.",  response". $json_response.", curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));

                                                }else{
                                                    $service_response = json_decode($json_response, true);

                                                    if(array_key_exists('StatusCode', $service_response)){
                                                        /* Ok = 1,
                                                       InvalidFarmerCode = 2,
                                                       UnregisteredMobile = 3,
                                                       MobileNotLinkedToFarmer = 4
                                                    */
                                                        //log_message("info","Curl Status Code".$status);

                                                        $statusCode= $service_response['StatusCode'];
                                                        $statusDetail = $service_response['StatusDetail'];
                                                        $farmerCode = $service_response['Code'];
                                                        $farmerName = $service_response['Name'];
                                                        $asAtDate = $service_response['Date'];
                                                        $summaryDetail = $service_response['Deliveries'];


                                                        switch($statusCode){
                                                            case 1:
                                                                //Farmercode exists and cummulative returned
                                                                //log_message("info", 'Status Code:'.$statusCode.' Status detail: '.$statusDetail);
                                                                // $commodities = json_decode($service_response);
                                                                $responseMsg=$farmerName.', Supplier Code: '.$farmerCode.', ';
                                                                if(sizeof($summaryDetail) > 0){
                                                                    //log_message('info','Summary detail is not null');
                                                                    foreach ($summaryDetail as $commodity){
                                                                        $responseMsg = $responseMsg. ' '.$commodity['Commodity'].':'.$commodity['Weight'].'Kg ';
                                                                    }
                                                                }else{
                                                                    //log_message('info','Summary detail is null');
                                                                    $responseMsg = $responseMsg.' Cumulative Weight: 0 Kg ';
                                                                }
                                                                $responseMsg = $responseMsg.'as at '.$asAtDate;
                                                                //log_message('info','SMS Resp:'.$responseMsg);
                                                                break;
                                                            case 2:
                                                                //Farmercode not found
                                                                //log_message("info", 'Status Code:'.$statusCode.' Status detail: '.$statusDetail);
                                                                $responseMsg='The Farmer Code you have provided does not exist in the system. Kindly provide a valid Farmer Code';
                                                                break;
                                                            case 3:
                                                                //Mobile number not authenticated
                                                                //log_message("info", 'Status Code:'.$statusCode.' Status detail: '.$statusDetail);
                                                                $responseMsg='The Mobile number you are using is not authorised to query for this Farmercode:'.$farmercode;
                                                                break;
                                                            case 4:
                                                                //Mobile number not authenticated
                                                                //log_message("info", 'Status Code:'.$statusCode.' Status detail: '.$statusDetail);
                                                                $responseMsg='The Mobile number you are using is not authorised to query for this Farmercode:'.$farmercode;
                                                                break;
                                                            default:
                                                                //Error not defined by Agrimanagr. send default message
                                                                //log_message("info", 'Status Code:'.$statusCode.' Status detail: '.$statusDetail);
                                                                $responseMsg='System error. Kindly try again later';
                                                        }

                                                    }else{
                                                        $responseMsg = "Cummulative Service unreachable. Kindly try again later.";
                                                        //log_message("info", "Error: call to URL". $url. "failed with status ".$status.",  response". $json_response.", curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
                                                    }

                                                }
                                            }



                                        }catch (Exception $e){
                                            $responseMsg = "Query Service is currently unavailable. Kindly try again later.";
                                            //log_message("Error", 'Error Message:'.$e->getMessage());
                                        }

                                        curl_close($curl);
                                    }

                                    //Save received cummulative query
                                    $saved = $this->sms_model->save_received_sms($msisdn, trim($content), "TOTAL","NONE", "AUTO-REPLIED",$factoryId);
                                    if (!$saved) {
                                        log_message("info", 'Failed to save received Cummulative total query.');
                                    }

                                }else{
                                    //Check if it is Meant for GROUPS

                                    //log_message("info", 'part2:'.$part2);

                                    //Check if group exists
                                    $group_exist = $this->groups_model->check_group_name(trim($part2));

                                    if ($group_exist) {//Message is for Groups processing.

                                        $minus = strlen((string)$keyword) + strlen((string)$part2) + 2;
                                        $message = substr($content, $minus);

                                        //save received message for the group

                                        $saved = $this->sms_model->save_received_sms($msisdn, trim($message), "GROUP",trim($part2), "PENDING",$factoryId);
                                        if ($saved) {
                                            //log_message("info", 'Group Message: "' . $content . '" From: "' . $msisdn . '"., Contact');
                                            $responseMsg = "Your message has been received. Thank you";
                                        } else {
                                            $responseMsg = "System Error, Please try again.";
                                            //log_message("info", $responseMsg);
                                        }

                                    } else {
                                        //log_message("info","Part2 not a group message");
                                        //check if it matches reg
                                        if(strtoupper($part2)==strtoupper($subscriptionKeyword)){

                                            //check if third message part is an existing group
                                            $group_exist = $this->groups_model->check_group_name($part3);

                                            if($group_exist){

                                                /*todo check if group is locked*/
                                                $groupLocked= false;
                                                if(!empty($allowedPurchaseGroup)){
                                                    $lockedGroup = $this->groups_model->get_group_by_id($allowedPurchaseGroup);

                                                    if(strtoupper($lockedGroup->name)===strtoupper($part3)){
                                                        $groupLocked = true;

                                                    }
                                                }

                                                $minus = strlen((string)$keyword) +1;
                                                $message = substr($content,$minus);

                                                //save received message for the group
                                                $saved = $this->sms_model->save_received_sms($msisdn,trim($message),'SUBSCRIPTION',trim($part3),"AUTO-REPLIED");

                                                if($groupLocked){
                                                    $responseMsg="Sorry! This group does not allow self subscription ";
                                                }else{
                                                    if($saved){
                                                        //log_message("info","Subscription message logged to received messages");
                                                        $responseMsg = $this->contacts_model->add_group_contacts(trim($part3),$msisdn,"","","","",null,null);
                                                    }else{
                                                        $responseMsg="System error. Please try again ";
                                                        //log_message("info",$responseMsg." Failed to save subscriber to contacts");
                                                    }
                                                }

                                            }else{
                                                //group not found
                                                $minus = strlen((string)$keyword) +1;
                                                $message = substr($content,$minus);

                                                //save received message for the group
                                                $saved = $this->sms_model->save_received_sms($msisdn,trim($message),'SUBSCRIPTION','NONE',"AUTO-REPLIED",$factoryId);
                                                if($saved){
                                                    $responseMsg="Subscription failed. Kindly subscribe to an existing group ";
                                                    //log_message("info",$responseMsg);
                                                }
                                            }
                                        }elseif(strtoupper($part2)==strtoupper($unsubscriptionKeyword)) {
                                            //Unregister from group messages
                                            //check if third message part is an existing group
                                            $group_exist = $this->groups_model->check_group_name(trim($part3));

                                            if($group_exist){
                                                //log_message("info","Un-subscription request from ".$msisdn);
                                                $minus = strlen((string)$keyword) +1; //remove keyword and space before group name
                                                $message = substr($content,$minus);

                                                //save received message for the group
                                                $saved = $this->sms_model->save_received_sms($msisdn,trim($message),'UNSUBSCRIPTION',trim($part3),"AUTO-REPLIED",$factoryId);
                                                if($saved){
                                                    $responseMsg = $this->contacts_model->remove_group_contact($part3,$msisdn);
                                                    //log_message("info",$responseMsg);
                                                }else{
                                                    $responseMsg="System error. Please try again ";
                                                    //log_message("info",$responseMsg." Failed to unsubscribe mobile number: ".$msisdn);
                                                }
                                            }else{
                                                //group not found
                                                $minus = strlen((string)$keyword) +1;
                                                $message = substr($content,$minus);

                                                //save received message for the group
                                                $saved = $this->sms_model->save_received_sms($msisdn,trim($message),'UNSUBSCRIPTION',"NONE","AUTO-REPLIED",$factoryId);
                                                if($saved){
                                                    $responseMsg="Subscription failed. Kindly unsubscribe from existing groups ";
                                                    //log_message("info",$responseMsg);
                                                }
                                            }
                                        }else{
                                            //Wrong format used
                                            //save received message to table for wrong format
                                            $this->sms_model->save_received_sms($msisdn,$content,'UNKNOWN',"NONE","AUTO-REPLIED",$factoryId);

                                            //Service code doesn't exist. Group doesnt Exist
                                            //log_message("info", 'Neither Service Code nor Group exists in message: "' . $content . '" From: "' . $msisdn . '"');
                                            $responseMsg = "Invalid Message format";


                                        }


                                    }
                                }

                            }
                     }else{
                        $responseMsg = "Invalid Keyword.";
                    }

                }else{
                    $responseMsg = "Invalid message format!";
                    //log_message("info", "Invalid Message Format. Keyword and content missing");
                }
            }else{
                //log_message("info","SMS received from blacklisted number: ".$msisdn." Message: ".$content);
                $responseMsg = "You are not allowed to use this SMS service.";
            }

            //log_message("info","Final SMS response to send: ".$responseMsg);



            // Create the sender object server url

            echo json_encode($responseMsg);
            

            
            $this->sms_model->log_auto_reply($msisdn,"Individual",$responseMsg,0);

        } catch (SmsException $ex) {
            //throws when failed sending or receiving the sms
            //log_message("info","Error Code: ".$ex->getStatusCode());
            //log_message("error","Error Message: ".$ex->getStatusMessage());
            error_log("ERROR: {$ex->getStatusCode()} | {$ex->getStatusMessage()}");
        }
    }


    function __getDefaultContact(){

        $subscriber = array(
            'name'=> "",
            'id_number'=> "",
            'email'=> "",
            'address'=> "",
            'town'=>"",
            'region'=>""
        );
        return $subscriber;

    }

}