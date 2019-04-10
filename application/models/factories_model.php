<?php
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 8/1/14
 * Time: 1:07 AM
 */

class Factories_model extends CI_Model{
    function get_all_factories(){
        $this->db->select('*');
        $this->db->from('factories');
        $query = $this -> db -> get();
        if ($query->num_rows() > 0){
            return $query -> result();
        }else{
            return false;
        }
    }

    function get_all_factories_balance(){
        $this->db->select('factories.id AS id,factories.name AS factoryName,factories.code as factoryCode, factories.apiKey as apiKey,factories.senderId as senderid,regions.name AS region, factories.updated AS modified,factories.created AS created');
        $this->db->from('factories');
        $this->db->join('regions','factories.region_id = regions.id');
        $query = $this -> db -> get();
        if ($query->num_rows() > 0){
            return $query -> result();
        }else{
            return false;
        }
    }

    function get_all_factories_and_balance_settings(){
        $this->db->select('factories.id AS id,factories.name AS factoryName,factories.code as factoryCode, settings.value2 as apiKey,settings.value9 as username,factories.senderId as senderid,regions.name AS region, factories.updated AS modified,factories.created AS created');
        $this->db->from('factories');
        $this->db->join('regions','factories.region_id = regions.id');
        $this->db->join('settings','factories.id = settings.factory_id');
        $this->db->where('settings.title','CONFIGURATION');
        $query = $this -> db -> get();
        if ($query->num_rows() > 0){
            return $query -> result();
        }else{
            return false;
        }
    }

    function get_factory($id){
        $this->db->select('*');
        $this->db->from('factories');
        $this->db->where('id',$id);
        $query = $this -> db -> get();
        if($query -> num_rows() > 0){
            // return $query -> row();
            return $query -> result();
        }else{
            return false;
        }
    }

    function check_factory($factory_name){
        $this->db->select('*');
        $this->db->from('factories');
        $this->db->where('name',$town_name);
        $query = $this -> db -> get();
        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function get_factory_by_name($factory_name,$regionId){
        $this->db->select('*');
        $this->db->from('factories');
        $this->db->where('name',$factory_name);
        $this->db->where('region_id',$regionId);
        $query = $this -> db -> get();
        if($query -> num_rows() > 0){
            return $query -> row();
        }else{
            return false;
        }
    }


    function check_factory_region($factory_name, $region_id){
        $this->db->select('*');
        $this->db->from('factories');
        $this->db->where('name',$town_name);
        $this->db->where('region_id',$region_id);
        $query = $this -> db -> get();
        if($query -> num_rows() > 0){
            return $query -> row();
        }else{
            return false;
        }
    }

    function verify_factory($id,$name){
        $this->db->select('*');
        $this->db->from('factories');
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
        $this->db->from('factories');
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
        $this->db->from('factories');
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

    function add_factory($factory_name,$code,$region_id,$senderid,$key){
        $data =  array(
            'name'=>ucwords($factory_name),
            'senderId'=>$senderid,
            'apiKey'=>$key,
            'region_id'=>$region_id,
            'code'=>strtoupper($code)
        );
        $this->db->insert('factories',$data);
        $num_insert = $this->db->affected_rows();
        if($num_insert>0){
            return true;
        }
        return false;
    }

    function update_factory($id,$factory_name,$code,$region_id,$senderid,$key){
        $date = date('Y-m-d H:i:s');
        $data =  array(
            'name'=>ucwords($factory_name),
            'senderId'=>$senderid,
            'apiKey'=>$key,
            'region_id'=>$region_id,
            'code'=>strtoupper($code),
            'updated'=>$date
        );
        // $this->db->set('updated','NOW()',false);
        $this->db->where('id', $id);
        $query= $this->db->update('factories',$data);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function get_factories_by_regionId($region){
        $this->db->select('id,name');
        $this->db->where('region_id',$region);
        $this->db->from('factories');
        $query = $this -> db -> get();
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    function get_factory_by_region($region){
        $this->db->select('id,name');
        $this->db->where('region_id',$region);
        $this->db->from('factories');
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