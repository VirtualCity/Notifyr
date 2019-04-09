<?php
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 8/1/14
 * Time: 1:53 AM
 */

class Contacts_model extends CI_Model{
    function get_contact($id){
        $this->db->select('*');
        $this->db->from('contacts');
        $this->db->where('id',$id);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return $query -> row();
        }else{
            return false;
        }
    }

    function get_contact_by_msisdn($msisdn){
        $this->db->select('contacts.name as name,id_number,email,address,towns.name as town, msisdn, regions.name as region, contacts.factory_id as factory');
        $this->db->from('contacts');
        $this->db->where('msisdn',$msisdn);
        $this->db->join('towns','contacts.town_id = towns.id');
        $this->db->join('regions','contacts.region_id = regions.id');
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            // return $query -> row();
            return $query -> result();
        }else{
            return false;
        }
    }



    function get_all_contacts(){
        $query = $this->db->get('contacts');

        if ($query->num_rows() > 0){
            foreach($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    function get_group_contacts($group){
        $this->db->select('msisdn');
        $this->db->from('group_contacts');
        $this->db->where('groupid',$group);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return $query -> result();
        }else{
            return false;
        }

    }

    function get_subgroup_contacts($group){
        $this->db->select('group_contacts.msisdn AS msisdn,contacts.name as name')
        ->from('group_contacts LEFT JOIN contacts USING (msisdn)')
        ->where('group_contacts.groupid',$group);


        // $this->db->select('id,msisdn');
        // $this->db->from('group_contacts');
        // $this->db->where('groupid',$group);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return $query -> result();
        }else{
            return false;
        }

    }

    function add_group_contacts($group,$msisdn,$name,$idno,$email,$address,$region_id,$town_id,$factory){
        log_message("info","Adding to SMS groups");
        $groupid = $this->get_groupid($group);

        if($groupid){

            $id = $groupid->id;
            log_message("info","Group id found ".$id);

            //Check if user exists for that group
            $contact_exists = $this->check_subscribed_contact($id,$msisdn);

            if(!$contact_exists){
                $data =  array(
                    'msisdn'=>$msisdn,
                    'groupid'=>$id
                );

                $this->db->insert('group_contacts',$data);
                $num_insert = $this->db->affected_rows();
                if($num_insert>0){
                    $sourceKeyword ="";
                    $unsub="";
                    $configurationData = $this->get_configuration();
                    if($configurationData){
                        $sourceKeyword = $configurationData->value4;
                        $unsub = $configurationData->value7;
                    }

                    $responseMsg='You have subscribed to "'.$group.'" SMS group. To unsubscribe SMS "'.$sourceKeyword.' '.$unsub.' '.$group.'"';
                    log_message("info","Registration for ".$msisdn." successful ");
                    $this->create_contact($msisdn,$name,$idno,$email,$address,$region_id,$town_id,"ACTIVE",$factory,$group);
                    return $responseMsg;
                }else{
                    $responseMsg="System error. Please try again ";
                    log_message("info",$responseMsg." Failed to add Subscriber to SMS groups");
                    return $responseMsg;
                }

            }else{
                $responseMsg="You are already subscribed to ".$group;
                log_message("info",$responseMsg." Subscriber already subscribed to groups");
                return $responseMsg;
            }


        }else{
            $responseMsg="SMS group Not found. ".$group;
            log_message("info",$responseMsg." SMS group Not found. Contact cant be added to group");
            return $responseMsg;
        }

    }

    function add_contact_togroup_viaId($msisdn,$group_id){
        $data =  array(
            'msisdn'=>$msisdn,
            'groupid'=>$group_id
        );

        $this->db->insert('group_contacts',$data);
        $num_insert = $this->db->affected_rows();

        if($num_insert>0){
            return true;
        }else{
            return false;
        }
    }

    function add_contacts($msisdn){
        //Check if user exists for that group
        $contact_exists = $this->check_contact($msisdn);

        if(!$contact_exists){
            $data =  array(
                'msisdn'=>$msisdn
            );
            $this->db->set('created', 'NOW()', FALSE);
            $this->db->insert('contacts',$data);
            $num_insert = $this->db->affected_rows();
            if($num_insert>0){
               return true;
            }else{
                return false;
            }

        }else{
            log_message("info"," User already exists in contacts list");
        }
    }

    function remove_group_contact($group,$msisdn){
        log_message("info","Remove from SMS groups");
        //get group id
        $groupid = $this->get_groupid($group);

        if($groupid){
            $id = $groupid->id;
            //Check if user exists for that group
            $contact_exists = $this->check_subscribed_contact($id,$msisdn);

            if($contact_exists){
                $query=$this->db->delete('group_contacts', array('msisdn' => $msisdn, 'groupid'=>$id));

                //$this->db->affected_rows();
                if($query){
                    return "You have successfully unsubscribed from ".$group;
                }else{
                    return "System error. Please try again ";
                }
            }else{
                return "You have not subscribed to ".$group;
            }
        }else{
            log_message("info","Error group: ".$group." not found while unsubscribing");
            return "Error group: ".$group." not found";
        }

    }

    function get_groupid($group){
        $this->db->select('*');
        $this->db->from('groups');
        $this->db->where('name',$group);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return $query -> row();
        }else{
            return false;
        }
    }

    function check_subscribed_contact($groupid,$msisdn){
        $this->db->select('*');
        $this->db->from('group_contacts');
        $this->db->where('groupid',$groupid);
        $this->db->where('msisdn',$msisdn);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function check_contact($msisdn){
        $this->db->select('*');
        $this->db->from('contacts');
        $this->db->where('msisdn',$msisdn);
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function create_contact($msisdn,$name,$idno,$email,$address,$region,$town,$status,$factory,$group){
        //Check if user exists for that group
        // print($idno);
        //     return true;
        $contact_exists = $this->check_contact($msisdn);
        if(!$contact_exists){
            $data =  array(
                'msisdn'=>$msisdn,
                'name'=>$name,
                'id_number'=>$idno,
                'email'=>$email,
                'address'=>$address,
                'region_id'=>$region,
                'town_id'=>$town,
                'status'=>$status,
                'factory_id'=>$factory,
                'group_id'=>$group
            );
            // $this->db->set('created', 'NOW()', FALSE);
            $this->db->insert('contacts',$data);
            $num_insert = $this->db->affected_rows();
            if($num_insert>0){
                return true;
            }else{
                return false;
            }

        }
    }

    function edit_contact($id,$msisdn,$name,$idno,$email,$address){
        $data = array(
            'msisdn' => $msisdn,
            'name' => $name,
            'id_number'=>$idno,
            'email' => $email,
            'address' => $address,
        );
        $this->db->where('id', $id);
        $query = $this->db->update('contacts', $data);

        if($query){
            return true;
        }else{
            return false;
        }
    }

	function activate_contact($id,$msisdn){
        $this->activate_all_subscriptions($msisdn);

        $data = array('status' => 'ACTIVE');
        $this -> db -> where('id',$id);
        $query = $this->db->update('contacts', $data);

        if($query){
            return true;
        }else{
            return false;
        }
    }
	
	function activate_subscription($groupid,$msisdn){
        $data = array('subscription_status' => 'ACTIVE');
        $this -> db -> where('msisdn',$msisdn);
        $this -> db -> where('groupid',$groupid);
        $query = $this->db->update('group_contacts', $data);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function activate_all_subscriptions($msisdn){
        $data = array('subscription_status' => 'ACTIVE');
        $this -> db -> where('msisdn',$msisdn);
        $query = $this->db->update('group_contacts', $data);
        if($query){
            return true;
        }else{
            return false;
        }
    }
	
	function suspend_contact($id,$msisdn){

        $this->suspend_all_subscriptions($msisdn);

        $data = array('status' => 'SUSPENDED');
        $this -> db -> where('id',$id);
        $query = $this->db->update('contacts', $data);

        if($query){
            return true;
        }else{
            return false;
        }
    }
	
	function check_active_contact($groupid,$msisdn){
        $this->db->select('*');
        $this->db->from('group_contacts');
        $this->db->where('groupid',$groupid);
        $this->db->where('msisdn',$msisdn);
        $this->db->where('subscription_status',"ACTIVE");
        $query = $this -> db -> get();

        if($query -> num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
	
	function suspend_subscription($groupid,$msisdn){
        $data = array('subscription_status' => 'SUSPENDED');
        $this -> db -> where('msisdn',$msisdn);
        $this -> db -> where('groupid',$groupid);
        $query = $this->db->update('group_contacts', $data);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    function suspend_all_subscriptions($msisdn){
        $data = array('subscription_status' => 'SUSPENDED');
        $this -> db -> where('msisdn',$msisdn);
        $query = $this->db->update('group_contacts', $data);
        if($query){
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