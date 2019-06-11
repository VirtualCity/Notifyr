<?php
/**
 * Created by PhpStorm.
 * User: Bethuel
 * Date: 8/1/14
 * Time: 1:07 AM
 */

class Groups_model extends CI_Model
{

    function get_all_groups()
    {
        $this->db->select('*');
        $this->db->from('groups');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_groups_except_stockist()
    {
        $this->db->select('*');
        $this->db->from('groups');
        $this->db->where('name != ', 'Stockists');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_group_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('groups');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function get_group_by_type($id)
    {
        $this->db->select('*');
        $this->db->from('groups');
        $this->db->where('type', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_group_by_factory($id)
    {
        $this->db->select('*');
        $this->db->from('groups');
        $this->db->where('factory_id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_group_by_name($name)
    {
        $this->db->select('*');
        $this->db->from('groups');
        $this->db->where('name', $name);
        $query = $this->db->get();
        if ($query->num_rows() === 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    function verify_group($id, $name)
    {
        $this->db->select('*');
        $this->db->from('groups');
        $this->db->where('id !=', $id);
        $this->db->where('name', $name);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function check_group_name($name)
    {
        $this->db->select('*');
        $this->db->from('groups');
        $this->db->where('name', $name);
        $query = $this->db->get();
        if ($query->num_rows() === 1) {
            return true;
        } else {
            return false;
        }
    }

    function add_group($group, $type, $description,$factory)
    {

        $data = array(
            'name' => $group,
            'type' => $type,
            'description' => $description,
            'factory_id' => $factory
        );
        $this->db->insert('groups', $data);
        $num_insert = $this->db->affected_rows();
        if ($num_insert > 0) {
            return true;
        }
        return false;
    }

    function update_group($id, $group, $type, $description)
    {
        $data = array(
            'name' => ucfirst($group),
            'type' => $type,
            'description' => $description
        );
        $this->db->set('modified', 'NOW()', false);
        $this->db->where('id', $id);
        $query = $this->db->update('groups', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    function get_group_contacts($grp_id)
    {
        $this->db->select('*');
        $this->db->from('group_contacts');
        $this->db->where('groupid', $grp_id);
        $this->db->join('groups', 'group_contacts.groupid = groups.id');
        $this->db->order_by("group_contacts.created", "desc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function update_group_contact_msisdn($cur_msisdn, $up_msisdn)
    {
        $this->db->where('msisdn', $cur_msisdn);
        $query = $this->db->update('group_contacts', ['msisdn' => $up_msisdn]);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
}