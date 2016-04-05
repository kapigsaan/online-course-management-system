<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class totals{

	public function inquiry()
	{
		$CI =& get_instance();
		$CI->load->model('M_inquiry');
		return $CI->M_inquiry->get_new_inquiries();
	}

	public function title()
	{
		$CI =& get_instance();
		$CI->load->model('M_profile');
		return $CI->M_profile->get_profiles();
	}

	public function accounts()
	{
		$CI =& get_instance();
		$CI->load->model('M_content');
		return $CI->M_content->record_count();
	}

	public function students()
	{
		$CI =& get_instance();
		$CI->load->model('M_content');
		return $CI->M_content->record_count('student');
	}

	public function instructors()
	{
		$CI =& get_instance();
		$CI->load->model('M_content');
		return $CI->M_content->record_count('instructor');
	}

}