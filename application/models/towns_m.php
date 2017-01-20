<?php
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 8/1/14
 * Time: 1:07 AM
 */

class Towns_m extends CI_Model{
    function get_all_towns(){
        $this->db->select('*');
        $this->db->from('towns');
        $query = $this -> db -> get();
        if ($query->num_rows() > 0){
            return $query -> result();
        }else{
            return false;
        }
    }

    function get_town($id){
        $this->db->select('*');
        $this->db->from('towns');
        $this->db->where('id',$id);
        $query = $this -> db -> get();
        if($query -> num_rows() > 0){
            return $query -> row();
        }else{
            return false;
        }
    }

    function getAddTownId($town,$regionId){
        $twn = $this->get_town_by_name($town,$regionId);
        if($twn){
            return $twn->id;
        }else{
            $data =  array(
                'name'=>ucwords($town),
                'region_id'=>$regionId
            );
            $this->db->set('created','NOW()',false);
            $this->db->insert('towns',$data);
            $num_insert = $this->db->affected_rows();
            if($num_insert>0){
                return $this->db->insert_id();
            }
            return false;
        }

    }

    function check_town($town_name){
        $this->db->select('*');
        $this->db->from('towns');
        $this->db->where('name',$town_name);
        $query = $this -> db -> get();
        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function get_town_by_name($town_name,$regionId){
        $this->db->select('*');
        $this->db->from('towns');
        $this->db->where('name',$town_name);
        $this->db->where('region_id',$regionId);
        $query = $this -> db -> get();
        if($query -> num_rows() > 0){
            return $query -> row();
        }else{
            return false;
        }
    }


    function check_town_region($town_name, $region_id){
        $this->db->select('*');
        $this->db->from('towns');
        $this->db->where('name',$town_name);
        $this->db->where('region_id',$region_id);
        $query = $this -> db -> get();
        if($query -> num_rows() > 0){
            return $query -> row();
        }else{
            return false;
        }
    }

    function verify_town($id,$name){
        $this->db->select('*');
        $this->db->from('towns');
        $this->db->where('id !=',$id);
        $this->db->where('name',$name);
        $query = $this -> db -> get();
        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function check_code($code){
        $this->db->select('*');
        $this->db->from('towns');
        $this->db->where('code',$code);
        $query = $this -> db -> get();
        if($query -> num_rows() > 0){
            if(empty($code))
                return false;
            return true;
        }else{
            return false;
        }
    }

    function verify_code($id,$code){
        $this->db->select('*');
        $this->db->from('towns');
        $this->db->where('id !=',$id);
        $this->db->where('code',$code);
        $query = $this -> db -> get();
        if($query -> num_rows() > 0){
            if(empty($code))
                return false;
            return true;
        }else{
            return false;
        }
    }

    function add_town($town,$code,$region_id){
        $data =  array(
            'name'=>ucwords($town),
            'region_id'=>$region_id,
            'code'=>strtoupper($code)
        );

        $this->db->insert('towns',$data);
        $num_insert = $this->db->affected_rows();
        if($num_insert>0){
            return true;
        }
        return false;
    }

    function update_town($id,$town,$code,$region_id){

        $data =  array(
            'name'=>ucwords($town),
            'region_id'=>$region_id,
            'code'=>strtoupper($code)
        );
        $this->db->set('modified','NOW()',false);
        $this->db->where('id', $id);
        $query= $this->db->update('towns',$data);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function get_towns_by_region($region){
        $this->db->select('id,name');
        $this->db->where('region_id',$region);
        $this->db->from('towns');
        $query = $this -> db -> get();
        if ($query->num_rows()){
            foreach ($query->result() as $town) {
                $cities[$town->id] = $town->name;
            }
            return $cities;
        }else{
            return false;
        }
    }




}