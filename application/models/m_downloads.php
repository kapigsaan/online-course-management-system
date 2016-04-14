<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_downloads Extends CI_Model
{
	/*============================
		PROCESS BANNER
	==============================*/

	public function get_every_pdf()
	{
		$query = "SELECT *
				FROM
				downloads
				ORDER BY file_id DESC
				";
		$q = $this->db->query($query);

		return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
	}

	public function get_syllabus_in($class)
	{
		if ($class) {
			$query = "SELECT *
				FROM syllabus
				WHERE class_id = ?
				
				ORDER BY caption
				";
			$q = $this->db->query($query, [$class]);
			
			return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
		}
	}

	public function get_syllabus_in_where($class)
	{
		if ($class) {
			$query = "SELECT *
				FROM syllabus
				WHERE class_id = ?
				AND status = 'active' 
				ORDER BY caption
				";
			$q = $this->db->query($query, [$class]);
			
			return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
		}
	}

	public function upload_syllabus($post)
	{
		if ($post) {
			$post['created_at']= NOW;

			$this->db->insert('syllabus',$post);

			return $this->db->affected_rows()>=1?TRUE:FALSE; 
		}else{
			return FALSE;
		}
	}

	public function get_course_content_in($class)
	{
		if ($class) {
			$query = "SELECT *
				FROM course_content
				WHERE class_id = ?
				 
				ORDER BY caption
				";
			$q = $this->db->query($query, [$class]);
			
			return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
		}
	}

	public function get_course_content_in_where($class)
	{
		if ($class) {
			$query = "SELECT *
				FROM course_content
				WHERE class_id = ?
				AND status = 'active' 
				ORDER BY caption
				";
			$q = $this->db->query($query, [$class]);
			
			return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
		}
	}

	public function get_course_outline_in($class)
	{
		if ($class) {
			$query = "SELECT *
				FROM course_outline
				WHERE class_id = ?
				 
				ORDER BY caption
				";
			$q = $this->db->query($query, [$class]);
			
			return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
		}
	}

	public function get_course_outline_in_where($class)
	{
		if ($class) {
			$query = "SELECT *
				FROM course_outline
				WHERE class_id = ?
				AND status = 'active' 
				ORDER BY caption
				";
			$q = $this->db->query($query, [$class]);
			
			return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
		}
	}

	public function get_images_in($class)
	{
		if ($class) {
			$query = "SELECT *
				FROM course_images
				WHERE class_id = ?
				 
				ORDER BY caption
				";
			$q = $this->db->query($query, [$class]);
			
			return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
		}
	}

	public function get_images_in_where($class)
	{
		if ($class) {
			$query = "SELECT *
				FROM course_images
				WHERE class_id = ?
				AND status = 'active' 
				ORDER BY caption
				";
			$q = $this->db->query($query, [$class]);
			
			return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
		}
	}

	public function upload_image($post)
	{
		if ($post) {
			$post['created_at']= NOW;

			$this->db->insert('course_images',$post);

			return $this->db->affected_rows()>=1?TRUE:FALSE; 
		}else{
			return FALSE;
		}
	}

	public function upload_content($post)
	{
		if ($post) {
			$post['created_at']= NOW;

			$this->db->insert('course_content',$post);

			return $this->db->affected_rows()>=1?TRUE:FALSE; 
		}else{
			return FALSE;
		}
	}

	public function upload_outline($post)
	{
		if ($post) {
			$post['created_at']= NOW;

			$this->db->insert('course_outline',$post);

			return $this->db->affected_rows()>=1?TRUE:FALSE; 
		}else{
			return FALSE;
		}
	}
  
  	public function get_syllabus($id=FALSE)
	{
		$query = "SELECT *
				  FROM
					syllabus
				  WHERE
				   id = ?";
		$q = $this->db->query($query,array($id));
		return $q->num_rows() >= 1 ? $q->row() : FALSE; //returns result if none retrieved, returns FALSE
	}

	public function get_images($id=FALSE)
	{
		$query = "SELECT *
				  FROM
					course_images
				  WHERE
				   id = ?";
		$q = $this->db->query($query,array($id));
		return $q->num_rows() >= 1 ? $q->row() : FALSE; //returns result if none retrieved, returns FALSE
	}

	public function get_content($id=FALSE)
	{
		$query = "SELECT *
				  FROM
					course_content
				  WHERE
				   id = ?";
		$q = $this->db->query($query,array($id));
		return $q->num_rows() >= 1 ? $q->row() : FALSE; //returns result if none retrieved, returns FALSE
	}

	public function get_outline($id=FALSE)
	{
		$query = "SELECT *
				  FROM
					course_outline
				  WHERE
				   id = ?";
		$q = $this->db->query($query,array($id));
		return $q->num_rows() >= 1 ? $q->row() : FALSE; //returns result if none retrieved, returns FALSE
	}

	public function delete_syllabus($id=FALSE)
	{
		if ($id) {

			$this->db->delete('syllabus', array('id' => $id)); 

			return $this->db->affected_rows() >= 1 ? TRUE : FALSE;	
		}else{
			return FALSE;
		}
	}

	public function delete_content($id=FALSE)
	{
		if ($id) {

			$this->db->delete('course_content', array('id' => $id)); 

			return $this->db->affected_rows() >= 1 ? TRUE : FALSE;	
		}else{
			return FALSE;
		}
	}

	public function delete_outline($id=FALSE)
	{
		if ($id) {

			$this->db->delete('course_outline', array('id' => $id)); 

			return $this->db->affected_rows() >= 1 ? TRUE : FALSE;	
		}else{
			return FALSE;
		}
	}

	public function delete_image($id=FALSE)
	{
		if ($id) {

			$this->db->delete('course_images', array('id' => $id)); 

			return $this->db->affected_rows() >= 1 ? TRUE : FALSE;	
		}else{
			return FALSE;
		}
	}

	public function change_status($databse = FALSE, $status = FALSE, $id = FALSE){
	    if ($id) {
	      $query="UPDATE $databse
	              SET status = ?
	              WHERE id = ?
	              ";
	      $result = $this->db->query($query, array($status,$id)); 
	      return $this->db->affected_rows()>=1 ?TRUE:FALSE; 
	    }else{
	      return FALSE;
	    }
	  }
  
}