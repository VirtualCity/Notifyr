<?php
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 10/6/2014
 * Time: 10:12 AM
 */

class Managers_m extends CI_Model{

    function add_manager($name,$mobile,$email,$division,$region_id){

        $data =  array(
            'name'=>$name,
            'mobile'=>$mobile,
            'email'=>$email,
            'division'=>$division,
            'region_id'=>$region_id);
        $this->db->set('created','NOW()',false);
        $this->db->insert('managers',$data);
        $num_insert = $this->db->affected_rows();
        if($num_insert>0){
            return true;
        }
        return false;
    }

    /*Retrieve a Manager with specified id*/
    function get_manager($id){
        $this->db->select('*');
        $this->db->from('managers');
        $this->db->where('id',$id);
        $query = $this -> db -> get();

        if($query -> num_rows() === 1){
            return $query -> row();
        }else{
            return false;
        }
    }



    /*Check manager name doesnt exists*/
    function check_manager_name($name){
        $this->db->select('*');
        $this->db->from('managers');
        $this->db->where('name',$name);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    /*Check manager mobile doesnt exists*/
    function check_manager_mobile($mobile){
        $this->db->select('*');
        $this->db->from('managers');
        $this->db->where('mobile',$mobile);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    /*Check manager mobile doesnt exists*/
    function check_manager_email($email){
        $this->db->select('*');
        $this->db->from('managers');
        $this->db->where('email',$email);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    /*Verify manager name doesnt exists apart from current manager being edited*/
    function verify_manager_name($id,$name){
        $this->db->select('*');
        $this->db->from('managers');
        $this->db->where('id !=',$id);
        $this->db->where('name',$name);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    /*Verify manager mobile doesnt exists apart from current manager being edited*/
    function verify_manager_mobile($id,$mobile){
        $this->db->select('*');
        $this->db->from('managers');
        $this->db->where('id !=',$id);
        $this->db->where('mobile',$mobile);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    /*Verify manager email doesnt exists apart from current manager being edited*/
    function verify_manager_email($id,$email){
        $this->db->select('*');
        $this->db->from('managers');
        $this->db->where('id !=',$id);
        $this->db->where('mobile',$email);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function update_manager($id,$name,$mobile,$email,$division,$region_id){
        $data = array(
            'mobile'=>$mobile,
            'name' => $name,
            'email'=>$email,
            'division'=>$division,
            'region_id'=>$region_id,
        );
        $this->db->where('id', $id);
        $query = $this->db->update('managers', $data);

        if($query){
            return true;
        }else{
            return false;
        }
    }

    //Get managers by id
    function get_manager_by($id){
        $this->db->select('*');
        $this->db->from('managers');
        $this->db->where('id',$id);
        $query = $this -> db -> get();

        if($query -> num_rows() === 1){
            return $query -> row();
        }else{
            return false;
        }
    }

    //Get Managers by region id
    function get_managers_by_region($region_id){
        $this -> db-> select('*');
        $this -> db -> from('managers');
        $this-> db -> where('region_id',$region_id);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return $query -> result();
        }else{
            return false;
        }
    }

}