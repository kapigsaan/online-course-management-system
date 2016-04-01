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
	
	public function index()
	{
		//$this->view_data['hits']=$this->mu->get_hits();
		//$this->view_data['visits']=$this->mu->count_hits();
		//$this->view_data['ipadd']=$this->mu->count_visits();
	}

	public function materials()
	{
		$this->view_data['list'] = $this->md->get_syllabus_in($this->get_student_class());
		$this->view_data['course_content'] = $this->md->get_course_content_in($this->get_student_class());
		$this->view_data['course_outline'] = $this->md->get_course_outline_in($this->get_student_class());
	}

	public function course_syllabus()
	{
		$this->view_data['course_syllabus'] = $this->md->get_syllabus_in($this->get_student_class());
		$this->view_data['course_content'] = $this->md->get_course_content_in($this->get_student_class());
		$this->view_data['course_outline'] = $this->md->get_course_outline_in($this->get_student_class());
	}

	public function course_content()
	{
		$this->view_data['course_content'] = $this->md->get_course_content_in($this->get_student_class());
	}

	public function course_outline()
	{
		$this->view_data['course_outline'] = $this->md->get_course_outline_in($this->get_student_class());
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
}