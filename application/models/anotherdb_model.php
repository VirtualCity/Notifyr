<?php
 
if(!defined('BASEPATH')) exit('No direct script access allowed');
 
class Anotherdb_model extends CI_Model
{
  private $another;
  function __construct()
  {
    parent::__construct();
    $this->another = $this->load->database('sqldb',TRUE);
  }
 
  public function getAllUsers()
  {
    $this->another->select('*');
    $q = $this->another->get('users');
    if($q->num_rows()>0)
    {
      foreach($q->result() as $row)
      {
        $data[] = $row;
      }
      return $data;
    }
    else
    {
      return FALSE;
    }
  }
}