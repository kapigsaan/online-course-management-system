<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_messages Extends CI_Model
{
	/*============================
		PROCESS CONTENT
	==============================*/


  	public function get_all_messages()
	{
		$query = "SELECT *
				  FROM messages
				  ORDER BY created_at
				  ";
		$q = $this->db->query($query);
		return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
	}

	public function get_my_messages($id)
	{
		$query = "SELECT m.*, s.l_name, s.f_name
				  FROM messages m
				  LEFT JOIN students s ON m.
				  WHERE `to` = ?
				  OR `from` = ?
				  ORDER BY created_at
				  ";
		$q = $this->db->query($query,[$id, $id]);
		return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
	}

	public function get_conversation($id)
	{
		$query = "SELECT *
				  FROM messages
				  WHERE `id` = ?
				  ORDER BY created_at
				  ";
		$q = $this->db->query($query,[$id]);
		return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
	}

	public function get_forums_in($class=FALSE)
	{
		if ($class) {
			$query = "SELECT f.*, u.username
					  FROM forum_topics f
					  LEFT JOIN useraccounts u ON f.created_by = u.acid
					  WHERE f.class_id = ?
					  ";
			$q = $this->db->query($query,array($class));
			return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
		}else{
			return FALSE;
		}
	}

	public function get_comments_in($id=FALSE)
	{
		if ($id) {
			$query = "SELECT f.*, u.username, u.type
					  FROM forum_comments f
					  LEFT JOIN useraccounts u ON f.comment_by = u.acid
					  WHERE forum_id = ?
					  ";
			$q = $this->db->query($query,array($id));
			return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
		}else{
			return FALSE;
		}
	}

	/**
	* send_message
	* Save the data
	* @param $post - array of the data to be saved
	* @return TRUE if a record is added
	* @return FALSE if it failed to saved
	*------------------------------------------------------------------
	*/
	public function send_message($post=FALSE)
	{
		if($post){
			$post['created_at'] = NOW;
			$this->db->insert('messages',$post);

			return $this->db->affected_rows() >= 1 ? TRUE : FALSE;

		}else{
			return FALSE; 
		}
	}

	public function add_comment($post=FALSE)
	{
		if($post){
			$post['created_at'] = NOW;
			$this->db->insert('forum_comments',$post);

			return $this->db->affected_rows() >= 1 ? TRUE : FALSE;

		}else{
			return FALSE; 
		}
	}
  
  public function edit_forum($data = FALSE, $id = FALSE)
  {
    if ($id) {
		$data['updated_at'] = NOW;
		$this->db->where('id',$id);
		$this->db->update('forum_topics',$data);
      
		return $this->db->affected_rows() >= 1 ? TRUE : FALSE;      
	}else{
		return FALSE;
	}
  }
  
  /**
   * delete_message
   * Delete the record of the id being passed
   * @param $post_id - id to be deleted
   * @return TRUE if successfully deleted
   * @return FALSE if it fails to delete
   *------------------------------------------------------------------
   */
  public function delete_message($post_id=FALSE)
	{
		$this->db->delete('messages', array('id' => $post_id)); 

		return $this->db->affected_rows() >= 1 ? TRUE : FALSE;
	}

}