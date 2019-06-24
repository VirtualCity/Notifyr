<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 8/5/14
 * Time: 9:18 AM
 *
 */

class Dailysms extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('text');
        $this->load->library('sms/SmsSender.php');
        $this->load->model('groups_model');
        $this->load->model('sms_model');
        $this->load->model('anotherdb_model');
        $this->load->model('sendsms_model');
        $this->load->model('template_model');
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

    

    private function isJson($string) 
    {
		json_decode($string);
		return (json_last_error() == JSON_ERROR_NONE);
    }
    //Hsenid API
    function index(){
        $this->load->library('sms/log.php');
        $grpfactory = "";
        $grpcontacts = "";
        $config = "";
        $dsn = "";
        $usr = "";
        $pass = "";
        $finalRecipients = [];
        $localGrpContacts = [];
        $message="";
        $userid = 999999;

        // $smsTemplate = "$name delivered $quantity Kgs of Tea $yesterday to $collectioncenter";

        $templateType = '1';
        //pull all daily groups
        $dailygroups = $this->groups_model->get_group_by_type(0);
        // print_r(json_encode($dailygroups));
        //             return;

        //loop through each group picking the group contacts
        if ($dailygroups) {
            foreach ($dailygroups as $key => $value) {
                //get the factory for the group
                $grpfactory = $value->factory_id;
                //pull the daily template
                $template = $this->template_model->get_template_by_type($templateType)->template;
                //get group contacts
                $grpcontacts = $this->groups_model->get_group_contacts($value->id);

                // print_r(json_encode($grpcontacts));
                // return;

                if ($grpcontacts) {
                    $config = $this->settings_m->get_configuration_by_factory($grpfactory);
                    // print_r(json_encode($config));
                    // return;
                    $dsn = $config->remotedbdsn;
                    $usr = $config->remotedbuser;
                    $pass = $config->remotedbpass;

                    $adb = $this->anotherdb_model;
                    $conn = $adb->getConnection($dsn, $usr, $pass);

                    if ($conn !== null) {
                        // $cumulative = $adb->getLastOneDayToDate($conn);
                        // $cumulative = $adb->get2MonthsToDate($conn);
                        $cumulative = $adb->getAllUsers($conn);
                        // print_r(json_encode($cumulative));
                        // return;
                        // logFile("[ recipients=$cumulative[1] ]");
                        
                        foreach ($grpcontacts as $key1 => $value1) {
                            array_push($localGrpContacts, $value1->msisdn);
                        }

                        //prepare the final array of farmers
                        foreach ($cumulative as $key2 => $value2) {
                            if (in_array($value2->Phone, $localGrpContacts))
                            {
                                array_push($finalRecipients, $value2);
                            }
                        }

                        // print_r($finalRecipients);
                        // return;
                        //loop through the final recipient for the group and send sms using the template
                    foreach ($finalRecipients as $key3 => $value3) {
                        $message = $template;
                        // print(json_encode($value3));
                        foreach ($value3 as $keyx => $valuex) {    
                            $keyd = '['.$keyx.']';
                            if (strpos($template, $keyd) !== false) {
                                $message = str_replace('['.$keyx.']', $valuex, $message);
                            }  
                        }

                        //Send message
                                $recipients = array($value3->Phone);
                                // print_r($recipients);
                                // return;
                                
                                $msg_sent = $this->sendsms_model->send_sms($recipients, $message);
                                // print($msg_sent);
                                // return;
                                $check = $this->isJson($msg_sent);
                                
                                log_message("info", "Sending status: " . $check);
                                
                                

                                if ($msg_sent !== null && $msg_sent !== 'fail' && $check) {
                                    $success = 0;
                                    $failed = 0;
                                    $smsresponse = json_decode($msg_sent)->SMSMessageData->Recipients;
                                    
                                    //loop through the result if it contains more than one object and save each response
                                    foreach ($smsresponse as $key => $value) {
                                        if ($value->status == 'Success') {
                                            $success++;
                                            $status = 'Sent';
                                            $phoneNumber = substr($value->number, 1);
                                            $this->sms_model->save_sms($phoneNumber, "Individual", $message, $userid, $value->messageId,$status,$grpfactory);
                                            // print($phoneNumber);
                                            // return;
                                        }else{
                                            $failed++;
                                            logFile("[ info= 'Sending status code: '.$value->Status ]");
                                            log_message("info", "Sending status code: " . $value->Status);
                                        }
                                        
                                    }
                                } else {
                                    //log sms sent failur
                                    log_message("error", "Sending failed: ");
                                    logFile("[ error= 'Sending failed: ']");
                                }
                        
                        }
                    
                    }
   
                   
                }
                $finalRecipients = [];
                $localGrpContacts = [];
            }
        }
         
    }

}