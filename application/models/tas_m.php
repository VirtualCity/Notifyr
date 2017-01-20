<?php
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 10/6/2014
 * Time: 10:12 AM
 */

class Tas_m extends CI_Model{

    function save_tas($name,$mobile,$email,$division){

        $data =  array(
            'name'=>$name,
            'mobile'=>$mobile,
            'email'=>$email,
            'division'=>$division
        );

        $this->db->insert('area_tas',$data);
        $num_insert = $this->db->affected_rows();
        if($num_insert>0){
            return true;
        }else{
            return false;
        }
    }

    function add_tas($name,$mobile,$email,$division,$region_id,$town_id){

        $data =  array(
            'name'=>$name,
            'mobile'=>$mobile,
            'email'=>$email,
            'division'=>$division
        );

        $this->db->insert('area_tas',$data);
        $insert_id = $this->db->insert_id();

        if($insert_id){
            $data2 = array(
                'ta_id'=>$insert_id,
                'region_id'=>$region_id,
                'town_id'=>$town_id
            );
            $this->db->insert('towns_tas',$data2);
            $num_insert = $this->db->affected_rows();
            if($num_insert>0){
                return true;
            }
            return false;
        }else{
            return false;
        }

    }
    function add_tas_to_town($ta_id,$town_id,$region_id){

        $data =  array(
            'region_id'=>$region_id,
            'town_id'=>&$town_id,
            'ta_id'=>$ta_id
        );

        $this->db->insert('towns_tas',$data);
        $num_insert = $this->db->affected_rows();
        if($num_insert>0){
            return true;
        }
        return false;
    }

   /* function assign_tas_to_town($ta_id,$town_id,$region_id){

        $data =  array(
            'region_id'=>$region_id,
            'town_id'=>&$town_id,
            'ta_id'=>$ta_id
        );

        $this->db->insert('towns_tas',$data);
        $num_insert = $this->db->affected_rows();
        if($num_insert>0){
            return true;
        }
        return false;
    }*/


    /*Retrieve a supervisors with specified id*/
    function get_tas($id){
        $this->db->select('*');
        $this->db->from('area_tas');
        $this->db->where('id',$id);
        $query = $this -> db -> get();

        if($query -> num_rows() === 1){
            return $query -> row();
        }else{
            return false;
        }
    }

    /*Retrieve a supervisors with specified id*/
    function get_tas_by_email($email){
        $this->db->select('*');
        $this->db->from('area_tas');
        $this->db->where('email',$email);
        $query = $this -> db -> get();

        if($query -> num_rows() === 1){
            return $query -> row();
        }else{
            return false;
        }
    }



    /*Check supervisors name doesnt exists*/
    function check_tas_name($name){
        $this->db->select('*');
        $this->db->from('area_tas');
        $this->db->where('name',$name);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    /*Check supervisors mobile doesnt exists*/
    function check_tas_mobile($mobile){
        $this->db->select('*');
        $this->db->from('area_tas');
        $this->db->where('mobile',$mobile);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    /*Check supervisors mobile doesnt exists*/
    function check_tas_email($email){
        $this->db->select('*');
        $this->db->from('area_tas');
        $this->db->where('email',$email);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    /*Verify supervisors name doesnt exists apart from current supervisors being edited*/
    function verify_tas_name($id,$name){
        $this->db->select('*');
        $this->db->from('area_tas');
        $this->db->where('id !=',$id);
        $this->db->where('name',$name);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    /*Verify supervisors mobile doesnt exists apart from current supervisors being edited*/
    function verify_tas_mobile($id,$mobile){
        $this->db->select('*');
        $this->db->from('area_tas');
        $this->db->where('id !=',$id);
        $this->db->where('mobile',$mobile);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    /*Verify supervisors email doesnt exists apart from current supervisors being edited*/
    function verify_tas_email($id,$email){
        $this->db->select('*');
        $this->db->from('area_tas');
        $this->db->where('id !=',$id);
        $this->db->where('mobile',$email);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function update_tas($id,$name,$mobile,$email,$division){
        $data =  array(
            'name'=>$name,
            'mobile'=>$mobile,
            'email'=>$email,
            'division'=>$division
        );
        $this->db->set('modified','NOW()',false);
        $this->db->where('id', $id);
        $query = $this->db->update('area_tas', $data);

        if($query){
            return true;
        }else{
            return false;
        }
    }


    /*Retrieve all supervisors */
    function get_all_tas(){
        $this->db->select('*');
        $this->db->from('area_tas');
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return $query-> result();
        }else{
            return false;
        }
    }

    /*Retrieve all supervisors */
    function get_tas_by_townID($town_id){
        /*$this->db->select('*');
        $this->db->from('area_tas');
        $this->db->where('town_id',$town_id);*/

        $this->db->select('area_tas.id AS id,area_tas.name as name,area_tas.mobile as mobile,area_tas.email as email,area_tas.division as division, area_tas.modified As modified,area_tas.created As created');
        $this->db->from('towns_tas');
        $this->db->join('area_tas', 'towns_tas.ta_id = area_tas.id');
        $this->db->where('towns_tas.town_id',$town_id);

        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return $query-> result();
        }else{
            return false;
        }
    }

    /*Retrieve all supervisors */
    function get_TasNotInTownID($town_id){
        //Select from table 1 where some column in table 1 does not exist in table two
        $query =  $this->db->query('select * from area_tas WHERE NOT EXISTS ( SELECT * FROM towns_tas WHERE area_tas.id = towns_tas.ta_id AND towns_tas.town_id = '.$town_id.')');

        if($query -> num_rows() > 0){
            return $query-> result();
        }else{
            return false;
        }
    }



    function remove_tas_from_town($id,$town_id){
        $this->db->where('ta_id',$id);
        $this->db->where('town_id',$town_id);
        $query = $this->db->delete('towns_tas');

        if($query){
            return true;
        }
        return false;
    }

    function check_tas_in_town($ta_id,$town_id){
        $this->db->select('*');
        $this->db->from('towns_tas');
        $this->db->where('town_id',$town_id);
        $this->db->where('ta_id',$ta_id);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

}