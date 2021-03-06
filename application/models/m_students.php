<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_students Extends CI_Model
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

  
  /**
   * get_student
   * Get the classes of the passed id
   * @param $id - id to be search
   * @return classes of records found
   * @return FALSE if no record found
   *--------------------------------------
   */
	public function get_student($id=FALSE)
  {
    $query = "SELECT s.*, u.username,u.acid
          FROM students s
          LEFT JOIN useraccounts u ON s.acc_id = u.acid
          WHERE s.id = ?
          ";
    $q = $this->db->query($query,array($id));
    return $q->num_rows() >= 1 ? $q->row() : FALSE; //returns result if none retrieved, returns FALSE
  }

  public function get_student_all()
  {
    $query = "SELECT s.*, u.username,u.acid,u.userStatus,u.type
          FROM students s
          LEFT JOIN useraccounts u ON s.acc_id = u.acid
          ";
    $q = $this->db->query($query);
    return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
  }

  public function get_student_class($id=FALSE)
  {
  	if ($id) {
  		$query = "SELECT s.class_id
          FROM students_in_class s
          LEFT JOIN useraccounts u ON s.stud_id = u.acid
          WHERE u.acid = ?
          AND s.status = 'active'
          ";
	    $q = $this->db->query($query,array($id));
	    return $q->num_rows() >= 1 ? $q->row()->class_id : FALSE; //returns result if none retrieved, returns FALSE
  	}else{
  		return FALSE;
  	}
  }

   public function get_all_student()
	  {
  		$query = "SELECT *
          FROM students
          ORDER BY  l_name 
          ";
	    $q = $this->db->query($query);
	    return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
	  }


  
  /**
   * add_student
   * Save the data
   * @param $post - array of the data to be saved
   * @return TRUE if a record is added
   * @return FALSE if it failed to saved
   *------------------------------------------------------------------
   */
	public function add_student($post=FALSE){
	    if($post){
			$v = (object) $post;
			$hashed_password = $this->hash_password($v->username);

			$user_data = array(
					'username' => $v->username,
					'password' => $hashed_password,
					'f_name' => $v->f_name,
					'm_name' => $v->m_name,
					'l_name' => $v->l_name,
					'type' => $v->userType,
					'userStatus' => 'active',
					'created_at' => NOW,
			);
			$this->db->insert('useraccounts', $user_data);

			$last_insert_id = $this->db->insert_id();

			$student_data = array(
					'f_name' => $v->f_name, 
					'm_name' => $v->m_name, 
					'l_name' => $v->l_name, 
					'acc_id' => $last_insert_id,
					'created_at' => NOW,
					);

			$this->db->insert('students',$student_data);

			return $this->db->affected_rows() >= 1 ? TRUE : FALSE;

	    }else{
	      return FALSE; 
	    }
	}

	public function edit_student($post=FALSE, $id, $account_id){
	    if($id){
			$v = (object) $post;

			$user_data = array(
					'username' => $v->username,
					'f_name' => $v->f_name,
					'm_name' => $v->m_name,
					'l_name' => $v->l_name,
			);
			$this->db->where('acid', $account_id);
			$this->db->update('useraccounts', $user_data);

			$student_data = array(
					'f_name' => $v->f_name, 
					'm_name' => $v->m_name, 
					'l_name' => $v->l_name, 
					'acc_id' => $account_id,
					);

			$this->db->where('id', $id);
			$this->db->update('students',$student_data);

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

	public function delete_student($id=FALSE)
	{
		if ($id) {
      $this->db->where('id', $id);
			$this->db->delete('students_in_class'); 

			return $this->db->affected_rows() >= 1 ? TRUE : FALSE;	
		}else{
			return FALSE;
		}
	}

	public function get_students_in_class($id=FALSE)
	{
		$query = "SELECT s.*, u.username, u.acid, sc.id as sc_id , sc.join as status
				  FROM students s
          LEFT JOIN useraccounts u ON s.acc_id = u.acid
				  LEFT JOIN students_in_class sc ON u.acid = sc.stud_id
				  WHERE sc.class_id = ?
				  ";
		$q = $this->db->query($query,array($id));
		return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
	}

	public function hash_password($password)
    {
        $this->load->helper('passwordcompat');
		return password_hash($password,PASSWORD_BCRYPT);
    }

    public function submit_avtivity($post)
    {
    	$post['created_at'] = NOW;
    	$this->db->insert('answers', $post);

    	return $this->db->affected_rows() >= 1 ? TRUE : FALSE;	
    }

}