<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms_student extends MY_AdminController {

	public function __construct()
	{
		parent::__construct();
		
		if($this->session->userdata('logged_in') == FALSE){
			redirect('obcms-login');
		}elseif ($this->session->userdata('userType') == 'student') {
			$this->view_data['system_message'] =$this->_msg();
			$this->load->model('M_content','mc');
			$this->load->model('M_calendar','mcal');
			$this->load->model('M_downloads','md');
			$this->load->model('M_students','ms');
			$this->load->model('M_forums','mf');
			$this->load->model('M_yvideos','myv');
			$this->load->model('M_users','mu');
			$this->load->model('M_messages','mm');
			$this->load->model('M_classes','mcl');
		}elseif ($this->session->userdata('userType') == 'instructor') {
			redirect('cms_teacher');
		}elseif ($this->session->userdata('userType') == 'admin') {
			redirect('cms_admin');
		}
	}

	private function get_student_class()
	{
		$ac_id = $this->session->userdata('userid');

		return $this->ms->get_student_class($ac_id);

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
			'next_prev_url' => base_url() . 'cms_student/index'
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
		$datas = $this->mcal->get_all_events($year,$month,$this->get_student_class());

		$current_url = 'calendar-of--Events'.$year.'-'.$month;

		$years = date('Y');
		$months = date('m');

		$this->view_data['current'] = $mm = date('F').'  '.$yy = date('Y');
		$type = "web";
		$this->view_data['cal'] = $this->calendar->generate_event_calendar($year,$month,$datas,$current_url,$type);
		$this->view_data['links'] = $this->calendar->generate($this->uri->segment(3), $this->uri->segment(4));
		$this->view_data['events'] = $this->mcal->get_all_event_for($months,$years);
	}

	public function materials()
	{
		$this->view_data['list'] = $this->md->get_syllabus_in_where($this->get_student_class());
		$this->view_data['course_content'] = $this->md->get_course_content_in_where($this->get_student_class());
		$this->view_data['course_outline'] = $this->md->get_course_outline_in_where($this->get_student_class());
	}

	public function course_syllabus()
	{
		$this->view_data['course_syllabus'] = $this->md->get_syllabus_in_where($this->get_student_class());
		$this->view_data['course_content'] = $this->md->get_course_content_in_where($this->get_student_class());
		$this->view_data['course_outline'] = $this->md->get_course_outline_in_where($this->get_student_class());
	}

	public function course_content()
	{
		$this->view_data['course_content'] = $this->md->get_course_content_in_where($this->get_student_class());
	}

	public function course_outline()
	{
		$this->view_data['course_outline'] = $this->md->get_course_outline_in_where($this->get_student_class());
	}

	public function course_images()
	{
		$this->view_data['course_images'] = $this->md->get_images_in_where($this->get_student_class());
	}

	public function course_videos()
	{
		$this->view_data['course_videos'] = $this->myv->get_every_yv_where($this->get_student_class());
	}

	public function news($year = FALSE, $month = FALSE)
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
			'next_prev_url' => base_url() . 'cms_student/news'
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
		$datas = $this->mcal->get_all_events($year,$month,$this->get_student_class());

		$current_url = 'calendar-of--Events'.$year.'-'.$month;

		$years = date('Y');
		$months = date('m');

		$this->view_data['current'] = $mm = date('F').'  '.$yy = date('Y');
		$type = "web";
		$this->view_data['cal'] = $this->calendar->generate_event_calendar($year,$month,$datas,$current_url,$type);
		$this->view_data['links'] = $this->calendar->generate($this->uri->segment(3), $this->uri->segment(4));
		$this->view_data['events'] = $this->mcal->get_all_event_for($months,$years);

	}

	public function forums() {
		if ($this->input->post()) {
			$data['topics'] = $this->input->post('topic');
			$data['forum_desc'] = $this->input->post('forum_desc');
			$data['class_id'] = $this->get_student_class();
			$data['created_by'] = $this->session->userdata('userid');

			$result = $this->mf->add_forum($data);

			if ($result) {
				$this->_msg('s','Successfully Added.','cms_student/forums/');
			}else{
				$this->_msg('e','Failed.','cms_student/forums/');
			}
		}

		$this->view_data['my_forum'] = $this->session->userdata('userid');
		$this->view_data['list'] = $this->mf->get_forums_in($this->get_student_class());
	}

	public function edit_forum($id = FALSE)
	{
		if ($id) {

			if ($this->input->post('update-forumssubmit')) {
				$data['topics'] = $this->input->post('topics');
				$data['forum_desc'] = $this->input->post('forum_desc');

				$result = $this->mf->edit_forum($data, $id);

				if ($result) {
					$this->_msg('s','Successfully Updated Topic.','cms_student/forums/');
				}else{
					$this->_msg('e','Failed.','cms_student/forums/');
				}
			}

			$this->view_data['class'] = $this->mf->get_forum($id);
			$this->view_data['list'] = $this->mf->get_forums_in($this->get_student_class());

		}else{
			show_404();
		}
	}

	public function delete_forum($id = FALSE)
	{
		if ($id) {
			$res = $this->mf->delete_forum($id);
			if ($res) {
				$this->_msg('s','Successfully Deleted.','cms_student/forums/');
			}else{
				$this->_msg('e','Failed.','cms_student/forums/');
			}	
		}else{
			show_404();
		}
	}

	public function view_forum($id = FALSE)
	{
		if ($id) {
			if ($this->input->post('submit-comment')) {
				$data['comment'] = $this->input->post('comment');
				$data['forum_id'] = $id;
				$data['comment_by'] = $this->session->userdata('userid');

				$result = $this->mf->add_comment($data);

				if ($result) {
					$this->_msg('s','Comment Submitted.','cms_student/view_forum/'.'/'.$id);
				}else{
					$this->_msg('e','Failed.','cms_student/view_forum/'.'/'.$id);
				}
			}

			$this->view_data['class'] = $this->mf->get_forum($id);
			$this->view_data['list'] = $this->mf->get_comments_in($id);
		}else{
			show_404();
		}
	}

	public function change_password()
	{
		if ($this->input->post('btn-submit-changepass')) {
			$old_pass = $this->input->post('old_pass');
			$password = $this->input->post('password');

			$old = $this->mu->verify_password($old_pass, $this->session->userdata('userid'));
			if ($old) {
				$new = $this->mu->change_pass($password, $this->session->userdata('userid'));
				if ($new) {
					$this->_msg('s','Password Successfully Changed.','cms_student/index/');
				}else{
					$this->_msg('e','Failed.','cms_student/index/');
				}
			}else{
				$this->_msg('e','Old Password is Invalid.','cms_student/change_password');
			}
		}
		$this->view_data['profile'] = $this->mu->get_all_users($this->session->userdata('userid'));

	}

	public function messages()
	{
		$this->view_data['messages'] = $this->mm->get_my_messages($this->session->userdata('userid'));
		$this->view_data['instructors'] = $this->mc->get_user_where('instructor');
		$this->view_data['accounts'] = $this->mc->get_all_accounts();
		$this->view_data['me'] = $this->session->userdata('userid');
	}

	public function view_conversation($id = FALSE)
	{
		if ($id) {
			if ($this->input->post('btn-reply-messages')) {
				$data['subject'] = $this->input->post('subject');
				$data['from'] = $this->session->userdata('userid');
				$data['to'] = $this->input->post('msg-to');
				$data['message'] = $this->input->post('reply');

				$result = $this->mm->send_message($data);

					if ($result) {
						$this->_msg('s','Message Sent.','cms_student/messages/');
					}else{
						$this->_msg('e','Failed.','cms_student/messages/');
					}

			}
			$this->view_data['messages'] = $this->mm->get_conversation_with($id, $this->session->userdata('userid'));	
			$this->view_data['accounts'] = $this->mc->get_all_accounts();
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
				$this->_msg('s','Successfully Deleted.','cms_student/messages/');
			}else{
				$this->_msg('e','Failed.','cms_student/messages/');
			}	
		}else{
			show_404();
		}
	}

	public function activity()
	{
		if ($this->input->post('upload-act-ans')) {

			$this->load->library('image_lib');
			$config['upload_path'] = './assets/downloads/answers';
			$config['allowed_types'] = TRUE;
			$config['max_size'] = '100000';
			$config['remove_spaces'] = TRUE;
			$config['overwrite'] = FALSE;

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

			$data['caption'] = $this->input->post('caption');
			$data['class_id'] = $this->input->post('act_id');
			$data['stud_id'] = $this->session->userdata('userid');

			$result = $this->ms->submit_avtivity($data);
			if ($result) {
				$this->_msg('s','Successfully Submitted.','cms_student/activity/');
			}else{
				$this->_msg('e','Failed.','cms_student/activity/');
			}
		}
		$this->view_data['activities'] = $this->mcl->get_all_acticities($this->get_student_class());
	}

	public function homework()
	{
		if ($this->input->post('upload-home-ans')) {
			
			$this->load->library('image_lib');
			$config['upload_path'] = './assets/downloads/answers';
			$config['allowed_types'] = TRUE;
			$config['max_size'] = '100000';
			$config['remove_spaces'] = TRUE;
			$config['overwrite'] = FALSE;

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

			$data['caption'] = $this->input->post('caption');
			$data['class_id'] = $this->input->post('act_id');
			$data['stud_id'] = $this->session->userdata('userid');

			$result = $this->ms->submit_avtivity($data);
			if ($result) {
				$this->_msg('s','Successfully Submitted.','cms_student/homework/');
			}else{
				$this->_msg('e','Failed.','cms_student/homework/');
			}
		}

		$this->view_data['homework'] = $this->mcl->get_all_homework($this->get_student_class());
	}

	public function quizzes()
	{
		if ($this->input->post('upload-quiz-ans')) {
			
			$this->load->library('image_lib');
			$config['upload_path'] = './assets/downloads/answers';
			$config['allowed_types'] = TRUE;
			$config['max_size'] = '100000';
			$config['remove_spaces'] = TRUE;
			$config['overwrite'] = FALSE;

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

			$data['caption'] = $this->input->post('caption');
			$data['class_id'] = $this->input->post('act_id');
			$data['stud_id'] = $this->session->userdata('userid');

			$result = $this->ms->submit_avtivity($data);
			if ($result) {
				$this->_msg('s','Successfully Submitted.','cms_student/quizzes/');
			}else{
				$this->_msg('e','Failed.','cms_student/quizzes/');
			}
		}
		$this->view_data['quizzes'] = $this->mcl->get_all_quizzes($this->get_student_class());
	}
}