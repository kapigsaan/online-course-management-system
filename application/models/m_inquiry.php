<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_inquiry Extends CI_Model
{
	protected $__table = 'inquiry';

	//Insert Data
	public function insert_inquiry($data=FALSE)
	{
		if ($data) {
			$data['inquired_at'] = NOW;
			$this->db->insert('inquiry', $data);
			$insert_id = $this->db->insert_id();			
			
			if($this->db->affected_rows() >= 1){
				$result['status'] = TRUE;
				$result['insert_id'] = $insert_id;
			}else{
				$result['status'] = FALSE;
			}

			return $result;
		}else{
			return FALSE;
		}
	}
	
	public function get_inquiry($id=FALSE, $limit = false, $page = false) 
	{
		if ($id==FALSE) 
		{	
			if($limit)
			{	
				$query="
					SELECT *
					FROM inquiry
					ORDER BY inquiry_id DESC
					LIMIT {$page}, {$limit}";
				$q = $this->db->query($query);
				return $q->num_rows() >= 1 ? $q->result() : FALSE;
			}else{
				$query="
					SELECT *
					FROM inquiry
					ORDER BY inquiry_id DESC
					";
				$q = $this->db->query($query);
				return $q->num_rows() >= 1 ? $q->result() : FALSE;
			}
		}else{
			$query="SELECT * FROM inquiry WHERE inquiry_id = ?";
			$q = $this->db->query($query,array($id));
			return $q->num_rows() >= 1 ? $q->row()  :FALSE;
		}
	}
	
	public function process_del_inquiry($id=FALSE)
	{
		$this->db->delete($this->__table, array('inquiry_id' => $id));
		return $this->db->affected_rows() > 0 ? TRUE : FALSE;
	}
	
	public function search_inquiry($data)
	{
		if($data) 
		{
			$query="SELECT *
			FROM inquiry
			WHERE name LIKE ?
			OR email LIKE ?
			OR contact_number LIKE ?
			OR inquired_at LIKE ?
			ORDER BY name, email, contact_number, inquired_at
			";

			$result = $this->db->query($query, array('%'.$data.'%', '%'.$data.'%', '%'.$data.'%', '%'.$data.'%', '%'.$data.'%')); 
			return $result->num_rows()>=1 ? $result->result():FALSE; 
		}else{
			return FALSE;
		}
	}
	
	public function set_to_read($x=FALSE)
	{
		if($x)
		{
			$data['new'] = 'no';
			$this->db->where('inquiry_id', $x);
			$this->db->update('inquiry', $data); 
      return $this->db->affected_rows() > 0 ? TRUE : FALSE;
		}
	}

	public function get_no_inquiries()
	{
		return $this->db->count_all('inquiry');
	}
	
	public function get_new_inquiries()
	{
		$this->db->where('new', 'yes');
		$this->db->from('inquiry');
		return $this->db->count_all_results();
	}
}