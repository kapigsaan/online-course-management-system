<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_yvideos Extends CI_Model
{
  public function get_every_yv($class)
	{
		$query = "SELECT *
				  FROM
					yvideos
					WHERE class_id = ?
          ORDER BY id DESC";
		$q = $this->db->query($query,[$class]);
		return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
	}

	public function get_every_yv_where($class)
	{
		$query = "SELECT *
				  FROM
					yvideos
					WHERE class_id = ?
				AND status = 'active' 
          ORDER BY id DESC";
		$q = $this->db->query($query,[$class]);
		return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
	}
  
  public function get_yv($id=FALSE)
	{
    if($id){
    $query = "SELECT *
				  FROM
					yvideos
          WHERE id = ?
          ";
		$q = $this->db->query($query,array($id));
    }else{
		$query = "SELECT *
				  FROM
					yvideos
          ORDER BY id DESC
          LIMIT 1";
		$q = $this->db->query($query);
    }
		return $q->num_rows() >= 1 ? $q->row() : FALSE; //returns result if none retrieved, returns FALSE
	}
  public function get_yv_except($id)
	{
		$query = "SELECT *
				  FROM
					yvideos
          WHERE id != ?
          ORDER BY id DESC
          ";
		$q = $this->db->query($query,array($id));
		return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
	}
  
  public function process_add_yv($post)
	{
		$post['created_at']= NOW;
		$this->db->insert('yvideos',$post);

		return $this->db->affected_rows()>=1?TRUE:FALSE; 
	}
  
  public function process_del_yv($post_id=FALSE)
	{
		$this->db->delete('yvideos', array('id' => $post_id)); 

		return $this->db->affected_rows() >= 1 ? TRUE : FALSE;
	}
}