<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Settings extends MY_AdminController 
{
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') == FALSE)
		{
			redirect();
		}else{
			$this->load->model('M_setting');
			
			$this->view_data['system_message'] = $this->_msg();
		}
	}

	public function index()
	{
		if($this->input->post('btnSubmit'))
		{
			$data['inq_email'] = $this->input->post('txtInq');
      $data['fb_url'] = $this->input->post('txtFburl');
      $data['tw_url'] = $this->input->post('txtTwurl');
      $data['official_email'] = $this->input->post('txtOemail');
      $data['gplus_url'] = $this->input->post('txtGplus');
      $data['gmap_url'] = $this->input->post('txtGmap');
      $data['enroll_url'] = $this->input->post('txtEnroll');
      $data['student_url'] = $this->input->post('txtStudent');
      $data['faculty_url'] = $this->input->post('txtFaculty');
      $data['in_url'] = $this->input->post('txtInurl');
			$this->M_setting->clear_setting();
			$result = $this->M_setting->insert_setting($data);
			
			if($result)
			{
				$this->_msg('s','Settings saved.','settings');
			}else{
				$this->_msg('e','Failed to save settings.','settings');
			}
		}
		
		$this->view_data['settings'] = $this->M_setting->get_inquiry_email();
    $this->view_data['sets'] = $this->M_setting->get_settings();
	}
}