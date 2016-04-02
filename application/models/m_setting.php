<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_setting extends CI_Model 
{
	
	private $last_insert_id;
	
	public function get_inquiry_email()
	{
		$sql = "SELECT * FROM settings";
		$query = $this->db->query($sql);
		return $query->num_rows() > 0 ? $query->row()->inq_email : FALSE;
	}
	
	public function insert_setting($data)
	{
		if($data)
		{
			$this->db->insert('settings', $data);
			return $this->db->affected_rows() > 0 ? TRUE : FALSE;
		}else{
			return FALSE;
		}
		
	}
	
	public function clear_setting()
	{
		$this->db->truncate('settings'); 
	}
	
	public function get_setting_inq()
	{
		$sql = "SELECT inq_email FROM settings";
		$query = $this->db->query($sql);
		return $query->num_rows() > 0 ? $query->row() : FALSE;
	}
  
  public function get_settings()
	{
		$sql = "SELECT * FROM settings";
		$query = $this->db->query($sql);
		return $query->num_rows() > 0 ? $query->row() : FALSE;
	}
}
?>