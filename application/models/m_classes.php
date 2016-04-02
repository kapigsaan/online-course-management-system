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

}