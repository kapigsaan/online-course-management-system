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

  public function get_all_classes_with_insturctor()
  {
    $query = "SELECT *
          FROM
          useraccounts
          WHERE type = 'instructor'
          ORDER BY 
          l_name";
    $q = $this->db->query($query);

    if ($q->num_rows() >= 1) {
    
      $data = array();

      foreach ($q->result() as $key => $v) {
        $namefull = $v->l_name.' '.$v->f_name.' '.$v->m_name;
        $data[$namefull] = $this->get_my_classes($v->acid);
      }

      return $data;

    }else{
      return FALSE; //returns result if none retrieved, returns FALSE
    }
  }

  public function get_my_classes($id = FALSE)
  {
    $query = "SELECT *
            FROM
            classes
            WHERE created_by = ?
            ORDER BY 
            class";
    $q = $this->db->query($query,[$id]);

    return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
  }

  public function print_my_student_by_class($id = FALSE)
  {
    $query = "SELECT *,c.class
            FROM useraccounts u
            LEFT JOIN students_in_class st ON u.acid = st.stud_id
            LEFT JOIN classes c ON st.class_id = c.id
            WHERE st.class_id = ?
            ORDER BY 
            u.l_name";
    $q = $this->db->query($query,[$id]);

    return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
  }


  public function get_all_classes_with_students()
  {
    $query = "SELECT c.*,u.f_name,u.l_name,u.m_name
          FROM
          classes c
          LEFT JOIN useraccounts u ON c.created_by = u.acid
          ORDER BY 
          class";
    $q = $this->db->query($query);

    if ($q->num_rows() >= 1) {
    
      $data = array();

      foreach ($q->result() as $key => $v) {
        $namefull = $v->l_name.' '.$v->f_name.' '.$v->m_name;
        $class = $v->class; 
        $data[$key]['class'] = $class;
        $data[$key]['teacher'] = $namefull;
        $data[$key]['students'] = $this->get_my_classes_stud($v->id);
      }

      return $data;

    }else{
      return FALSE; //returns result if none retrieved, returns FALSE
    }
  }

  public function get_my_classes_stud($id = FALSE)
  {
    $query = "SELECT *
            FROM
            useraccounts u
            LEFT JOIN students_in_class sc ON u.acid = sc.stud_id
            WHERE u.type = 'student'
            AND sc.class_id = ?
            ORDER BY 
            u.l_name";
    $q = $this->db->query($query,[$id]);

    return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
  }


  public function get_all_my_class($x = FALSE, $id = FALSE)
  {
    $query = "SELECT s.status,s.join
          FROM
          classes c
          LEFT JOIN students_in_class s ON c.id = s.class_id
          WHERE s.stud_id = ?
          AND c.id = ?
          ORDER BY 
          c.class";
    $q = $this->db->query($query, [$id,$x]);
    
    return $q->num_rows() >= 1 ? $q->row() : FALSE; //returns result if none retrieved, returns FALSE
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

  public function get_all_answers($id = FALSE, $status = FALSE)
  {
    $query = "SELECT a.*, u.l_name, u.f_name, a.created_at as subm
          FROM answers a
          LEFT JOIN useraccounts u ON a.stud_id = u.acid
          WHERE a.class_id = ?
          AND a.status = ?
          ORDER BY u.l_name
          ";
    $q = $this->db->query($query, [$id,$status]);
    
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

  public function join_class($post = FALSE)
  {
    $post['created_at'] = NOW;
    $this->db->insert('students_in_class', $post); 

    return $this->db->affected_rows() >= 1 ? TRUE : FALSE;
  }

  public function use_class($id = FALSE, $stud_id = FALSE)
  {
    $this->db->set('status', 'inactive'); 
    $this->db->where('stud_id', $stud_id); 
    $this->db->update('students_in_class'); 


    $this->db->set('status', 'active'); 
    $this->db->where('class_id', $id);
    $this->db->where('stud_id', $stud_id);
    $this->db->update('students_in_class'); 
    return $this->db->affected_rows() >= 1 ? TRUE : FALSE;
  }

}