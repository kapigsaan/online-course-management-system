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
			$this->load->model('M_downloads','md');
			$this->load->model('M_students','ms');
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

	public function news()
	{
		# code...
	}

	public function forums()
	{
		# code...
	}
}