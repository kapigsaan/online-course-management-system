<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms_admin extends MY_AdminController {

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
			$layout_view = '_admin_layout';
		}elseif ($this->session->userdata('userType') == 'instructor') {
			redirect('cms_teacher');
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

	public function accounts()
	{
		$this->view_data['list']=$this->mc->get_all_accounts();
	}

	public function instructor()
	{
		if ($this->input->post('add-instructorsubmit')) {
			$data['username'] = $this->input->post('username');
			$data['f_name'] = $this->input->post('fname');
			$data['m_name'] = $this->input->post('mname');
			$data['l_name'] = $this->input->post('lname');
			$data['userType'] = 'instructor';

			$res = $this->mu->add_user($data);

			if ($res) {
				$this->_msg('s','Successfully Added.','Cms_admin/instructor');
			}else{
				$this->_msg('e','Failed.','Cms_admin/instructor');
			}	

		}

		$this->view_data['list']=$this->mc->get_user_where('instructor');
	}

	public function edit_instructor($id = FALSE)
	{
		if ($id) {
			if ($this->input->post('edit-instructorsubmit')) {
				$data['username'] = $this->input->post('username');
				$data['f_name'] = $this->input->post('fname');
				$data['m_name'] = $this->input->post('mname');
				$data['l_name'] = $this->input->post('lname');

				$res = $this->mu->edit_user($data, $id);

				if ($res) {
					$this->_msg('s','Successfully Updated.','Cms_admin/instructor');
				}else{
					$this->_msg('e','Failed.','Cms_admin/instructor');
				}	
			}

			$this->view_data['list']=$this->mc->get_account($id);

		}else{
			show_404();
		}

	}

	public function delete_instructor($id = FALSE)
	{
		if ($id) {

			$res = $this->mu->delete_user($id);

			if ($res) {
				$this->_msg('s','Successfully Deleted.','Cms_admin/instructor');
			}else{
				$this->_msg('e','Failed.','Cms_admin/instructor');
			}	

		}else{
			show_404();
		}
	}

	public function student()
	{
		if ($this->input->post('add-studentsubmit')) {
			$data['username'] = $this->input->post('username');
			$data['f_name'] = $this->input->post('fname');
			$data['m_name'] = $this->input->post('mname');
			$data['l_name'] = $this->input->post('lname');
			$data['userType'] = 'instructor';

			$res = $this->mu->add_user($data);

			if ($res) {
				$this->_msg('s','Successfully Added.','Cms_admin/student');
			}else{
				$this->_msg('e','Failed.','Cms_admin/student');
			}	

		}

		$this->view_data['list']=$this->mc->get_user_where('student');
	}

	public function view_student($id = FALSE)
	{
		if ($id) {
			$this->view_data['list']=$this->ms->get_student($id);
		}else{
			show_404();
		}
	}

	public function edit_student($id = FALSE)
	{
		# code...
	}

	public function delete_student($id = FALSE)
	{
		# code...
	}

	public function change_status($route = FALSE, $status = FALSE, $id = FALSE)
	{
		if ($id) {
			$res = $this->mc->change_status($status, $id);
			if ($res) {
				if ($status == "inactive") {
					$this->_msg('s','Account Successfully Deactivated.','Cms_admin/'.$route);	
				}else{
					$this->_msg('s','Account Successfully Activated.','Cms_admin/'.$route);
				}
			}else{
				$this->_msg('e','Failed.','Cms_admin/'.$route);
			}				
		}else{
			show_404();
		}
	}
}