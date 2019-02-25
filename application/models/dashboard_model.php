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
        
        $balance = "KSH 15000.20";
        return $balance;
        // // Set your app credentials
        // $username    = "virtual";
        // $apiKey      = "94219a7707b2db0c295d43d39a566d0cf7920d197ff0eabfc00d12cf35f5e2ff";

        // // Initialize the SDK
        // $AT          = new AfricasTalking($username, $apiKey);

        // // Get the application service
        // $application = $AT->application();

        // try {
        //     // Fetch the application data
        //     $data = $application->fetchApplicationData();

        //     return $data;
        // } catch(Exception $e) {
        //     echo "Error: ".$e->getMessage();
        // }
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