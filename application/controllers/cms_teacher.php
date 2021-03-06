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
			$this->load->model('M_yvideos','myv');
			$this->load->model('M_users','user');
			$this->load->model('M_calendar','mcal');
			$this->load->model('M_messages','mm');
			$this->load->helper('string');
			$this->load->library(array('form_validation','token'));
			$this->load->helper(array('url','form'));
			$this->load->helper('download');
			$this->load->library('zip');
		}elseif ($this->session->userdata('userType') == 'admin') {
			redirect('cms_admin');
		}elseif ($this->session->userdata('userType') == 'student') {
			redirect('cms_student');
		}
	}
	
	public function index($year = FALSE, $month = FALSE)
	{
		if (!$year) {
			$year = date('Y');
		}
		if (!$month) {
			$month = date('m');
		}

		$prefs = array (
			'start_day' => 'sunday',
			'show_next_prev' => true,
			'next_prev_url' => base_url() . 'cms_teacher/index'
             );

		$prefs['day_type'] = 'long'; 

		$prefs['template'] = '
			 {table_open}<table class="calendar">{/table_open}

			 {heading_row_start}<tr style = "width: 100%;">{/heading_row_start}

			{heading_previous_cell}<th style = "text-align:center;"><a href="{previous_url}">&lt;&lt; Previous</a></th>{/heading_previous_cell}
			{heading_title_cell}<th colspan="{colspan}" style = "text-align:center;">{heading}</th>{/heading_title_cell}
			{heading_next_cell}<th style = "text-align:center;"><a href="{next_url}">Next &gt;&gt;</a></th>{/heading_next_cell}

			{heading_row_end}</tr>{/heading_row_end}

			    {week_day_cell}<th class="day_header">{week_day}</th>{/week_day_cell}
			    {cal_cell_content}<span class="day_listing">{day}</span> {content}&nbsp;{/cal_cell_content}
			    {cal_cell_content_today}<div class="today"><span class="day_listing">{day}</span> {content}</div>{/cal_cell_content_today}
			    {cal_cell_no_content}<span class="day_listing">{day}</span>&nbsp;{/cal_cell_no_content}
			    {cal_cell_no_content_today}<div class="today"><span class="day_listing">{day}</span></div>{/cal_cell_no_content_today}
		';

		$this->load->library('calendar', $prefs);
		$datas = $this->mcal->get_all_events($year,$month);

		$current_url = 'calendar-of--Events'.$year.'-'.$month;

		$years = date('Y');
		$months = date('m');

		$this->view_data['current'] = $mm = date('F').'  '.$yy = date('Y');
		$type = "web";
		$this->view_data['cal'] = $this->calendar->generate_event_calendar($year,$month,$datas,$current_url,$type);
		$this->view_data['links'] = $this->calendar->generate($this->uri->segment(3), $this->uri->segment(4));
		$this->view_data['events'] = $this->mcal->get_all_event_for($months,$years);
	}

	public function classes()
	{

		$this->view_data['classes']=$this->mc->get_all_classes_where($this->session->userdata('userid'));

		if ($this->input->post()) {
			$data['class'] = $this->input->post('class');
			$data['code'] =  random_string('alnum',10);
			$data['created_by'] = $this->session->userdata('userid');

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
				$data['created_by'] = $this->session->userdata('userid');

				$result = $this->mc->edit_class($data, $id);

				if ($result) {
					$this->_msg('s','Successfully Updated Class.','cms_teacher/classes');
				}else{
					$this->_msg('e','Failed.','cms_teacher/classes');
				}
			}
			$this->view_data['class']=$this->mc->get_class($id);
			$this->view_data['classes']=$this->mc->get_all_classes_where($this->session->userdata('userid'));

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

				$this->form_validation->set_rules('username', 'Username', 'required|is_unique[useraccounts.username]');

				if ($this->form_validation->run() == FALSE){

				}else{
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
			}
			
			$this->view_data['list'] = $this->ms->get_students_in_class($id);
			$this->view_data['class_id'] = $id;

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
			$this->view_data['class_id'] = $id;
		}else{
			show_404();
		}
	}

	public function view_student($class = FALSE, $id = FALSE)
	{
		if ($id) {
			$this->view_data['list'] = $this->ms->get_student($id);
			$this->view_data['class_id'] = $id;
		}else{
			show_404();
		}
	}

	public function delete_student($class = FALSE, $id = FALSE)
	{
		if ($id && $class) {
			$res = $this->ms->delete_student($id);
			if ($res) {
					$this->_msg('s','Successfully Removed Student.','cms_teacher/students/'.$class);
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
			$res = $this->mu->change_stud_status($status, $id);
			if ($res) {
				if ($status == "unjoin") {
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
				$config['allowed_types'] = TRUE;
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
				$config['allowed_types'] = TRUE;
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
				$config['allowed_types'] = TRUE;
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
			}if ($this->input->post('submit-video')) {
				ini_set('memory_limit','500M');
	                        ini_set('max_execution_time',600);
				ini_set('upload_max_filesize','150M');
				ini_set('post_max_size','150M');
				$config['upload_path'] = './assets/downloads/videos/';
				$config['allowed_types'] = TRUE;
				$config['max_size'] = '1000000';
				$config['remove_spaces'] = TRUE;
				$config['overwrite'] = TRUE;

				$this->load->library('upload', $config); //LOAD UPLOAD LIBRARY WITH THE CONFIG VARIABLE

				if (!$this->upload->do_upload('video')) //DO THE ACTUAL UPLOADING OF FILES
				{	
					$error = array('error' => $this->upload->display_errors()); // IF UPLOAD HAS ERROR 
					$this->_msg('e', $error['error'], current_url()); //SHOW ERROR
				}else{ 
					$upload_data = array('upload_data' => $this->upload->data()); // IF UPLOAD SUCCESS GET UPLOAD INFORMATION
					$data['file_size'] = number_format($upload_data['upload_data']['file_size'] / 1024, 2);
					$data['file'] = $upload_data['upload_data']['file_name']; // GET THE FILENAME OF IMAGE UPLOADED
				}

				$data['caption']=$this->input->post('v_caption');
				$data['class_id'] = $class;

				$result = $this->myv->process_add_yv($data);
				if ($result) {
					$this->_msg('s','Successfully Added Course Video.','cms_teacher/materials/'.$class);
				}else{
					$this->_msg('e','Failed.','cms_teacher/materials/'.$class);
				}
			}if ($this->input->post('submit-image')) {
				$this->load->library('image_lib');
				$config['upload_path'] = './assets/downloads/images/';
				$config['allowed_types'] = 'png|jpeg|jpg|JPG|JPEG|PNG';
				$config['max_size'] = '100000';
				$config['remove_spaces'] = TRUE;
				$config['overwrite'] = TRUE;

				$this->load->library('upload', $config); //LOAD UPLOAD LIBRARY WITH THE CONFIG VARIABLE

				if (!$this->upload->do_upload('image')) //DO THE ACTUAL UPLOADING OF FILES
				{	
					$error = array('error' => $this->upload->display_errors()); // IF UPLOAD HAS ERROR 
					$this->_msg('e', $error['error'], current_url()); //SHOW ERROR
				}else{ 
					$upload_data = array('upload_data' => $this->upload->data()); // IF UPLOAD SUCCESS GET UPLOAD INFORMATION
					$data['file_size'] = number_format($upload_data['upload_data']['file_size'] / 1024, 2);
					$data['file'] = $upload_data['upload_data']['file_name']; // GET THE FILENAME OF IMAGE UPLOADED
				}

				$data['caption']=$this->input->post('image_caption');
				$data['class_id'] = $class;

				$result = $this->md->upload_image($data);
				if ($result) {
					$this->_msg('s','Successfully Added Course Image.','cms_teacher/materials/'.$class);
				}else{
					$this->_msg('e','Failed.','cms_teacher/materials/'.$class);
				}
			}
			$this->view_data['list'] = $this->md->get_syllabus_in($class);
			$this->view_data['course_content'] = $this->md->get_course_content_in($class);
			$this->view_data['course_outline'] = $this->md->get_course_outline_in($class);
			$this->view_data['images'] = $this->md->get_images_in($class);
			$this->view_data['videos'] = $this->myv->get_every_yv($class);
			$this->view_data['class'] = $class;
		}else{
			show_404();
		}
	}

	public function activenot($databse = FALSE, $status = FALSE, $id = FALSE, $class = FALSE)
	{
		if ($id) {
			$res = $this->md->change_status($databse, $status, $id);

			if ($res) {
				if ($status == "inactive") {
					if ($databse == 'activities') {
						$this->_msg('s','Successfully Deactivated Activity.','cms_teacher/activity/'.$class);	
					}elseif($databse == 'homework'){
						$this->_msg('s','Successfully Deactivated Homework.','cms_teacher/homework/'.$class);	
					}elseif($databse == 'quizzes'){
						$this->_msg('s','Successfully Deactivated Quiz.','cms_teacher/quizzes/'.$class);	
					}elseif($databse == 'classes'){
						$this->_msg('s','Successfully Deactivated Class.','cms_teacher/classes/'.$class);	
					}else{
						$this->_msg('s','Successfully Deactivated.','cms_teacher/materials/'.$class);	
					}
				}else{
					if ($databse == 'activities') {
						$this->_msg('s','Successfully Activated Activity.','cms_teacher/activity/'.$class);	
					}elseif($databse == 'homework'){
						$this->_msg('s','Successfully Activated Homework.','cms_teacher/homework/'.$class);	
					}elseif($databse == 'quizzes'){
						$this->_msg('s','Successfully Activated Quiz.','cms_teacher/quizzes/'.$class);	
					}elseif($databse == 'classes'){
						$this->_msg('s','Successfully Activated Class.','cms_teacher/classes/'.$class);	
					}else{
						$this->_msg('s','Successfully Activated.','cms_teacher/materials/'.$class);	
					}
				}
			}else{
				if ($databse == 'activities') {
					$this->_msg('e','Failed.','cms_teacher/activity/'.$class);	
				}elseif($databse == 'homework'){
					$this->_msg('e','Failed.','cms_teacher/homework/'.$class);	
				}elseif($databse == 'quizzes'){
					$this->_msg('e','Failed.','cms_teacher/quizzes/'.$class);	
				}elseif($databse == 'classes'){
					$this->_msg('e','Failed.','cms_teacher/classes/'.$class);	
				}else{
					$this->_msg('e','Failed.','cms_teacher/materials/'.$class);
				}
			}

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
			$path = $this->md->get_content($id);
			$path = FCPATH.'assets/downloads/content/'.$path->file;
	        if (file_exists($path)){ 
				unlink($path); // DELETE RECENT IMAGE IF EXIST / UNLINK
		        $res = $this->md->delete_content($id);
				if ($res) {
					$this->_msg('s','Successfully Delted Course Content.','cms_teacher/materials/'.$class);
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

	public function delete_outline($class = FALSE, $id = FALSE)
	{
		if ($id) {
			$path = $this->md->get_outline($id);
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

	public function delete_images($class = FALSE, $id = FALSE)
	{
		if ($id) {
			$path = $this->md->get_images($id);
			$path = FCPATH.'assets/downloads/images/'.$path->file;
	        if (file_exists($path)){ 
				unlink($path); // DELETE RECENT IMAGE IF EXIST / UNLINK
		        $res = $this->md->delete_image($id);
				if ($res) {
					$this->_msg('s','Successfully Delted Course Image.','Cms_teacher/materials/'.$class);
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

	public function delete_videos($class = FALSE, $id = FALSE)
	{
		if ($id) {
			$path = $this->myv->get_yv($id);
			$path = FCPATH.'assets/downloads/videos/'.$path->file;
	        if (file_exists($path)){ 
				unlink($path); // DELETE RECENT IMAGE IF EXIST / UNLINK
		        $res = $this->myv->process_del_yv($id);
				if ($res) {
					$this->_msg('s','Successfully Delted Course Video.','cms_teacher/materials/'.$class);
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
  
   public function update_videos()
	{	
		if($this->input->post('delSelected') && $this->input->post('selectedItem'))
	  	{
	  		$selItem = $this->input->post('selectedItem');
	  		foreach ($selItem as $key => $value) 
				{
					$banner = $this->myv->get_yv($value);

					if($banner){
						$path = FCPATH.'assets/video/'.$banner->yvideo;
						if (file_exists($path))
						{ 
							unlink($path); // DELETE RECENT IMAGE IF EXIST / UNLINK
						}
					}

					$this->myv->process_del_yv($value);
	  		}
	  		$this->_msg('s','Successfully deleted.','admin_display/yvideos');
	  	}
	}

	public function change_password()
	{
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[45]');

		if ($this->input->post('btn-submit-changepass')) {
			if($this->form_validation->run() !== FALSE){

				$old_pass = $this->input->post('old_pass');
				$password = $this->input->post('password');

				$old = $this->user->verify_password($old_pass, $this->session->userdata('userid'));
				if ($old) {
					$new = $this->user->change_pass($password, $this->session->userdata('userid'));
					if ($new) {
						$this->_msg('s','Password Successfully Changed.','cms_teacher/index/');
					}else{
						$this->_msg('e','Failed.','cms_teacher/index/');
					}
				}else{
					$this->_msg('e','Old Password is Invalid.','cms_teacher/change_password');
				}
			}
		}
		$this->view_data['profile'] = $this->user->get_all_users($this->session->userdata('userid'));

	}

	public function messages()
	{
		$this->view_data['messages'] = $this->mm->get_my_messages($this->session->userdata('userid'));
		$this->view_data['instructors'] = $this->mu->get_user_where('instructor');

		$class = $this->mc->get_all_classes_where($this->session->userdata('userid'));
		if ($class) {
			$students = array();
			foreach ($class as $key => $v) {
				$student[$key] = $this->ms->get_students_in_class($v->id);		
			}
		}else{
			$student = FALSE;
		}
		$this->view_data['students'] = $student;
		// $this->view_data['students'] = $this->mu->get_user_where('student');
		$this->view_data['accounts'] = $this->mu->get_all_accounts();
		$this->view_data['me'] = $this->session->userdata('userid');
	}

	public function view_conversation($id = FALSE)
	{
		if ($id) {
			if ($this->input->post('btn-reply-messages')) {
				$data['subject'] = $this->input->post('subject');
				$data['from'] = $this->session->userdata('userid');
				$data['to'] = $id;
				$data['message'] = $this->input->post('reply');

				$result = $this->mm->send_message($data);

					if ($result) {
						$this->_msg('s','Message Sent.','cms_teacher/view_conversation/'.$id);
					}else{
						$this->_msg('e','Failed.','cms_teacher/view_conversation/'.$id);
					}

			}
			$this->view_data['messages'] = $this->mm->get_conversation_with_stud($id);	
			$this->view_data['accounts'] = $this->mu->get_all_accounts();
			$this->view_data['me'] = $this->session->userdata('userid');
		}else{
			show_404();
		}
	}

	public function delete_conversation($id = FALSE)
	{
		if ($id) {
			$res = $this->mm->delete_message($id);
			if ($res) {
				$this->_msg('s','Successfully Deleted.','cms_teacher/messages/');
			}else{
				$this->_msg('e','Failed.','cms_teacher/messages/');
			}	
		}else{
			show_404();
		}
	}

	public function activity($id = FALSE)
	{
		if ($id) {
			if ($this->input->post('submit-activity')) {
				$this->load->library('image_lib');
				$config['upload_path'] = './assets/downloads/activities/';
				$config['allowed_types'] = TRUE;
				$config['max_size'] = '100000';
				$config['remove_spaces'] = TRUE;
				$config['overwrite'] = TRUE;

				$this->load->library('upload', $config); //LOAD UPLOAD LIBRARY WITH THE CONFIG VARIABLE

				if (!$this->upload->do_upload('file')) //DO THE ACTUAL UPLOADING OF FILES
				{	
					$error = array('error' => $this->upload->display_errors()); // IF UPLOAD HAS ERROR 
					$this->_msg('e', $error['error'], current_url()); //SHOW ERROR
				}else{ 
					$upload_data = array('upload_data' => $this->upload->data()); // IF UPLOAD SUCCESS GET UPLOAD INFORMATION
					$data['file_size'] = number_format($upload_data['upload_data']['file_size'] / 1024, 2);
					$data['file'] = $upload_data['upload_data']['file_name']; // GET THE FILENAME OF IMAGE UPLOADED
				}

				$data['caption']=$this->input->post('caption');
				$data['updated_at']=$this->input->post('deadline');
				$data['class_id'] = $id;

				$result = $this->mc->upload_activity($data);
				if ($result) {
					$this->_msg('s','Successfully Added Activity.','cms_teacher/activity/'.$id);
				}else{
					$this->_msg('e','Failed.','cms_teacher/activity/'.$id);
				}
			}

			$this->view_data['class'] = $id;
			$this->view_data['class_name'] = $this->mc->get_class($id);
			$this->view_data['activities'] = $this->mc->get_all_acticities($id);
			$this->view_data['classes'] = $this->mc->get_all_classes_where($this->session->userdata('userid'));
		}else{
			$this->view_data['classes'] = $this->mc->get_all_classes_where($this->session->userdata('userid'));
			$this->view_data['class'] = FALSE;
		}
	}

	public function act()
	{
		if ($this->input->post('changeclass-btn')) {
			$id = $this->input->post('class');

			redirect(site_url('cms_teacher/activity/'.$id));
		}else{
			redirect(site_url('cms_teacher/activity'));
		}
	}

	public function view_answers($status = FALSE, $id = FALSE)
	{
		if ($id) {
			$this->view_data['answers'] = $this->mc->get_all_answers($id, $status);
		}else{
			show_404();
		}
	}

	public function download($path = FALSE, $file = FALSE)
	{
		$data = file_get_contents(FCPATH.'/assets/downloads/'.$path.'/'.$file); // Read the file's contents
        force_download($file, $data);

        return true;
	}

	public function download_answers($status = FALSE, $id = FALSE, $class = FALSE)
	{
		$ans = $this->mc->get_all_answers($id, $status);
		if ($ans) {
			$this->zip->clear_data();
			foreach ($ans as $key => $v) {
				// $this->download('answers', $v->file);

        		$name = $v->file;
				$data = file_get_contents(FCPATH.'/assets/downloads/answers/'.$v->file);

				$this->zip->add_data($name, $data);
			}

			// Write the zip file to a folder on your server. Name it "my_backup.zip"
			$this->zip->archive(FCPATH.'/assets/downloads/answers/tobedownloaded'); 
			// Download the file to your desktop. Name it "my_backup.zip"
			$this->zip->download('answers.zip');
		}else{
			$this->_msg('e','No Answers Available.','cms_teacher/activity/'.$class);
		}
	}

	public function delete_activity($id = FALSE, $class = FALSE)
	{
		if ($id) {
			$path = $this->mc->get_activity($id);
			$path = FCPATH.'assets/downloads/activities/'.$path->file;
	        if (file_exists($path)){ 
				unlink($path); // DELETE RECENT IMAGE IF EXIST / UNLINK
		        $res = $this->mc->delete_activity($id);
				if ($res) {
					$this->_msg('s','Successfully Delted Activity.','cms_teacher/activity/'.$class);
				}else{
					$this->_msg('e','Failed.','cms_teacher/activity/'.$class);
				}	
	        }else{
	          $this->_msg('e','File Not Deleted.','cms_teacher/activity/'.$class);
	        }
		}else{
			show_404();
		}
	}

	public function homework($id = FALSE)
	{
		if ($id) {
			if ($this->input->post('submit-homework')) {
				$this->load->library('image_lib');
				$config['upload_path'] = './assets/downloads/homework/';
				$config['allowed_types'] = TRUE;
				$config['max_size'] = '100000';
				$config['remove_spaces'] = TRUE;
				$config['overwrite'] = TRUE;

				$this->load->library('upload', $config); //LOAD UPLOAD LIBRARY WITH THE CONFIG VARIABLE

				if (!$this->upload->do_upload('file')) //DO THE ACTUAL UPLOADING OF FILES
				{	
					$error = array('error' => $this->upload->display_errors()); // IF UPLOAD HAS ERROR 
					$this->_msg('e', $error['error'], current_url()); //SHOW ERROR
				}else{ 
					$upload_data = array('upload_data' => $this->upload->data()); // IF UPLOAD SUCCESS GET UPLOAD INFORMATION
					$data['file_size'] = number_format($upload_data['upload_data']['file_size'] / 1024, 2);
					$data['file'] = $upload_data['upload_data']['file_name']; // GET THE FILENAME OF IMAGE UPLOADED
				}

				$data['caption']=$this->input->post('caption');
				$data['updated_at']=$this->input->post('deadline');
				$data['class_id'] = $id;

				$result = $this->mc->upload_homework($data);
				if ($result) {
					$this->_msg('s','Successfully Added Homework.','cms_teacher/homework/'.$id);
				}else{
					$this->_msg('e','Failed.','cms_teacher/homework/'.$id);
				}
			}

			$this->view_data['class'] = $id;
			$this->view_data['class_name'] = $this->mc->get_class($id);
			$this->view_data['activities'] = $this->mc->get_all_homework($id);
			$this->view_data['classes'] = $this->mc->get_all_classes_where($this->session->userdata('userid'));
		}else{
			$this->view_data['classes'] = $this->mc->get_all_classes_where($this->session->userdata('userid'));
			$this->view_data['class'] = FALSE;
		}
	}

	public function homew()
	{
		if ($this->input->post('changeclass-btn')) {
			$id = $this->input->post('class');

			redirect(site_url('cms_teacher/homework/'.$id));
		}else{
			redirect(site_url('cms_teacher/homework'));
		}
	}

	public function delete_homework($id = FALSE, $class = FALSE)
	{
		if ($id) {
			$path = $this->mc->get_homework($id);
			$path = FCPATH.'assets/downloads/homework/'.$path->file;
	        if (file_exists($path)){ 
				unlink($path); // DELETE RECENT IMAGE IF EXIST / UNLINK
		        $res = $this->mc->delete_homework($id);
				if ($res) {
					$this->_msg('s','Successfully Delted Homework.','cms_teacher/homework/'.$class);
				}else{
					$this->_msg('e','Failed.','cms_teacher/homework/'.$class);
				}	
	        }else{
	          $this->_msg('e','File Not Deleted.','cms_teacher/homework/'.$class);
	        }
		}else{
			show_404();
		}
	}

	public function quizzes($id = FALSE)
	{
		if ($id) {
			if ($this->input->post('submit-quizzes')) {
				$this->load->library('image_lib');
				$config['upload_path'] = './assets/downloads/quizzes/';
				$config['allowed_types'] = TRUE;
				$config['max_size'] = '100000';
				$config['remove_spaces'] = TRUE;
				$config['overwrite'] = TRUE;

				$this->load->library('upload', $config); //LOAD UPLOAD LIBRARY WITH THE CONFIG VARIABLE

				if (!$this->upload->do_upload('file')) //DO THE ACTUAL UPLOADING OF FILES
				{	
					$error = array('error' => $this->upload->display_errors()); // IF UPLOAD HAS ERROR 
					$this->_msg('e', $error['error'], current_url()); //SHOW ERROR
				}else{ 
					$upload_data = array('upload_data' => $this->upload->data()); // IF UPLOAD SUCCESS GET UPLOAD INFORMATION
					$data['file_size'] = number_format($upload_data['upload_data']['file_size'] / 1024, 2);
					$data['file'] = $upload_data['upload_data']['file_name']; // GET THE FILENAME OF IMAGE UPLOADED
				}

				$data['caption']=$this->input->post('caption');
				$data['updated_at']=$this->input->post('deadline');
				$data['class_id'] = $id;

				$result = $this->mc->upload_quizzes($data);
				if ($result) {
					$this->_msg('s','Successfully Added quizzes.','cms_teacher/quizzes/'.$id);
				}else{
					$this->_msg('e','Failed.','cms_teacher/quizzes/'.$id);
				}
			}

			$this->view_data['class'] = $id;
			$this->view_data['class_name'] = $this->mc->get_class($id);
			$this->view_data['activities'] = $this->mc->get_all_quizzes($id);
			$this->view_data['classes'] = $this->mc->get_all_classes_where($this->session->userdata('userid'));
		}else{
			$this->view_data['classes'] = $this->mc->get_all_classes_where($this->session->userdata('userid'));
			$this->view_data['class'] = FALSE;
		}
	}

	public function quiz()
	{
		if ($this->input->post('changeclass-btn')) {
			$id = $this->input->post('class');

			redirect(site_url('cms_teacher/quizzes/'.$id));
		}else{
			redirect(site_url('cms_teacher/quizzes'));
		}
	}

	public function delete_quizzes($id = FALSE, $class = FALSE)
	{
		if ($id) {
			$path = $this->mc->get_quizzes($id);
			$path = FCPATH.'assets/downloads/quizzes/'.$path->file;
	        if (file_exists($path)){ 
				unlink($path); // DELETE RECENT IMAGE IF EXIST / UNLINK
		        $res = $this->mc->delete_quizzes($id);
				if ($res) {
					$this->_msg('s','Successfully Delted quizzes.','cms_teacher/quizzes/'.$class);
				}else{
					$this->_msg('e','Failed.','cms_teacher/quizzes/'.$class);
				}	
	        }else{
	          $this->_msg('e','File Not Deleted.','cms_teacher/quizzes/'.$class);
	        }
		}else{
			show_404();
		}
	}
}
