<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_yvideos Extends CI_Model
{
  public function get_every_yv()
	{
		$query = "SELECT *
				  FROM
					yvideos
          ORDER BY id DESC";
		$q = $this->db->query($query);
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
    $linkto = $post['yvideo'];
		$linkto_a = str_replace("base64_decode(","-",$linkto);
		$banner['yvideo'] = htmlentities(str_replace("eval(","-",$linkto_a));
		$caption = $post['caption'];
		$caption_a = str_replace("base64_decode(","-",$caption);
		$banner['caption'] = htmlentities(str_replace("eval(","-",$caption_a));
		
		$this->db->insert('yvideos',$banner);

		return $this->db->affected_rows()>=1?TRUE:FALSE; 
	}
  
  public function process_del_yv($post_id=FALSE)
	{
		$this->db->delete('yvideos', array('id' => $post_id)); 

		return $this->db->affected_rows() >= 1 ? TRUE : FALSE;
	}
}