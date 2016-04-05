<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_profile extends CI_Model 
{
	public function get_profiles()
	{
		$sql = "SELECT * FROM profiles";
		$query = $this->db->query($sql);
		return $query->num_rows() > 0 ? $query->row() : FALSE;
	}
  
  public function insert_profile($data)
	{
		if($data)
		{
			$this->db->insert('profiles', $data);
			return $this->db->affected_rows() > 0 ? TRUE : FALSE;
		}else{
			return FALSE;
		}
	}
  
  public function clear_setting()
	{
		$this->db->truncate('profiles'); 
	}

	public function delete_logo()
	{
		$data['website'] = "";
		$this->db->update('profiles', $data);

		return $this->db->affected_rows() > 0 ? TRUE : FALSE;
	}
}
?>