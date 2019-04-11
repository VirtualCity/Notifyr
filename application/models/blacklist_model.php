<?php
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 8/26/14
 * Time: 11:36 AM
 */

class Blacklist_model extends CI_Model{
    function blacklist($msisdn){
        log_message("info","Add".$msisdn." to Black List");


        $data =  array(
            'msisdn'=>$msisdn
        );

        $this->db->insert('blacklist',$data);
        $num_insert = $this->db->affected_rows();

        if($num_insert>0){
            log_message("info","New Blacklisted No: ".$msisdn);
            return true;
        }else{

            log_message("info"," Failed to Blacklist Number: ".$msisdn);
            return false;
        }



    }

    function check_contact($msisdn){
        $this->db->select('*');
        $this->db->from('blacklist');
        $this->db->where('msisdn',$msisdn);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function check_contact_by_id($id){
        $this->db->select('*');
        $this->db->from('blacklist');
        $this->db->where('id',$id);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return $query->row();
        }else{
            return false;
        }
    }

    function remove_contact($id){
        $this->db->where('id',$id);
        $query =$this->db->delete('blacklist');

        /*if($query -> affected_rows() > 0){
            return true;
        }else{
            return false;
        }*/
    }
}