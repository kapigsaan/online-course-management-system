<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_banner Extends CI_Model
{
	/*============================
		PROCESS BANNER
	==============================*/

	public function process_add_banner($post)
	{
		$CI =& get_instance();
		
		$banner['type'] = 'image';
		$banner['usebanner'] = 'yes';
		if($post['file']){$banner['file'] = $post['file'];}
		$banner['caption'] = $caption = $post['caption'];
		$banner['linkto'] = $post['linkto'];
		$content = $post['content'];
		$content_a = str_replace("base64_decode(","-",$content);
		$banner['content'] = htmlentities(str_replace("eval(","-",$content_a));
		$banner['created_at'] = NOW;
		
		$this->db->insert('banners',$banner);

		if($this->db->affected_rows()>=1){
			$cid = $this->db->insert_id();
			if(empty($linkto) || $linkto=='' || $linkto=='#'){
				if(!empty($content) || $content!=''){
					$encrypt_cid = $CI->hs->encrypt(intval($cid));
					$caption = str_replace(' ','-',$caption);
					$banners_update['linkto'] = "banner/".$encrypt_cid."/".$caption;
					$banners_update['updated_at'] = NOW;
				}else{
					$banners_update['linkto'] = "#";
					$banners_update['updated_at'] = NOW;
				}
				$this->db->where('banner_id', $cid);
				$this->db->update('banners',$banners_update);
				return $this->db->affected_rows() >= 1 ? TRUE : FALSE;
			}
			return TRUE;
		}else{ 
			return FALSE; 
		}
	}
	
	public function process_update_banner($post,$bnrid)
	{
		$CI =& get_instance();
		
		$banner['usebanner'] = 'yes';
		if($post['file']){$banner['file'] = $post['file'];}
		$banner['caption'] = $caption = $post['caption'];
		$banner['linkto'] = $post['linkto'];
		$content = $post['content'];
		$content_a = str_replace("base64_decode(","-",$content);
		$banner['content'] = htmlentities(str_replace("eval(","-",$content_a));
		
		$this->db->where('banner_id', $bnrid);
		$this->db->update('banners',$banner);

		if($this->db->affected_rows()>=1){
			if(empty($linkto) || $linkto=='' || $linkto=='#'){
				if(!empty($content) || $content!=''){
					$encrypt_cid = $CI->hs->encrypt(intval($bnrid));
					$caption = str_replace(' ','-',$caption);
					$banners_update['linkto'] = "banner/".$encrypt_cid."/".$caption;
					$banners_update['updated_at'] = NOW;
				}else{
					$banners_update['linkto'] = "#";
					$banners_update['updated_at'] = NOW;
				}
				$this->db->where('banner_id', $bnrid);
				$this->db->update('banners',$banners_update);
				return $this->db->affected_rows() >= 1 ? TRUE : FALSE;
			}
			return TRUE;
		}else{ 
			return FALSE; 
		}
	}
	
	public function get_all_banners()
	{
		$query = "SELECT *
				  FROM
					banners";
		$q = $this->db->query($query);
		return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
	}
	
	public function get_banner($id=FALSE)
	{
		$query = "SELECT *
				  FROM
					banners
				  WHERE
				   banner_id = ?";
		$q = $this->db->query($query,array($id));
		return $q->num_rows() >= 1 ? $q->row() : FALSE; //returns result if none retrieved, returns FALSE
	}
	
	public function get_set_banners()
	{
		$query = "SELECT *
				  FROM
					banners
				  WHERE
				   usebanner = ?";
		$q = $this->db->query($query,array('yes'));
		return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
	}
	
	public function process_no_banner()
	{
		$sql = "UPDATE banners SET usebanner='no'";
		$this->db->query($sql);
	}
	
	public function process_use_banner($post_id=FALSE)
	{
		$data = array(
               'usebanner' => 'yes',
               'updated_at' => NOW
            );

		$this->db->where('banner_id', $post_id);
		$this->db->update('banners', $data); 

		return $this->db->affected_rows() >= 1 ? TRUE : FALSE;
	}
	
	public function process_del_banner($post_id=FALSE)
	{
		$this->db->delete('banners', array('banner_id' => $post_id)); 

		return $this->db->affected_rows() >= 1 ? TRUE : FALSE;
	}
	
	public function get_every_banners()
	{
		$query = "SELECT *
				  FROM
					banners";
		$q = $this->db->query($query);
		return $q->num_rows() >= 1 ? $q->result() : FALSE; //returns result if none retrieved, returns FALSE
	}
	
	public function delete_image($id=FALSE){
		
		$query="UPDATE banners
			SET 
			file = ?
			WHERE banner_id = ?
			";
		$result = $this->db->query($query, array('',$id)); 
		return $this->db->affected_rows()>=1 ?TRUE:FALSE; 
	}
  
  /***********for display******************/
  public function get_content($encrypt_id=FALSE)
	{
		$CI =& get_instance();
		$id = $CI->hs->decrypt($encrypt_id)[0];
	
		$query = "SELECT 
					*
				  FROM
					banners
				  WHERE
					banner_id = ?";
		$q = $this->db->query($query,array($id));
		return $q->num_rows() >= 1 ? $q->row() : FALSE; //returns result if none retrieved, returns FALSE
	}
}