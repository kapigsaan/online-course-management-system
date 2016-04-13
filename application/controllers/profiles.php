<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Profiles extends MY_AdminController 
{
	public function __construct()
	{
		parent::__construct();
		
		if($this->session->userdata('logged_in') == FALSE){
			redirect('obcms-login');
		}elseif ($this->session->userdata('userType') == 'admin') {
			$this->view_data['system_message'] =$this->_msg();
			$this->load->model('M_content','mc');
			$this->load->model('M_users','mu');
			$this->load->model('M_students','ms');
			$this->load->model('M_classes','cl');
			$this->load->model('M_forums','mf');
			$this->load->model('M_downloads','md');
			$this->load->model('M_yvideos','myv');
			$this->load->model('M_profile','mp');
			
			$this->view_data['system_message'] = $this->_msg();
		}elseif ($this->session->userdata('userType') == 'instructor') {
			redirect('cms_teacher');
		}elseif ($this->session->userdata('userType') == 'student') {
			redirect('cms_student');
		}
	}

	public function index()
	{
    if($this->input->post('btnSubmit'))
		{
			$this->load->library('image_lib');
			if($_FILES['userfile']['name']): //CHECK IF USER SELECTED AN IMAGE
		        //CONFIGURATION OF THE IMAGE TO BE UPLOADED
		        $config['upload_path'] = FCPATH;
		        $config['allowed_types'] = 'jpg|png';
		        $config['max_size'] = '1000000';
		        $config['remove_spaces'] = TRUE;
		        $config['overwrite'] = TRUE;

		        $this->load->library('upload', $config); //LOAD UPLOAD LIBRARY WITH THE CONFIG VARIABLE

		        if ( ! $this->upload->do_upload()): //DO THE ACTUAL UPLOADING OF FILES
		          $error = array('error' => $this->upload->display_errors()); // IF UPLOAD HAS ERROR 
		          $this->logger('log','User: '.$this->custodian.' failed to upload the image '.$_FILES['userfile']['name']);
		          $this->_msg('e', $error, current_url()); //SHOW ERROR
		        else:
		          $upload_data = array('upload_data' => $this->upload->data()); // IF UPLOAD SUCCESS GET UPLOAD INFORMATION
		          $this->logger('log','User: '.$this->custodian.' successfully uploaded the image '.$_FILES['userfile']['name']);
		          $data['website']=$upload_data['upload_data']['file_name']; // GET THE FILENAME OF IMAGE UPLOADED
		          //thumbnail settings
			          // $config_sm['image_library'] = 'gd2';
			          // $config_sm['source_image'] = FCPATH.$upload_data['upload_data']['file_name'];
			          // $config_sm['create_thumb'] = TRUE;
			          // $config_sm['maintain_ratio'] = TRUE;
			          // $config_sm['width']     = 50;
			          // $config_sm['height']   = 50;
		          //create thumbnail
			          // $this->image_lib->initialize($config_sm);
			          // $this->image_lib->resize();
			          // $this->image_lib->clear();
		        endif;
		      else:
		      	$data['website'] = $this->input->post('websitex');
		      endif;

			$data['name'] = $this->input->post('txtCompname');
			$data['address'] = $this->input->post('txtAdd');
			$data['tel'] = $this->input->post('txtTel');
			$data['fax'] = $this->input->post('txtFax');
			$data['globe'] = $this->input->post('txtGlobe');
			$data['smart'] = $this->input->post('txtSmart');
			$data['sun'] = $this->input->post('txtSun');
			$this->mp->clear_setting();
			$result = $this->mp->insert_profile($data);
			
			if($result)
			{
				$this->_msg('s','Profiles saved.','profiles');
			}else{
				$this->_msg('e','Failed to save profiles.','profiles');
			}
		}
    
    	$this->view_data['prof'] = $img = $this->mp->get_profiles();
	    if ($img) {
	    	$this->view_data['imagefile'] = $img->website;
	    }else{
	    	$this->view_data['imagefile'] = FALSE;
	    }
	}

	public function delete_image()
	{
        $result = $this->mp->delete_logo();
        $file_info = pathinfo($result->website);
        $path = FCPATH.$website;  
        $path2 = FCPATH.$file_info['filename'].'_thumb.'.$file_info['extension'];  
         if (file_exists($path)){ 
          unlink($path); // DELETE RECENT IMAGE IF EXIST / UNLINK
          unlink($path2);
           $this->logger('log','User: '.$this->custodian.' successfully deleted image.');
           $this->_msg('s','Success. You have deleted an image.','profiles');
         }else{
         	$this->logger('log','User: '.$this->custodian.' failed to deleted image.');
          $this->_msg('e','Failed to delete the image. No file uploaded.','profiles');
         }
	}
}