<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms_teacher extends MY_AdminController {

	public function __construct()
	{
		parent::__construct();
		
		if($this->session->userdata('logged_in') == FALSE){
			redirect('obcms-login');
		}elseif ($this->session->userdata('userType') == 'instructor') {
			$this->load->helper('file');
			$this->view_data['system_message'] =$this->_msg();
			$this->load->model('M_classes','mc');
			$this->load->model('M_content','mu');
			$this->load->model('M_students','ms');
			$this->load->model('M_downloads','md');
			$this->load->model('M_forums','mf');
		}elseif ($this->session->userdata('userType') == 'admin') {
			redirect('cms_admin');
		}elseif ($this->session->userdata('userType') == 'student') {
			redirect('cms_student');
		}
	}
	
	public function index()
	{
		//$this->view_data['hits']=$this->mu->get_hits();
		//$this->view_data['visits']=$this->mu->count_hits();
		//$this->view_data['ipadd']=$this->mu->count_visits();
	}

	public function classes()
	{

		$this->view_data['classes']=$this->mc->get_all_classes();

		if ($this->input->post()) {
			$data['class'] = $this->input->post('class');

			$result = $this->mc->add_class($data);

			if ($result) {
				$this->_msg('s','Successfully Added.','cms_teacher/classes');
			}else{
				$this->_msg('e','Failed.','cms_teacher/classes');
			}
		}

	}

	public function edit_class($id = FALSE)
	{
		if ($id) {
			if ($this->input->post()) {
				$data['class'] = $this->input->post('class');

				$result = $this->mc->edit_class($data, $id);

				if ($result) {
					$this->_msg('s','Successfully Updated Class.','cms_teacher/classes');
				}else{
					$this->_msg('e','Failed.','cms_teacher/classes');
				}
			}
			$this->view_data['class']=$this->mc->get_class($id);
			$this->view_data['classes']=$this->mc->get_all_classes();

		}else{
			show_404();
		}
	}

	public function delete_class($id = FALSE)
	{
		if ($id) {
			$res = $this->mc->delete_class($id);
			if ($res) {
				$this->_msg('s','Successfully Deleted.','cms_teacher/classes');
			}else{
				$this->_msg('e','Failed.','cms_teacher/classes');
			}	
		}else{
			show_404();
		}
	}

	public function students($id = FALSE)
	{
		if ($id) {

			if ($this->input->post('add-studentsubmit')) {
				$data['username'] = $this->input->post('username');
				$data['f_name'] = $this->input->post('f_name');
				$data['m_name'] = $this->input->post('m_name');
				$data['l_name'] = $this->input->post('l_name');
				$data['userType'] = 'student';
				$data['class_id'] = $id;

				$res = $this->ms->add_student($data);
				if ($res) {
					$this->_msg('s','Successfully Added Student.','cms_teacher/students/'.$id);
				}else{
					$this->_msg('e','Failed.','cms_teacher/students/'.$id);
				}	
			}
			
			$this->view_data['list'] = $this->ms->get_students_in_class($id);

		}else{
			show_404();
		}
	}

	public function edit_student($class = FALSE, $id = FALSE)
	{
		if ($id) {
			if ($this->input->post('edit-studentsubmit')) {
				$account_id = $this->input->post('account_id');
				$data['username'] = $this->input->post('username');
				$data['f_name'] = $this->input->post('f_name');
				$data['m_name'] = $this->input->post('m_name');
				$data['l_name'] = $this->input->post('l_name');
				$data['userType'] = 'student';
				$data['class_id'] = $class;

				$res = $this->ms->edit_student($data, $id, $account_id);
				if ($res) {
					$this->_msg('s','Successfully Updated Student.','cms_teacher/students/'.$class);
				}else{
					$this->_msg('e','Failed.','cms_teacher/students/'.$class);
				}	
			}
			
			$this->view_data['list'] = $this->ms->get_student($id);
		}else{
			show_404();
		}
	}

	public function view_student($class = FALSE, $id = FALSE)
	{
		if ($id) {
			$this->view_data['list'] = $this->ms->get_student($id);
		}else{
			show_404();
		}
	}

	public function delete_student($class = FALSE, $id = FALSE, $account_id = FALSE)
	{
		if ($id && $account_id) {
			$res = $this->ms->delete_student($id, $account_id);
			if ($res) {
					$this->_msg('s','Successfully Deleted Student.','cms_teacher/students/'.$class);
				}else{
					$this->_msg('e','Failed.','cms_teacher/students/'.$class);
				}
		}else{
			show_404();
		}
	}

	public function change_status($status = FALSE, $id = FALSE, $class = FALSE)
	{
		if ($id) {
			$res = $this->mu->change_status($status, $id);
			if ($res) {
				if ($status == "inactive") {
					$this->_msg('s','Account Successfully Deactivated.','cms_teacher/students/'.$class);	
				}else{
					$this->_msg('s','Account Successfully Activated.','cms_teacher/students/'.$class);
				}
			}else{
				$this->_msg('e','Failed.','cms_teacher/students/'.$class);
			}				
		}else{
			show_404();
		}
	}

	public function materials($class = FALSE)
	{
		if ($class) {
			if ($this->input->post('submit-syllabus')) {
				$config['upload_path'] = './assets/downloads/syllabus/';
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = '1000000';
				$config['remove_spaces'] = TRUE;
				$config['overwrite'] = TRUE;

				$this->load->library('upload', $config); //LOAD UPLOAD LIBRARY WITH THE CONFIG VARIABLE

				if (!$this->upload->do_upload('syllabus')) //DO THE ACTUAL UPLOADING OF FILES
				{	
					$error = array('error' => $this->upload->display_errors()); // IF UPLOAD HAS ERROR 
					$this->_msg('e', $error['error'], current_url()); //SHOW ERROR
				}else{ 
					$upload_data = array('upload_data' => $this->upload->data()); // IF UPLOAD SUCCESS GET UPLOAD INFORMATION
					$data['file_size'] = number_format($upload_data['upload_data']['file_size'] / 1024, 2);
					$data['file'] = $upload_data['upload_data']['file_name']; // GET THE FILENAME OF IMAGE UPLOADED
				}

				$data['caption']=$this->input->post('caption');
				$data['class_id'] = $class;

				$res = $this->md->upload_syllabus($data);
				if ($res) {
					$this->_msg('s','Successfully Added Syllabus.','cms_teacher/materials/'.$class);
				}else{
					$this->_msg('e','Failed.','cms_teacher/materials/'.$class);
				}	
			}elseif ($this->input->post('submit-content')) {
				$config['upload_path'] = './assets/downloads/content/';
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = '1000000';
				$config['remove_spaces'] = TRUE;
				$config['overwrite'] = TRUE;

				$this->load->library('upload', $config); //LOAD UPLOAD LIBRARY WITH THE CONFIG VARIABLE

				if (!$this->upload->do_upload('content')) //DO THE ACTUAL UPLOADING OF FILES
				{	
					$error = array('error' => $this->upload->display_errors()); // IF UPLOAD HAS ERROR 
					$this->_msg('e', $error['error'], current_url()); //SHOW ERROR
				}else{ 
					$upload_data = array('upload_data' => $this->upload->data()); // IF UPLOAD SUCCESS GET UPLOAD INFORMATION
					$data['file_size'] = number_format($upload_data['upload_data']['file_size'] / 1024, 2);
					$data['file'] = $upload_data['upload_data']['file_name']; // GET THE FILENAME OF IMAGE UPLOADED
				}

				$data['caption']=$this->input->post('cn_caption');
				$data['class_id'] = $class;

				$res = $this->md->upload_content($data);
				if ($res) {
					$this->_msg('s','Successfully Added Course Content.','cms_teacher/materials/'.$class);
				}else{
					$this->_msg('e','Failed.','cms_teacher/materials/'.$class);
				}	
			}elseif ($this->input->post('submit-outline')) {
				$config['upload_path'] = './assets/downloads/outline/';
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = '1000000';
				$config['remove_spaces'] = TRUE;
				$config['overwrite'] = TRUE;

				$this->load->library('upload', $config); //LOAD UPLOAD LIBRARY WITH THE CONFIG VARIABLE

				if (!$this->upload->do_upload('outline')) //DO THE ACTUAL UPLOADING OF FILES
				{	
					$error = array('error' => $this->upload->display_errors()); // IF UPLOAD HAS ERROR 
					$this->_msg('e', $error['error'], current_url()); //SHOW ERROR
				}else{ 
					$upload_data = array('upload_data' => $this->upload->data()); // IF UPLOAD SUCCESS GET UPLOAD INFORMATION
					$data['file_size'] = number_format($upload_data['upload_data']['file_size'] / 1024, 2);
					$data['file'] = $upload_data['upload_data']['file_name']; // GET THE FILENAME OF IMAGE UPLOADED
				}

				$data['caption']=$this->input->post('ot_caption');
				$data['class_id'] = $class;

				$res = $this->md->upload_outline($data);
				if ($res) {
					$this->_msg('s','Successfully Added Course Outline.','cms_teacher/materials/'.$class);
				}else{
					$this->_msg('e','Failed.','cms_teacher/materials/'.$class);
				}	
			}
			$this->view_data['list'] = $this->md->get_syllabus_in($class);
			$this->view_data['course_content'] = $this->md->get_course_content_in($class);
			$this->view_data['course_outline'] = $this->md->get_course_outline_in($class);
			$this->view_data['class'] = $class;
		}else{
			show_404();
		}
	}

	public function delete_syllabus($class = FALSE, $id = FALSE)
	{
		if ($id) {
			$path = $this->md->get_syllabus($id);
			$path = FCPATH.'assets/downloads/syllabus/'.$path->file;
	        if (file_exists($path)){ 
				unlink($path); // DELETE RECENT IMAGE IF EXIST / UNLINK
		        $res = $this->md->delete_syllabus($id);
				if ($res) {
					$this->_msg('s','Successfully Delted Syllabus.','cms_teacher/materials/'.$class);
				}else{
					$this->_msg('e','Failed.','cms_teacher/materials/'.$class);
				}	
	        }else{
	          $this->_msg('e','File Not Deleted.','cms_teacher/materials/'.$class);
	        }
		}else{
			show_404();
		}
	}

	public function delete_content($class = FALSE, $id = FALSE)
	{
		if ($id) {
			$path = $this->md->get_syllabus($id);
			$path = FCPATH.'assets/downloads/content/'.$path->file;
	        if (file_exists($path)){ 
				unlink($path); // DELETE RECENT IMAGE IF EXIST / UNLINK
		        $res = $this->md->delete_content($id);
				if ($res) {
					$this->_msg('s','Successfully Delted Course Content.','Cms_teacher/materials/'.$class);
				}else{
					$this->_msg('e','Failed.','Cms_teacher/materials/'.$class);
				}	
	        }else{
	          $this->_msg('e','File Not Deleted.','Cms_teacher/materials/'.$class);
	        }
		}else{
			show_404();
		}
	}

	public function delete_outline($class = FALSE, $id = FALSE)
	{
		if ($id) {
			$path = $this->md->get_syllabus($id);
			$path = FCPATH.'assets/downloads/outline/'.$path->file;
	        if (file_exists($path)){ 
				unlink($path); // DELETE RECENT IMAGE IF EXIST / UNLINK
		        $res = $this->md->delete_outline($id);
				if ($res) {
					$this->_msg('s','Successfully Delted Course Outline.','cms_teacher/materials/'.$class);
				}else{
					$this->_msg('e','Failed.','cms_teacher/materials/'.$class);
				}	
	        }else{
	          $this->_msg('e','File Not Deleted.','cms_teacher/materials/'.$class);
	        }
		}else{
			show_404();
		}
	}

	public function forums($class = FALSE)
	{
		if ($class) {
			if ($this->input->post()) {
				$data['topics'] = $this->input->post('topic');
				$data['forum_desc'] = $this->input->post('forum_desc');
				$data['class_id'] = $class;
				$data['created_by'] = $this->session->userdata('userid');

				$result = $this->mf->add_forum($data);

				if ($result) {
					$this->_msg('s','Successfully Added.','cms_teacher/forums/'.$class);
				}else{
					$this->_msg('e','Failed.','cms_teacher/forums/'.$class);
				}
			}
			$this->view_data['my_forum'] = $this->session->userdata('userid');
			$this->view_data['list'] = $this->mf->get_forums_in($class);
		}else{
			show_404();
		}
	}

	public function edit_forum($class = FALSE, $id = FALSE)
	{
		if ($id) {

			if ($this->input->post('update-forumssubmit')) {
				$data['topics'] = $this->input->post('topics');
				$data['forum_desc'] = $this->input->post('forum_desc');

				$result = $this->mf->edit_forum($data, $id);

				if ($result) {
					$this->_msg('s','Successfully Updated Topic.','cms_teacher/forums/'.$class);
				}else{
					$this->_msg('e','Failed.','cms_teacher/forums/'.$class);
				}
			}

			$this->view_data['class'] = $this->mf->get_forum($id);
			$this->view_data['list'] = $this->mf->get_forums_in($class);

		}else{
			show_404();
		}
	}

	public function delete_forum($class = FALSE, $id = FALSE)
	{
		if ($id) {
			$res = $this->mf->delete_forum($id);
			if ($res) {
				$this->_msg('s','Successfully Deleted.','cms_teacher/forums/'.$class);
			}else{
				$this->_msg('e','Failed.','cms_teacher/forums/'.$class);
			}	
		}else{
			show_404();
		}
	}

	public function view_forum($class = FALSE, $id = FALSE)
	{
		if ($id) {
			if ($this->input->post('submit-comment')) {
				$data['comment'] = $this->input->post('comment');
				$data['forum_id'] = $id;
				$data['comment_by'] = $this->session->userdata('userid');

				$result = $this->mf->add_comment($data);

				if ($result) {
					$this->_msg('s','Comment Submitted.','cms_teacher/view_forum/'.$class.'/'.$id);
				}else{
					$this->_msg('e','Failed.','cms_teacher/view_forum/'.$class.'/'.$id);
				}
			}

			$this->view_data['class'] = $this->mf->get_forum($id);
			$this->view_data['list'] = $this->mf->get_comments_in($id);
		}else{
			show_404();
		}
	}

	public function FunctionName($value='')
	{
		# code...
	}
}
