<?php
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 10/6/2014
 * Time: 10:12 AM
 */

class Products_m extends CI_Model{

    function add_product($code,$name,$description){

        $data =  array(
            'code'=>$code,
            'name'=>$name,
            'description'=>$description
        );
        $this->db->set('created', 'NOW()', FALSE);
        $this->db->insert('products',$data);
        $num_insert = $this->db->affected_rows();
        if($num_insert>0){
            return true;
        }
        return false;
    }

    /*Retrieve a product with specified id*/
    function get_product($id){
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('id',$id);
        $query = $this -> db -> get();

        if($query -> num_rows() === 1){
            return $query -> row();
        }else{
            return false;
        }
    }

    /*Verify code doesnt exists apart from current product being edited*/
    function verify_code($id,$code){
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('id !=',$id);
        $this->db->where('code',$code);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    /* Check if name exists*/
    function check_name($name){
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('name',$name);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    /* Check if name exists*/
    function check_description($description){
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('description',$description);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    /* Check if code exists*/
    function check_code($code){
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('code',$code);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    /*Verify product code doesnt exists apart from current product being edited*/
    function verify_product_description($id,$description){
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('id !=',$id);
        $this->db->where('description',$description);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    //Verify item code if it exists other than edited record
    function verify_name($id,$name){
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('id !=',$id);
        $this->db->where('name',$name);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function update_product($id,$code,$name,$description){
        $data = array(
            'code'=>$code,
            'name'=>$name,
            'description'=>$description
        );
        $this->db->where('id', $id);
        $query = $this->db->update('products', $data);

        if($query){
            return true;
        }else{
            return false;
        }
    }

    function delete_product($id){
        $data = array(
            'status'=>'SUSPENDED'
        );
        $this->db->where('id', $id);
        // $query = $this->db->update('products', $data);
        $query = $this->db->delete('products');

        if($query){
            return true;
        }else{
            return false;
        }
    }

    function truncate_product(){
        $this->db->from('products'); 
        $query = $this->db->truncate();
        if($query){
            return true;
        }else{
            return false;
        }
        // $this->db->truncate('products');
    }
}