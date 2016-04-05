<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_content Extends CI_Model
{
	/*============================
		PROCESS CONTENT
	==============================*/
  
  /**
   * get_all_accounts
   * Get all Accounts
   * @return array records found
   * @return FALSE if no record found
   *--------------------------------------
   */
	public function get_all_accounts()
  {
    $query = "SELECT *
          FROM
          useraccounts
          ORDER BY 
          l_name";
    $q = $this->db->query($query);
    
    return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
  }

  public function get_user_where($tp = FALSE)
	{
    if ($tp) {
      $query = "SELECT *
          FROM
          useraccounts
          WHERE type = ?
          ORDER BY 
          l_name";

        $q = $this->db->query($query, [$tp]);
        
        return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE

    }else{
      return FALSE;
    }
	}

  /**
   * record_count
   * count the number of records
   * @param $level - level for the parent
   * @return int - number of records
   *--------------------------------------
   */
  public function record_count($type = FALSE)
  {
    if ($type) {
      $this->db->where('type', $type);
      return $this->db->count_all_results("useraccounts");
    }else{
      return $this->db->count_all("useraccounts");  
    }

  }
  
  /**
   * get_instructor
   * Get the caption of the passed id
   * @param $id - id to be search
   * @return caption of records found
   * @return FALSE if no record found
   *--------------------------------------
   */
	public function get_account($id=FALSE)
	{
    if ($id) {
      $query = "SELECT *
          FROM
          useraccounts
          WHERE acid = ?
          ";

      $q = $this->db->query($query, [$id]);
      
      return $q->num_rows() >= 1 ? $q->row() : FALSE; //returns result if none retrieved, returns FALSE
    }else{
      return FALSE;
    }
	}

  public function change_status($status = FALSE, $id=FALSE){
    if ($id) {
      $query="UPDATE useraccounts
              SET 
              userStatus = ?
              WHERE acid = ?
              ";
      $result = $this->db->query($query, array($status,$id)); 
      return $this->db->affected_rows()>=1 ?TRUE:FALSE; 
    }else{
      return FALSE;
    }
  }
  
  /**
   * get_content
   * Get the record of the passed id
   * @param $encrypt_id - id to be search
   * @return array records found
   * @return FALSE if no record found
   *------------------------------------------------------------------
   * 06/09/2015
   */
  public function get_content($encrypt_id=FALSE)
	{
		$CI =& get_instance();
		$id = $CI->hs->decrypt($encrypt_id)[0];
	
		$query = "SELECT 
					*
				  FROM
					contents
				  WHERE
					content_id = ?
				  ORDER BY 
					btnorder";
		$q = $this->db->query($query,array($id));
		return $q->num_rows() >= 1 ? $q->row() : FALSE; //returns result if none retrieved, returns FALSE
	}

  /**
   * get_contents
   * Get the contents with limit
   * @param $level - level for the parent
   * @param $limit - number of records
   * @return array containing records
   * @return FALSE no record found
   *------------------------------------------------------------------
   * 06/09/2015
   */
  public function get_contents($level=FALSE,$limit=FALSE)
	{	
		$query = "SELECT *
				  FROM
					contents
				  WHERE 
					level = ?
				  ";
		if($limit && $level=='features')
		{
		$query .= " ORDER BY btnorder
                LIMIT {$limit}";	
		}else if($limit && $level=='under'){
		$query .= " ORDER BY btnorder
                LIMIT {$limit}";	
		}else if($limit && $level=='news' || $level=='blog'){
		$query .= " ORDER BY content_id DESC
                LIMIT {$limit}";	
		}else if($limit && $level=='footer'){
		$query .= " ORDER BY btnorder
                LIMIT {$limit}";	
		}else{
    $query .= " ORDER BY created_at DESC
                LIMIT {$limit}";	
    }
		$q = $this->db->query($query,array($level));
		return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
	}
  
   /**
   * get_contents_pages
   * Get contents
   * @param $level - level for the parent
   * @param $limit - page limit 
   * @param $start - start of page
   * @param $order - order of records
   * @return array - records
   * @return FALSE if no record
   *--------------------------------------
   * Arnie Jothan Earl - 06-24-2015
   */
  public function get_contents_pages($level=FALSE,$limit=FALSE,$start=FALSE,$order='desc')
	{	
		$limit = is_numeric($limit) ? intval($limit) : 0;
		$start = is_numeric($start)? intval($start) : 0;

		$query = "SELECT *
				  FROM
					contents
				  WHERE 
					level = ? ";
    if($order == 'desc'){
    $query .= "ORDER BY content_id DESC ";  
    }else{      
		$query .= "ORDER BY content_id ASC ";
    }
		$query .= "LIMIT {$start} ,{$limit}";	

		$q = $this->db->query($query,array($level));
		return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
	}

    public function get_news($level, $order='desc')
  {
    $query = "SELECT *
          FROM
          contents
          WHERE 
          level = ? ";
    if($order == 'desc'){
    $query .= "ORDER BY content_id DESC ";  
    }else{      
    $query .= "ORDER BY content_id ASC ";
    }

    $q = $this->db->query($query,array($level));
    return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
  }

    public function search_count($s = FALSE)
  {
    
    $this->db->like('caption', $s);
    $this->db->or_like('level', $s);
    $this->db->or_like('content', $s);
    $this->db->from('contents');
    return $this->db->count_all_results();
  }

    public function search_contents($s=FALSE,$limit=FALSE,$start=FALSE)
  {
    $limit = is_numeric($limit) ? intval($limit) : 0;
    $start = is_numeric($start)? intval($start) : 0;

    $query = "SELECT *
                    FROM
                    contents
                    WHERE caption  
                    LIKE  '%$s%'
                    OR level
                    LIKE '%$s%'
                    OR content
                    LIKE '%$s%'
                    OR foreword
                    LIKE '%$s%'
                    ";
    $query .= "LIMIT {$start} ,{$limit}"; 

    $q = $this->db->query($query);
    return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
  }

  public function hot_news($encrypt_id=FALSE)
  {

    $CI =& get_instance();
    $id = $CI->hs->decrypt($encrypt_id)[0];

    $q = $this->db->select('content_id,reader')
            ->where('content_id', $id)
            ->get('reader');

      if($q->num_rows() > 0){
              //update
              unset($data);
              $data['reader'] = $q->row()->reader +1;
              $data['updated_at'] = NOW;
              $this->db->where('content_id', $id);
              $this->db->update('reader', $data);
      }else{
              //insert
              unset($input);
              $input['content_id'] = $id;
              $input['reader'] = 1;
              $input['created_at'] = NOW;
              $input['updated_at'] = NOW;
              $this->db->insert('reader', $input);
      }

  }

  public function get_hot($level = FALSE, $limit=FALSE)
  { 
    $query = "SELECT *
    FROM
    reader
    LEFT JOIN contents ON reader.content_id = contents.content_id
    WHERE contents.level = ?
    ORDER BY reader DESC
    LIMIT ?
    ";

    $q = $this->db->query($query, array($level, $limit));
    return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
  }
}