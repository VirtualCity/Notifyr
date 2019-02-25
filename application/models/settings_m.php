<?php
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 10/27/2014
 * Time: 8:11 PM
 */

class Settings_m extends CI_Model{
    function save_email($value1,$value2){
        $emailTagExist = $this->check_email();

        if($emailTagExist){
            //Update
            $data =  array(
                'value1'=>$value1,
                'value2'=>$value2
            );
            $this->db->where('title', 'EMAIL');
            $result = $this->db->update('settings',$data);
            if($result){
                return true;
            }else{
                return false;
            }


        }else{
            //Add new
            $data =  array(
                'title'=>'EMAIL',
                'value1'=>$value1,
                'value2'=>$value2
            );

            $this->db->insert('settings',$data);
            $num_insert = $this->db->affected_rows();
            if($num_insert>0){
                return true;
            }else{
                return false;
            }

        }



    }

    function check_email(){
        $this -> db-> select('*');
        $this -> db -> from('settings');
        $this->db->where('title','EMAIL');
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function get_email(){
        $this -> db-> select('*');
        $this -> db -> from('settings');
        $this->db->where('title','email');
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return $query -> row();
        }else{
            return false;
        }
    }

    /* Query Service Section*/

    function save_qservice($value1){
        $keywordTagExist = $this->check_qservice();

        if($keywordTagExist){
            //Update
            $data =  array(
                'value1'=>$value1,
            );
            $this->db->where('title', 'QUERYSERVICE');
            $result = $this->db->update('settings',$data);
            if($result){
                return true;
            }else{
                return false;
            }


        }else{
            //Add new
            $data =  array(
                'title'=>'QUERYSERVICE',
                'value1'=>$value1,
            );

            $this->db->insert('settings',$data);
            $num_insert = $this->db->affected_rows();
            if($num_insert>0){
                return true;
            }else{
                return false;
            }

        }



    }

    function check_qservice(){
        $this -> db-> select('*');
        $this -> db -> from('settings');
        $this->db->where('title','QUERYSERVICE');
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function get_qservice(){
        $this -> db-> select('*');
        $this -> db -> from('settings');
        $this->db->where('title','QUERYSERVICE');
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return $query -> row();
        }else{
            return false;
        }
    }

    /* SDP Configuration Section*/

    function save_app_configuration($value1,$value2,$value3,$value4,$value5,$value6,$value7,$value8,$value9,$shortcode){
        $configTagExist = $this->check_configuration();

        if($configTagExist){
            //Update
            $data =  array(
                'value1'=>$value1,
                'value2'=>$value2,
                'value3'=>$value3,
                'value4'=>$value4,
                'value5'=>$value5,
                'value6'=>$value6,
                'value7'=>$value7,
                'value8'=>$value8,
                'value9'=>$value9,
                'shortcode'=>$shortcode
            );
            $this->db->where('title', 'CONFIGURATION');
            $result = $this->db->update('settings',$data);
            if($result){
                return true;
            }else{
                return false;
            }


        }else{
            //Add new
            $data =  array(
                'title'=>'CONFIGURATION',
                'value1'=>$value1,
                'value2'=>$value2,
                'value3'=>$value3,
                'value4'=>$value4,
                'value5'=>$value5,
                'value6'=>$value6,
                'value7'=>$value7,
                'value8'=>$value8,
                'value9'=>$value9,
                'shortcode'=>$shortcode
            );

            $this->db->insert('settings',$data);
            $num_insert = $this->db->affected_rows();
            if($num_insert>0){
                return true;
            }else{
                return false;
            }

        }



    }

    function check_configuration(){
        $this -> db-> select('*');
        $this -> db -> from('settings');
        $this->db->where('title','CONFIGURATION');
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function get_configuration(){
        $this -> db-> select('*');
        $this -> db -> from('settings');
        $this->db->where('title','CONFIGURATION');
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return $query -> row();
        }else{
            return false;
        }
    }


}