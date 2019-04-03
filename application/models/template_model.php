<?php
class Template_model extends CI_Model {

	public function create_template($title, $template, $type) {
		$data = array('title' => ucfirst($title), 'template' => trim($template), 'type' => strtoupper($type));

		$this -> db -> insert('sms_templates', $data);
		$num_insert = $this -> db -> affected_rows();
		if ($num_insert > 0) {
			return true;
		}
		return false;
	}

	function update_template($id, $title, $template, $type) {

		$data = array('title' => ucfirst($title), 'template' => trim($template), 'type' => strtoupper($type));

		$this -> db -> set('modified', 'NOW()', false);
		$this -> db -> where('id', $id);
		$query = $this -> db -> update('sms_templates', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	function get_all_templates() {
		$this -> db -> select('*');
		$this -> db -> from('sms_templates');
		$this -> db -> order_by('title');

		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query -> result();
		} else {
			return false;
		}
	}

	function get_template($id) {
		$this -> db -> select('*');
		$this -> db -> from('sms_templates');
		$this -> db -> where('id', $id);
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return $query -> row();
		} else {
			return false;
		}
	}

}
