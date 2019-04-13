<?php
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 7/18/14
 * Time: 4:35 PM
 */

class User_model extends CI_Model{
    function get_active_location_managers(){
        $this -> db-> select('*');
        $this -> db -> from('users');
        $this -> db -> where('role','LOCATION_MANAGER');
        $this -> db -> where('status','ACTIVE');
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return $query -> result();
        }else{
            return false;
        }
    }

    function check_username($username){
        $this -> db-> select('username');
        $this -> db -> from('users');
        $this -> db -> where('username',$username);
        $dbuser = $this -> db -> get()->result();

        // The results of the query are stored in $dbuser.
        // If a value exists, then the user account exists and is validated
        if ( is_array($dbuser) && count($dbuser) == 1 ) {
            return true;
        }
        return false;
    }
	
	function check_user_status($username){
        $this -> db-> select('username');
        $this -> db -> from('users');
        $this -> db -> where('username',$username);
		$this-> db-> where('status','Active');
        $dbuser = $this -> db -> get()->result();

        // The results of the query are stored in $dbuser.
        // If a value exists, then the user account exists and is validated
        if ( is_array($dbuser) && count($dbuser) == 1 ) {
            return true;
        }
        return false;
    }

    function compare_password($username,$password){
       // echo("password compare called");
        $this -> db-> select('*');
        $this -> db -> from('users');
        $this -> db -> where('username',$username);
        $dbuser = $this -> db -> get();


        if($dbuser->num_rows()>0){
            $row = $dbuser->row();

            $dbpassword = $row->password;


            //Echo retrieved password
           // echo($dbpassword);

            //decrypting retrieved password
            $plaintext_password = $this->encrypt->decode($dbpassword);
          //  echo($plaintext_password);

            //Compare passwords
            if($plaintext_password === $password){
                $id = $row->id;
                $fname = $row->fname;
                $sname = $row->surname;
                $oname = $row->oname;
                $role = $row->role;
                $code = $row->code;
                $status = $row->status;
                $factory = $row->factory_id;

                $userinfo = array(
                    'id' => $id,
                    'fname' => $fname,
                    'sname' => $sname,
                    'oname' => $oname,
                    'role' => $role,
                    'code' => $code,
                    'status' => $status,
                    'logged_in' => TRUE,
                    'factory' => $factory
                );

                return $userinfo;
            }
        }

        return false;
    }


    function get_active_users(){
        $this->db->select('users.id, users.username,users.password,users.fname,users.surname,users.oname,users.mobile,users.email,users.role,factories.name as factory,users.code,users.status,users.modified,created');
        $this->db->from('users');
        $this->db->join('factories','factories.id=users.factory_id');

        // $this -> db-> select('*');
        // $this -> db -> from('users');
        $this -> db -> where('users.status','Active');
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return $query -> result();
        }else{
            return false;
        }
    }

    function get_active_users_by_factory(){

        $this->db->select('users.id, users.username,users.password,users.fname,users.surname,users.oname,users.mobile,users.email,users.role,factories.name,users.code,users.status,users.modified,created');
        $this->db->from('users');
        $this->db->join('factories','factories.id=users.factory_id');

        // $this -> db-> select('*');
        // $this -> db -> from('users');
        $this -> db -> where('status','Active');
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return $query -> result();
        }else{
            return false;
        }
    }

    function get_suspended_users(){
        $this -> db-> select('*');
        $this -> db -> from('users');
        $this -> db -> where('status','Suspended');
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return $query -> result();
        }else{
            return false;
        }
    }

    function suspend_user($id){
        $data = array(
            'status' => 'Suspended'
        );
        $this->db->where('id', $id);
        $query = $this->db->update('users', $data);

        if($query){
            return true;
        }else{
            return false;
        }
    }

    function activate_user($id){
        $data = array('status' => 'Active');
        $this -> db -> where('id',$id);
        $query = $this->db->update('users', $data);

        if($query){
            return true;
        }else{
            return false;
        }
    }

    


    function add_user($fname,$sname,$oname,$email,$mobile,$username,$user_role,$password,$status,$factory){

        $encrypted_string = $this->encrypt->encode($password);
        $data =  array(
            'fname'=>$fname,
            'surname'=>$sname,
            'oname'=>$oname,
            'email'=>$email,
            'mobile'=>$mobile,
            'username'=>$username,
            'role'=>$user_role,
            'factory_id'=>$factory,
            'password'=>$encrypted_string,
            'status'=>$status);
            // return $data;
        $this->db->insert('users',$data);
        $num_insert = $this->db->affected_rows();
        if($num_insert>0){
            return true;
        }
        return false;
    }

    function getPassword($pass){
        $this -> db-> select('password');
        $this -> db -> from('users');
        $this -> db -> where('username',$pass);
        $this -> db -> limit(1);

        $query = $this -> db -> get();

        if($query -> num_rows() == 1){
            return $query -> result();
        }else{
            return false;
        }
    }

    function getUserProfile($id){
        $this -> db-> select('*');
        $this -> db -> from('users');
        $this -> db -> where('id',$id);
        $this -> db -> limit(1);

        $query = $this -> db -> get();

        if($query -> num_rows() == 1){
            return $query->row();
        }else{
            return false;
        }
    }

    function checkPassword($id,$pass){
        $this -> db-> select('*');
        $this -> db -> from('users');
        $this -> db -> where('id',$id);
        $this -> db -> limit(1);

        $query = $this -> db -> get();

        if($query -> num_rows() == 1){
            $dbpassword = $query -> row()->password;
            $plaintext_password = $this->encrypt->decode($dbpassword);

            if($pass=== $plaintext_password){
                return true;
            }else{
                return false;
            }

        }else{
            return false;
        }
    }

    function save_password($id,$password){

        //Encrypt Password
        $encrypted_pass = $this->encrypt->encode($password);

        $data = array('password' => $encrypted_pass);
        $this -> db -> where('id',$id);
        $query = $this->db->update('users', $data);

        if($query){
            return true;
        }else{
            return false;
        }

    }
}