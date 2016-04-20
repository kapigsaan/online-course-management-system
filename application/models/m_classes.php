<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_classes Extends CI_Model
{
	/*============================
		PROCESS CONTENT
	==============================*/
  
  /**
   * get_all_classes
   * Get all Class
   * @return array records found
   * @return FALSE if no record found
   *--------------------------------------
   */
	public function get_all_classes()
  {
    $query = "SELECT *
          FROM
          classes
          ORDER BY 
          class";
    $q = $this->db->query($query);
    
    return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
  }

  public function get_all_my_class($id = FALSE)
  {
    $query = "SELECT *
          FROM students_in_class s
          LEFT JOIN classes c ON s.class_id = s.id
          WHERE s.stud_id = ?
          ORDER BY 
          class";
    $q = $this->db->query($query, [$id]);
    
    return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
  }

  public function get_all_classes_where($id = FALSE)
  {
    $query = "SELECT *
          FROM
          classes
          WHERE created_by = ?
          ORDER BY 
          class";
    $q = $this->db->query($query, [$id]);
    
    return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
  }

  public function get_all_answers($id = FALSE)
  {
    $query = "SELECT a.*, u.l_name, u.f_name, a.created_at as subm
          FROM answers a
          LEFT JOIN useraccounts u ON a.stud_id = u.acid
          WHERE a.class_id = ?
          ORDER BY u.l_name
          ";
    $q = $this->db->query($query, [$id]);
    
    return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
  }

  public function get_all_acticities($id = FALSE)
  {
    $query = "SELECT *
          FROM
          activities
          WHERE class_id = ?
          ORDER BY 
          caption";
    $q = $this->db->query($query, [$id]);
    
    return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
  }

  public function get_all_homework($id = FALSE)
  {
    $query = "SELECT *
          FROM
          homework
          WHERE class_id = ?
          ORDER BY 
          caption";
    $q = $this->db->query($query, [$id]);
    
    return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
  }

  public function get_all_quizzes($id = FALSE)
  {
    $query = "SELECT *
          FROM
          quizzes
          WHERE class_id = ?
          ORDER BY 
          caption";
    $q = $this->db->query($query, [$id]);
    
    return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
  }

  public function get_all_class_with_instructor()
  {
    $query = "SELECT c.*, u.f_name, u.l_name, u.m_name
          FROM classes c
          LEFT JOIN useraccounts u ON c.created_by = u.acid
          ORDER BY c.class";
    $q = $this->db->query($query);
    
    return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
  }

  
  /**
   * get_class
   * Get the classes of the passed id
   * @param $id - id to be search
   * @return classes of records found
   * @return FALSE if no record found
   *--------------------------------------
   */
	public function get_class($id=FALSE)
  {
    $query = "SELECT class
          FROM
          classes
          WHERE 
          id = ?
          ";
    $q = $this->db->query($query,array($id));
    return $q->num_rows() >= 1 ? $q->row()->class : FALSE; //returns result if none retrieved, returns FALSE
  }
  
  /**
   * add_class
   * Save the data
   * @param $post - array of the data to be saved
   * @return TRUE if a record is added
   * @return FALSE if it failed to saved
   *------------------------------------------------------------------
   */
  public function add_class($post=FALSE)
	{
    if($post){
      
      $this->db->insert('classes',$post);
      
      return $this->db->affected_rows() >= 1 ? TRUE : FALSE;

    }else{
      return FALSE; 
    }
	}
  
  public function edit_class($data = FALSE, $id = FALSE)
  {
    if ($id) {
      $this->db->where('id',$id);
      $this->db->update('classes',$data);
      
      return $this->db->affected_rows() >= 1 ? TRUE : FALSE;      
    }else{
      return FALSE;
    }
  }
  
  /**
   * delete_class
   * Delete the record of the id being passed
   * @param $post_id - id to be deleted
   * @return TRUE if successfully deleted
   * @return FALSE if it fails to delete
   *------------------------------------------------------------------
   */
  public function delete_class($post_id=FALSE)
	{
		$this->db->delete('classes', array('id' => $post_id)); 

		return $this->db->affected_rows() >= 1 ? TRUE : FALSE;
	}

  public function get_activity($id)
  {
    $query = "SELECT *
          FROM
          activities
          WHERE id = ?
          ";
    $q = $this->db->query($query, [$id]);
    
    return $q->num_rows() >= 1 ? $q->row() : FALSE; //returns result if none retrieved, returns FALSE
  }

  public function upload_activity($post = FALSE)
  {
    $post['created_at'] = NOW;
    $this->db->insert('activities', $post);
    return $this->db->affected_rows() >= 1 ? TRUE : FALSE;
  }

  public function delete_activity($id)
  {
    $this->db->delete('activities', array('id' => $id)); 

    return $this->db->affected_rows() >= 1 ? TRUE : FALSE;
  }

  public function get_homework($id)
  {
    $query = "SELECT *
          FROM
          homework
          WHERE id = ?
          ";
    $q = $this->db->query($query, [$id]);
    
    return $q->num_rows() >= 1 ? $q->row() : FALSE; //returns result if none retrieved, returns FALSE
  }

  public function upload_homework($post = FALSE)
  {
    $post['created_at'] = NOW;
    $this->db->insert('homework', $post);
    return $this->db->affected_rows() >= 1 ? TRUE : FALSE;
  }

  public function delete_homework($id)
  {
    $this->db->delete('homework', array('id' => $id)); 

    return $this->db->affected_rows() >= 1 ? TRUE : FALSE;
  }

  public function get_quizzes($id)
  {
    $query = "SELECT *
          FROM
          quizzes
          WHERE id = ?
          ";
    $q = $this->db->query($query, [$id]);
    
    return $q->num_rows() >= 1 ? $q->row() : FALSE; //returns result if none retrieved, returns FALSE
  }

  public function upload_quizzes($post = FALSE)
  {
    $post['created_at'] = NOW;
    $this->db->insert('quizzes', $post);
    return $this->db->affected_rows() >= 1 ? TRUE : FALSE;
  }

  public function delete_quizzes($id)
  {
    $this->db->delete('quizzes', array('id' => $id)); 

    return $this->db->affected_rows() >= 1 ? TRUE : FALSE;
  }

}