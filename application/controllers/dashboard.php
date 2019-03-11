<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 7/30/14
 * Time: 3:50 PM
 */

class Dashboard extends MY_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('dashboard_model');

    }

    function index(){

        if(!$this->session->userdata('logged_in')){
            redirect('/login');
            //echo("You are NOT logged in");
        }
        log_message("info", "Role: ". $this->session->userdata('role'));

        $role = $this->session->userdata('role');


        //Retrieve Dashboard variables
        $today_totals =  "";
        $weeks_total =  "";
        $months_total =  "";
        $today_sent_totals =  "";
        $weeks_sent_total =  "";
        $months_sent_total =  "";
        $contacts_total =  "";
        $blacklist_total =  "";
        $groups_total =  "";
        $outbox_total = "";
        $balance_total = "";
        $sms_balance = "";
        $sms_pending = "";

        $today_totals = $this->dashboard_model->get_todays_total();
        $weeks_total = $this->dashboard_model->get_weeks_total();
        $months_total = $this->dashboard_model->get_months_total();
        $today_sent_totals = $this->dashboard_model->get_todays_sent_total();
        $weeks_sent_total = $this->dashboard_model->get_weeks_sent_total();
        $months_sent_total = $this->dashboard_model->get_months_sent_total();
        $contacts_total = $this->dashboard_model->get_contacts_total();
        $blacklist_total = $this->dashboard_model->get_blacklist_total();
        $groups_total = $this->dashboard_model->get_contact_groups_total();
        $sms_balance = $this->dashboard_model->get_sms_balance();
        $sms_pending = $this->dashboard_model->get_sms_pending_total();
       // $outbox_total = $this->dashboard_model->get_outbox_total();

        //Add dashvboards variables in data array
        $data['todays_total']=$today_totals;
        $data['weeks_total']=$weeks_total;
        $data['months_total']=$months_total;
        $data['today_sent_totals']=$today_sent_totals;
        $data['weeks_sent_total']=$weeks_sent_total;
        $data['months_sent_total']=$months_sent_total;
        $data['contacts_total']=$contacts_total;
        $data['blacklist_total']=$blacklist_total;
        $data['groups_total']=$groups_total;
        $data['outbox_total']=$outbox_total;
        $data['sms_balance']=$sms_balance;
        $data['sms_pending']=$sms_pending;

        

        $last_7days_cummulative = "";


        //Cummulative received last 7 days section
        for($days=0; $days<7; $days++){
            $interval = "-".$days." days";
            $count = $this->dashboard_model->getLastDaysCummulativeQueries($days);
            //$countDate = date_sub(date("Y-m-d H:i:s"),date_interval_create_from_date_string('10 days'));
            $countDate = date("Y-m-d",strtotime($interval));
            $formatedDate = strtotime($countDate) * 1000;
            if($days!=6){
                $last_7days_cummulative = $last_7days_cummulative."[".$formatedDate.",".$count."],";
            }else{
                $last_7days_cummulative = $last_7days_cummulative."[".$formatedDate.",".$count."]";
            }
        }

        $data['last_7days_cummulative'] = $last_7days_cummulative;

        $last_7days_received = "";
        $last_7days_replied = "";
        $last_7days_pending = "";

        //Received received last 7 days section
        for($days=0; $days<7; $days++){
            $interval = "-".$days." days";
            $count = $this->dashboard_model->getLastDaysGroupQueryRecievedMessages($days);
            //$countDate = date_sub(date("Y-m-d H:i:s"),date_interval_create_from_date_string('10 days'));
            $countDate = date("Y-m-d",strtotime($interval));
            $formatedDate = strtotime($countDate) * 1000;
            if($days!=6){
                $last_7days_received = $last_7days_received."[".$formatedDate.",".$count."],";
            }else{
                $last_7days_received = $last_7days_received."[".$formatedDate.",".$count."]";
            }
        }

        $data['last_7days_received'] = $last_7days_received;

        //Replies done last 7 days section
        for($days=0; $days<7; $days++){
            $interval = "-".$days." days";
            $count = $this->dashboard_model->getLastDaysGroupQueryRepliedMessages($days);
            //$countDate = date_sub(date("Y-m-d H:i:s"),date_interval_create_from_date_string('10 days'));
            $countDate = date("Y-m-d",strtotime($interval));
            $formatedDate = strtotime($countDate) * 1000;
            if($days!=6){
                $last_7days_replied = $last_7days_replied."[".$formatedDate.",".$count."],";
            }else{
                $last_7days_replied = $last_7days_replied."[".$formatedDate.",".$count."]";
            }
        }
        $data['last_7days_replied'] = $last_7days_replied;
        $data['base']=$this->config->item('base_url');
        $data['user_role'] = $role;
        $data['title'] = "Dashboard";
        $data['mainContent']='dashboard';
       /* echo "<pre>";
        print_r ($data);
        echo "</pre>";*/
        $this->load->view('templates/template',$data);
    }

}