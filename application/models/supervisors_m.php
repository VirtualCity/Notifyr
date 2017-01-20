<?php
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 10/6/2014
 * Time: 10:12 AM
 */

class Supervisors_m extends CI_Model{

    function save_supervisor($name,$mobile,$email,$division){

        $data =  array(
            'name'=>$name,
            'mobile'=>$mobile,
            'email'=>$email,
            'division'=>$division
        );

        $this->db->insert('supervisors',$data);
        $num_insert = $this->db->affected_rows();
        if($num_insert>0){
            return true;
        }else{
            return false;
        }
    }

    function add_supervisor($name,$mobile,$email,$division,$region_id,$town_id){

        $data =  array(
            'name'=>$name,
            'mobile'=>$mobile,
            'email'=>$email,
            'division'=>$division
        );

        $this->db->insert('supervisors',$data);
        $insert_id = $this->db->insert_id();

        if($insert_id){
            $data2 = array(
                'supervisor_id'=>$insert_id,
                'region_id'=>$region_id,
                'town_id'=>$town_id
            );
            $this->db->insert('supervisors_towns',$data2);
            $num_insert = $this->db->affected_rows();
            if($num_insert>0){
                return true;
            }
            return false;
        }else{
            return false;
        }

    }

    function add_supervisor_to_town($supervisor_id,$town_id,$region_id){

        $data =  array(
            'region_id'=>$region_id,
            'town_id'=>&$town_id,
            'supervisor_id'=>$supervisor_id
        );

        $this->db->insert('supervisors_towns',$data);
        $num_insert = $this->db->affected_rows();
        if($num_insert>0){
            return true;
        }
        return false;
    }

   /* function assign_supervisor_to_town($supervisor_id,$town_id,$region_id){

        $data =  array(
            'region_id'=>$region_id,
            'town_id'=>&$town_id,
            'supervisor_id'=>$supervisor_id
        );

        $this->db->insert('supervisors_towns',$data);
        $num_insert = $this->db->affected_rows();
        if($num_insert>0){
            return true;
        }
        return false;
    }*/

    /*Retrieve a supervisor with specified id*/
    function get_supervisor($id){
        $this->db->select('*');
        $this->db->from('supervisors');
        $this->db->where('id',$id);
        $query = $this -> db -> get();

        if($query -> num_rows() === 1){
            return $query -> row();
        }else{
            return false;
        }
    }

    /*Retrieve a supervisor with specified id*/
    function get_supervisor_by_email($email){
        $this->db->select('*');
        $this->db->from('supervisors');
        $this->db->where('email',$email);
        $query = $this -> db -> get();

        if($query -> num_rows() === 1){
            return $query -> row();
        }else{
            return false;
        }
    }

    /*Check supervisor name doesnt exists*/
    function check_supervisor_name($name){
        $this->db->select('*');
        $this->db->from('supervisors');
        $this->db->where('name',$name);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    /*Check supervisor mobile doesnt exists*/
    function check_supervisor_mobile($mobile){
        $this->db->select('*');
        $this->db->from('supervisors');
        $this->db->where('mobile',$mobile);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    /*Check supervisor mobile doesnt exists*/
    function check_supervisor_email($email){
        $this->db->select('*');
        $this->db->from('supervisors');
        $this->db->where('email',$email);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    /*Verify supervisor name doesnt exists apart from current supervisor being edited*/
    function verify_supervisor_name($id,$name){
        $this->db->select('*');
        $this->db->from('supervisors');
        $this->db->where('id !=',$id);
        $this->db->where('name',$name);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    /*Verify supervisor mobile doesnt exists apart from current supervisor being edited*/
    function verify_supervisor_mobile($id,$mobile){
        $this->db->select('*');
        $this->db->from('supervisors');
        $this->db->where('id !=',$id);
        $this->db->where('mobile',$mobile);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    /*Verify supervisor email doesnt exists apart from current supervisor being edited*/
    function verify_supervisor_email($id,$email){
        $this->db->select('*');
        $this->db->from('supervisors');
        $this->db->where('id !=',$id);
        $this->db->where('mobile',$email);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function update_supervisor($id,$name,$mobile,$email,$division){
        $data =  array(
            'name'=>$name,
            'mobile'=>$mobile,
            'email'=>$email,
            'division'=>$division
        );
        $this->db->set('modified','NOW()',false);
        $this->db->where('id', $id);
        $query = $this->db->update('supervisors', $data);

        if($query){
            return true;
        }else{
            return false;
        }
    }

    /*Retrieve all supervisor */
    function get_all_supervisors(){
        $this->db->select('*');
        $this->db->from('supervisors');
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return $query-> result();
        }else{
            return false;
        }
    }

    /*Retrieve all supervisor */
    function get_supervisor_by_townID($town_id){
        
        $this->db->select('supervisors.id AS id,supervisors.name as name,supervisors.mobile as mobile,supervisors.email as email,supervisors.division as division, supervisors.modified As modified,supervisors.created As created');
        $this->db->from('supervisors_towns');
        $this->db->join('supervisors', 'supervisors_towns.supervisor_id = supervisors.id');
        $this->db->where('supervisors_towns.town_id',$town_id);

        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return $query-> result();
        }else{
            return false;
        }
    }

    /*Retrieve all supervisor */
    function get_supervisorsNotInTownID($town_id){
        //Select from table 1 where some column in table 1 does not exist in table two
        $query =  $this->db->query('select * from supervisors WHERE NOT EXISTS ( SELECT * FROM supervisors_towns WHERE supervisors.id = supervisors_towns.supervisor_id AND supervisors_towns.town_id = '.$town_id.')');

        if($query -> num_rows() > 0){
            return $query-> result();
        }else{
            return false;
        }
    }

    function remove_supervisor_from_town($id,$town_id){
        $this->db->where('supervisor_id',$id);
        $this->db->where('town_id',$town_id);
        $query = $this->db->delete('supervisors_towns');

        if($query){
            return true;
        }
        return false;
    }

    function delete_supervisor_from_towns($id){
        $this->db->Where('supervisor_id',$id);
        $query = $this->db->delete('supervisors_towns');
        if($query){
            return true;
        }
        return false;
    }

    function check_supervisor_in_town($supervisor_id,$town_id){
        $this->db->select('*');
        $this->db->from('supervisors_towns');
        $this->db->where('town_id',$town_id);
        $this->db->where('supervisor_id',$supervisor_id);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function delete_supervisor($id){
        $this->delete_supervisor_from_towns($id);
        $this->db->Where('id',$id);
        $query = $this->db->delete('supervisors');
        if($query){
            return true;
        }
        return false;
    }

}