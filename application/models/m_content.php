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
   * process_add_content
   * Save the data being passed to the function to the content table
   * @param $post - array of the data to be saved
   * @return TRUE if a record is added
   * @return FALSE if it failed to saved
   *------------------------------------------------------------------
   * 06/09/2015
   */
  public function process_add_content($post=FALSE)
	{
    if($post){
      
      $contents = $post;
      $contents['caption'] = $caption = $post['caption'];
      $contents['parent_id'] = $post['parent_id'];
      $contents['btnorder'] = $post['btnorder'];
      $contents['linkto'] = $linkto = $post['linkto'];
      $contents['target'] = $target = $post['target'];
      if($post['imagefile']){$contents['imagefile'] = $post['imagefile'];}
      $contents['imagecaption']=$post['imagecaption'];
      $contents['imagelink']=$post['imagelink'];
      $contents['imagealign']=$post['imagealign'];
      $content = $post['content'];
      $content_a = str_replace("base64_decode(","-",$content);
      $contents['content'] = htmlentities(str_replace("eval(","-",$content_a));
      $contents['level'] = $post['level'];
      $contents['category'] = $post['category'];
      $contents['foreword'] = $post['foreword'];
      $contents['created_at'] = NOW;
      
      $this->db->insert('contents',$contents);
      if($this->db->affected_rows() >= 1):
        $cid = $this->db->insert_id();
      endif;
      
      if(empty($linkto) || $linkto=='' || $linkto=='#')
      {
        if(!empty($content) || $content!=''){
          $CI =& get_instance();
          $encrypt_cid = $CI->hs->encrypt($cid);
          $caption = str_replace(' ','-',$caption);
          $contents_update['linkto'] = "content/".$encrypt_cid."/".$caption;
          $contents_update['updated_at'] = NOW;
        }else{
          $contents_update['linkto'] = "#";
          $contents_update['updated_at'] = NOW;
        }
        $this->db->where('content_id', $cid);
        $this->db->update('contents',$contents_update);
      }
      
      return $this->db->affected_rows() >= 1 ? TRUE : FALSE;
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
   * process_update_content
   * Update the record of the id being passed
   * @param $encrypt_id - id to be updated
   * @param $data - array containing the records
   * @return TRUE if a record is updated
   * @return FALSE if it fails to update
   *------------------------------------------------------------------
   * 06/09/2015
   */
  public function process_update_content($data,$id)
	{
		$CI =& get_instance();
		$contents = $data;
		$contents['caption'] = $caption = $data['caption'];
		$contents['parent_id'] = $data['parent_id'];
		if($data['imagefile']){$contents['imagefile'] = $data['imagefile'];}
    $contents['linkto'] = $linkto = $post['linkto'];
    $contents['target'] = $target = $post['target'];
		$contents['btnorder'] = $data['btnorder'];
             $contents['category'] = $data['category'];
             $contents['foreword'] = $data['foreword'];
		$contents['imagecaption']=$data['imagecaption'];
		$contents['imagelink']=$data['imagelink'];
		$contents['imagealign']=$data['imagealign'];
		$content = $data['content'];
		$content_a = str_replace("base64_decode(","-",$content);
		$contents['content'] = htmlentities(str_replace("eval(","-",$content_a));
		$contents['updated_at'] = NOW;
		
		$this->db->where('content_id', $id);
		$this->db->update('contents', $contents);
		
		$linkto = $data['linkto'];
		
		if(empty($linkto) || $linkto=='' || $linkto=='#')
		{
			if(!empty($content) || $content!=''){
				$encrypt_id = $CI->hs->encrypt(intval($id));
				$caption = str_replace(' ','-',$caption);
				$contents_update['linkto'] = "content/".$encrypt_id."/".$caption;
				$contents_update['updated_at'] = NOW;
			}else{
				$contents_update['linkto'] = "#";
				$contents_update['updated_at'] = NOW;
			}
			$this->db->where('content_id', $id);
			$this->db->update('contents',$contents_update);
		}else{
      $contents_update['linkto'] = $linkto;
			$contents_update['updated_at'] = NOW;
      
      $this->db->where('content_id', $id);
			$this->db->update('contents',$contents_update);
    }
			
		return $this->db->affected_rows() >= 1 ? TRUE : FALSE;
	}
  
  /**
   * process_del_content
   * Delete the record of the id being passed
   * @param $post_id - id to be updated
   * @return TRUE if successfully deleted
   * @return FALSE if it fails to delete
   *------------------------------------------------------------------
   * 06/09/2015
   */
  public function process_del_content($post_id=FALSE)
	{
		$this->db->delete('contents', array('content_id' => $post_id)); 

		return $this->db->affected_rows() >= 1 ? TRUE : FALSE;
	}
  
  /**
   * get_content_parent
   * Get the parent for the level passed
   * @param $level - level for the parent
   * @return array containing the caption for parent
   * @return FALSE no record found
   *------------------------------------------------------------------
   * 06/09/2015
   */
  public function get_content_parent($level=FALSE)
	{
		$query = "SELECT content_id,caption
				  FROM
					contents
				  WHERE level = ?";
		$q = $this->db->query($query,array($level));
		return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
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
   * get_caption_level
   * Get the contents with caption and level
   * @param $level - level for the parent
   * @return array containing records
   * @return FALSE no record found
   *------------------------------------------------------------------
   * 06/09/2015
   */
  public function get_caption_level($level=FALSE)
	{	
		$query = "SELECT *
				  FROM
					contents
				  WHERE 
					level = ?
				  ";
		
		$q = $this->db->query($query,array($level));
		return $q->num_rows() >= 1 ? $q->row() : FALSE; //returns result if none retrieved, returns FALSE
	}
  
   /**
   * delete_image
   * Delete image
   * @param $id - id to be deleted
   * @return TRUE if Delete success
   * @return FALSE if nothing is deleted
   *--------------------------------------
   * Arnie Jothan Earl - 06-24-2015
   */
  public function delete_image($id=FALSE){
		
		$query="UPDATE contents
			SET 
			imagefile = ?
			WHERE content_id = ?
			";
		$result = $this->db->query($query, array('',$id)); 
		return $this->db->affected_rows()>=1 ?TRUE:FALSE; 
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

/**
   * record_count
   * count the number of records
   * @param $level - level for the parent
   * @return int - number of records
   *--------------------------------------
   * Arnie Jothan Earl - 06-24-2015
   */
  public function record_count($level = FALSE)
  {
    if ($level) {
        $this->db->where('level', $level);
          return $this->db->count_all_results("contents");

    }else{
      return $this->db->count_all("contents");  
    }
    
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

  function archive($level, $order='desc'){
    $this->db->select('created_at');
    $this->db->distinct('created_at');
    $this->db->order_by('content_id', $order);
    $query = $this->db->get_where('contents', array('level' => $level));

    $q_arr = $query->result_array();
    foreach($q_arr as $q1){
        $query2 = $this->db->get_where('contents', array('level' => $level,  DATE_FORMAT('created_at', '%b %Y') => DATE_FORMAT($q1['created_at'], '%b %Y')));
        $q2_arr = $query2->result_array();

        $archive = array();

        foreach($q2_arr as $q2){
            $archive[$q1['created_at']][] = $q2;
        }

    }

    return $archive;
}

public function process_no_feature($level)
  {
    $data['parent_id'] = '0';
    $this->db->where('level', $level);
    $this->db->update('contents', $data);
    return $this->db->affected_rows() >= 1 ? TRUE : FALSE;
    // $sql = "UPDATE gallery_images SET primary = '0' ";
    // $this->db->query($sql);
  }

  public function set_feature($post_id=FALSE)
  {
    $data = array(
               'parent_id' => '1',
               'updated_at' => NOW
            );

    $this->db->where('content_id', $post_id);
    $this->db->update('contents', $data); 

    return $this->db->affected_rows() >= 1 ? TRUE : FALSE;
  }

   public function get_featured_services($level, $order='desc')
  {
    $query = "SELECT *
          FROM
          contents
          WHERE 
          level = ? 
          AND 
          parent_id = 1
          ";
    if($order == 'desc'){
    $query .= "ORDER BY content_id DESC ";  
    }else{      
    $query .= "ORDER BY content_id ASC ";
    }
    $query .= "LIMIT 2"; 

    $q = $this->db->query($query,array($level));
    return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
  }

    public function get_services_view($level, $id, $order='desc')
  {
    $query = "SELECT *
          FROM
          contents
          WHERE 
          level = ? 
          AND
          content_id = ?
          ";
    if($order == 'desc'){
    $query .= "ORDER BY content_id DESC ";  
    }else{      
    $query .= "ORDER BY content_id ASC ";
    }

    $q = $this->db->query($query,array($level, $id));
    return $q->num_rows() >= 1 ? $q->result_array() : FALSE; //returns result if none retrieved, returns FALSE
  }

    public function get_inside($level=FALSE, $caption = FALSE)
  {
    $query = "SELECT *
          FROM
          contents
          WHERE 
          level = ?
          AND
          caption = ?
          ORDER BY 
          btnorder";
    $q = $this->db->query($query,array($level, $caption));
    return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
  }

  public function get_test($encrypt_id=FALSE)
  {
    $CI =& get_instance();
    $id = $CI->hs->decrypt($encrypt_id)[0];
  
    $query = "SELECT 
          *
          FROM
          testimonials
          WHERE
          id = ?
          ";
    $q = $this->db->query($query,array($id));
    return $q->num_rows() >= 1 ? $q->row() : FALSE; //returns result if none retrieved, returns FALSE
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