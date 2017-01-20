<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 5/15/2015
 * Time: 11:17 AM
 */

class Cumulative extends CI_Controller{


    function __construct(){
        parent::__construct();
    }

    function index(){
        $array = json_decode(file_get_contents('php://input'), true);
        $mobile= $array['Mobile'];
        $farmer_code= $array['Code'];
        $month = $array['Month'];



        log_message('info','Mobile: '.$mobile.' Farmer Code: '.$farmer_code.' Month: '.$month);
        // Success received response
        $commodity1 = array("Commodity"=>"Maize","Weight"=>"20");
        $commodity2 = array("Commodity"=>"Beans","Weight"=>"40");
        $deliveries = array($commodity1,$commodity2);
        $responses = array("Name"=>"Brian Mwasi","Code"=>$farmer_code,"StatusCode" => "1", "StatusDetail" => "Success","Deliveries" => $deliveries,"Date"=>"2016/06/31");
        header("Content-type: application/json");
        $encoded = json_encode($responses);
        echo $encoded;

    }

} 